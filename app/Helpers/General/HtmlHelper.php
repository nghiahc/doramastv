<?php

namespace App\Helpers\General;

use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Class HtmlHelper.
 */
class HtmlHelper
{
    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;

    /**
     * HtmlHelper constructor.
     *
     * @param UrlGenerator|null $url
     */
    public function __construct(UrlGenerator $url = null)
    {
        $this->url = $url;
    }

    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    public function style($url, $attributes = [], $secure = null)
    {
        $defaults = ['media' => 'all', 'type' => 'text/css', 'rel' => 'stylesheet'];

        $attributes = $attributes + $defaults;

        $attributes['href'] = $this->url->asset($url, $secure);

        return $this->toHtmlString('<link'.$this->attributes($attributes).'>'.PHP_EOL);
    }

    /**
     * Generate a link to a JavaScript file.
     *
     * @param string $url
     * @param array  $attributes
     * @param bool   $secure
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function script($url, $attributes = [], $secure = null)
    {
        $attributes['src'] = $this->url->asset($url, $secure);

        return $this->toHtmlString('<script'.$this->attributes($attributes).'></script>'.PHP_EOL);
    }

    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return HtmlString
     */
    public function formCancel($cancel_to, $title, $classes = 'btn btn-danger btn-sm')
    {
        return html()->a($cancel_to, $title)->class($classes);
    }

    /**
     * @param        $title
     * @param string $classes
     *
     * @return HtmlString
     */
    public function formSubmit($title, $classes = 'btn btn-success btn-sm pull-right')
    {
        return html()->submit($title)->class($classes);
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElement($key, $value)
    {
        // For numeric keys we will assume that the value is a boolean attribute
        // where the presence of the attribute represents a true value and the
        // absence represents a false value.
        // This will convert HTML attributes such as "required" to a correct
        // form instead of using incorrect numerics.
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key != 'value') {
            return $value ? $key : '';
        }

        if (! is_null($value)) {
            return $key.'="'.e($value).'"';
        }
    }

    /**
     * Transform the string to an Html serializable object.
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }

    /**
     * @param $action
     * @param $string
     * @return bool|string
     */
    public function encryptDecrypt($action, $string)
    {
        $output       = false;
        $cipherMethod = 'aes-128-ctr';
        $encKey       = '25c6c7ff35b9979b151f2136cd13b0ff';
        $encIv        = '254f830c42c937fb7e1e2444c632a8a4';

        $key = hash('sha256', $encKey);
        $iv  = substr(hash('sha256', $encIv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $cipherMethod, $key, 0, $iv);
        }
        else if ($action == 'decrypt') {
            $output = openssl_decrypt($string, $cipherMethod, $key, 0, $iv);
        }

        return $output;
    }
}
