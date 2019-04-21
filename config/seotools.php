<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => "Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas",
            'description' => 'Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas',
            'separator'   => ' - ',
            'keywords'    => [
                'doramastv',
                'best streaming movie',
                'drama eng sub',
                'korean drama',
                'kdrama',
                'kshows',
                'korean show',
                'chinese drama',
                'japanese drama',
                'anime',
                'english subtitle',
                'drama online',
                'download'
            ],
            'generator'   => 'DoramasTV - Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'copyright'   => 'DoramasTV - Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'author'      => 'DoramasTV - Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'canonical'   => false,
            // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'description' => 'Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'url'         => null,
            'type'        => 'video.movie',
            'site_name'   => 'DoramasTV - Ver doramas Coreanos en español online, Chinos doramas, Japonese doramas.',
            'images'      => [],
        ],
    ],
    'twitter'   => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
];
