<?php

namespace App\Services;

class Common
{

//    const DIMENSIONS = [
//        28 => '120x60 / Button 2',
//        46 => '120x600 / Skyscrape',
//        29 => '120x240 / Vertical Banner',
//        25 => '120x90 / Button 1',
//        32 => '125x125 / Square Button',
//        11 => '160x600 / Wide Skyscraper',
//        10 => '180x150 / Rectangle',
//        36 => '200x200 / Small Square',
//        19 => '234x60 / Half Banner',
//        5 => '240x400 / Vertical Rectangle',
//        37 => '250x250 / Square Pop-Up',
//        40 => '300x100 / 3:1 Rectangle',
//        9 => '300x250 / Medium Rectangle',
//        47 => '300x600 / Half-page Ad',
//        52 => '315x300',
//        35 => '320x100 / Large Mobile Banner',
//        34 => '320x50 / Mobile Banner',
//        48 => '320x480 / Mobile Interstitial',
//        38 => '336x280 / Large Rectangle',
//        1 => '468x60 / Full Banner',
//        49 => '480x320',
//        42 => '580x400 / Netboard',
//        50 => '600x400',
//        41 => '720x300 / Pop-Under',
//        6 => '728x90 / Leaderboard',
//        33 => '88x31 / Micro Bar',
//        51 => '930x180 / Top Banner',
//        20 => '970x90 / Large Leaderboard',
//        21 => '970x250 / Billboard',
//        24 => '980x120 / Panorama',
//        666 => 'Custom'
//    ];

    const DIMENSIONS = [
        "B-970x250" =>[
            'name' => 'B - 970x250',
            'size' => [
                970,
                250
            ]
        ],
        "B-Stickyads" =>[
            'name' => 'B - Sticky ads',
            'size' => [
                1,
                1
            ]
        ],
        "B-750x100" =>[
            'name' => 'B - 750x100',
            'size' => [
                750,
                100
            ]
        ],
        "B-300x250" =>[
            'name' => 'B - 300x250',
            'size' => [
                300,
                250
            ]
        ],
        "B-728x280" =>[
            'name' => 'B - 728x280',
            'size' => [
                728,
                280
            ]
        ],
        "B-970x9" =>[
            'name' => 'B - 970x90',
            'size' => [
                970,
                90
            ]
        ],
        "B-160x640" =>[
            'name' => 'B - 160x640',
            'size' => [
                160,
                640
            ]
        ],
        "B-100%x100%" =>[
            'name' => 'B - 100%x100%',
            'size' => [
                '100%',
                '100%'
            ]
        ],
        "B-970x250" =>[
            'name' => 'B - 970x250',
            'size' => [
                970,
                250
            ]
        ],
        "B/M-320x100" =>[
            'name' => 'B/M - 320x100',
            'size' => [
                320,
                100
            ]
        ],
        "B/M-320x50" =>[
            'name' => 'B/M - 320x50',
            'size' => [
                320,
                50
            ]
        ],
        "Native-4x1,4x2" =>[
            'name' => 'Native - 4x1, 4x2',
            'size' => [
                1,
                1
            ]
        ],
        "Native-3x1,3x2" =>[
            'name' => 'Native - 3x1, 3x2',
            'size' => [
                1,
                1
            ]
        ],
        "Native-2x12x2" =>[
            'name' => 'Native - 2x1, 2x2',
            'size' => [
                1,
                1
            ]
        ],
        "Native-1x1" =>[
            'name' => 'Native - 1x1',
            'size' => [
                1,
                1
            ]
        ],
        "Video-498x280" =>[
            'name' => 'Video - 498x280',
            'size' => [
                498,
                280
            ]
        ],
        "Video-1x1" =>[
            'name' => 'Video - 1x1',
            'size' => [
                1,
                1
            ]
        ],
        "Video-600x400" =>[
            'name' => 'Video - 600x400',
            'size' => [
                600,
                400
            ]
        ],
        "Video-500x300" =>[
            'name' => 'Video - 500x300',
            'size' => [
                500,
                300
            ]
        ],

    ];
    const DIMENSION_METHOD = [
        1 => 'Exact match',
        3 => 'Not wider than',
        4 => 'Not higher than',
        2 => 'Not larger than',
    ];

    const TARGET_MODE = [
        1 => 'Include',
        2 => 'Exclude',
    ];
    const DEVICE = [
        7 => 'Car browser',
        5 => 'Console',
        1 => 'Desktop',
        4 => 'Feature phone',
        8 => 'Phablet',
        2 => 'Smartphone',
        3 => 'Tablet',
        6 => 'TV',
        0 => 'Other',
    ];
    const BROWSER = [
        '32' => 'Aloha Browser',
        '20' => 'Amigo',
        '13' => 'Android Browser',
        '16' => 'BlackBerry Browser',
        '1' => 'Chrome',
        '6' => 'Chrome Mobile',
        '24' => 'Chrome Mobile iOS',
        '26' => 'Chrome Mobile Webview',
        '21' => 'Chromium',
        '33' => 'Documents by Readdle',
        '39' => 'DuckDuckGo Browser',
        '34' => 'Ecosia',
        '10' => 'Edge Mobile',
        '12' => 'Facebook in-app',
        '2' => 'Firefox',
        '29' => 'Firefox Mobile',
        '38' => 'Firefox Mobile iOS',
        '27' => 'Google Search App',
        '30' => 'HeyTapBrowser',
        '37' => 'Huawei Browser Mobile',
        '14' => 'IE Mobile',
        '3' => 'Internet Explorer',
        '23' => 'Maxthon',
        '9' => 'Microsoft Edge',
        '19' => 'MIUI Browser',
        '36' => 'Mobile Silk',
        '35' => 'Naver',
        '5' => 'Opera',
        '17' => 'Opera Mini',
        '8' => 'Opera Mobile',
        '40' => 'Opera Touch',
        '18' => 'Puffin',
        '22' => 'QQ Browser',
        '4' => 'Safari',
        '7' => 'Safari Mobile',
        '25' => 'Samsung Browser',
        '11' => 'UC Browser',
        '31' => 'Venus Browser',
        '28' => 'Vivo Browser',
        '15' => 'Yandex Browser',
        '0' => 'Other'
    ];

    const INJECTION_TYPE = [
        32 => 'IFrame container',
        35 => 'IFrame container (strict)',
        33 => 'Direct injection',
        36 => 'Direct injection (in-place)',
    ];

    const EXT_LABEL_POST = [
        null => 'Default',
        1 => 'Disabled',
        2 => 'Top Left',
        3 => 'Top Right',
        4 => 'Bottom Left',
        5 => 'Bottom Right',
    ];
    const EXT_MENU_POST = [
        null => 'Default',
        1 => 'Disabled',
        2 => 'Top Left',
        3 => 'Top Right'
    ];

    const EXT_BRAND_POST = [
        null => 'Default',
        1 => 'Disabled',
        2 => 'Top Left',
        3 => 'Top Right',
        4 => 'Bottom Left',
        5 => 'Bottom Right',
    ];
    const ID_AD_FORMAT = [
      'HTML_JS' => 3
    ];
}
