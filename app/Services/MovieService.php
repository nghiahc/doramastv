<?php

namespace App\Services;

use App\Models\Episode;
use Ixudra\Curl\Facades\Curl;

/**
 * Class MovieService
 * @package App\Services
 */
class MovieService
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * MovieService constructor.
     * @param $host
     * @param $port
     */
    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @param Episode $episode
     * @return string
     */
    public function getEpisodeSources(Episode $episode)
    {
        $url     = "http://{$this->host}:{$this->port}/movieinfo3";
        $payload = [
            'encodedurl' => base64_encode($episode->video_embeded_url)
        ];

        $payload['ggevurl']   = $episode->sd_gg_video_url ? base64_encode($episode->sd_gg_video_url) : '*';
        $payload['ggevdocid'] = $episode->hd_gg_docid ? base64_encode($episode->hd_gg_docid) : '*';

        try {
            $response = Curl::to($url)->withData($payload)->post();
            if (!$response) {
                return '';
            }

            $data = json_decode($response);
            if (!isset($data->video_sources)) {
                return '';
            }

            $isUpdated = false;
            foreach ($data->video_sources as $source) {
                if (isset($source->static) && $source->static && isset($source->url)) {
                    $isUpdated                = true;
                    $episode->sd_gg_video_url = $source->url;
                }

                if (isset($source->google_doc_id)) {
                    $isUpdated            = true;
                    $episode->hd_gg_docid = $source->google_doc_id;
                }
            }

            if ($isUpdated) {
                $episode->save();
            }

            return $response;
        } catch (\Exception $e) {
            return '';
        }
    }
}
