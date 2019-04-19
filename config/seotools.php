<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => "Watch online Korean drama, Chinese drama, Japanese drama, Anime, Asian movies 2019 with EngSub and download free on Eadrama",
            'description' => 'Watch online Korean drama, Chinese drama, Japanese drama, Anime, Asian movies 2019 with EngSub and download free on Eadrama',
            'separator'   => ' - ',
            'keywords'    => [
                'eadrama',
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
            'generator'   => 'Eadrama - Watch online asian drama, movies and shows with English subtitle in HD quality and download free.',
            'copyright'   => 'Eadrama - Watch online asian drama, movies and shows with English subtitle in HD quality and download free.',
            'author'      => 'Eadrama - Watch online asian drama, movies and shows with English subtitle in HD quality and download free.',
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
            'title'       => 'Watch online asian drama, movies and shows with English subtitle in HD quality and download free.',
            'description' => 'Watch online Korean drama, Chinese drama, Japanese drama, Anime, Asian movies 2019 with EngSub and download free on Eadrama',
            'url'         => null,
            'type'        => 'video.movie',
            'site_name'   => 'Eadrama - Watch online asian drama, movies and shows with English subtitle in HD quality and download free.',
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
