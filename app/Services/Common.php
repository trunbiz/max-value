<?php

namespace App\Services;

use App\Models\User;
use Weidner\Goutte\GoutteFacade;

class Common
{
//    const DIMENSIONS = [
//        "B-970x250" => [
//            'name' => 'B-970x250',
//            'size' => [
//                970,
//                250
//            ]
//        ],
//        "B-Stickyads" => [
//            'name' => 'B-Sticky ads',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "B-750x100" => [
//            'name' => 'B-750x100',
//            'size' => [
//                750,
//                100
//            ]
//        ],
//        "B-300x250" => [
//            'name' => 'B-300x250',
//            'size' => [
//                300,
//                250
//            ]
//        ],
//        "B-728x280" => [
//            'name' => 'B-728x280',
//            'size' => [
//                728,
//                280
//            ]
//        ],
//        "B-970x9" => [
//            'name' => 'B-970x90',
//            'size' => [
//                970,
//                90
//            ]
//        ],
//        "B-160x640" => [
//            'name' => 'B-160x640',
//            'size' => [
//                160,
//                640
//            ]
//        ],
//        "B-100%x100%" => [
//            'name' => 'B-100%x100%',
//            'size' => [
//                '100%',
//                '100%'
//            ]
//        ],
//        "B/M-320x100" => [
//            'name' => 'B/M-320x100',
//            'size' => [
//                320,
//                100
//            ]
//        ],
//        "B/M-320x50" => [
//            'name' => 'B/M-320x50',
//            'size' => [
//                320,
//                50
//            ]
//        ],
//        "Native-4x1" => [
//            'name' => 'Native-4x1',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-4x2" => [
//            'name' => 'Native-4x2',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-3x1" => [
//            'name' => 'Native-3x1',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-3x2" => [
//            'name' => 'Native-3x2',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-2x1" => [
//            'name' => 'Native-2x1',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-2x2" => [
//            'name' => 'Native-2x2',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Native-1x1" => [
//            'name' => 'Native-1x1',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Video-498x280" => [
//            'name' => 'Video-498x280',
//            'size' => [
//                498,
//                280
//            ]
//        ],
//        "Video-1x1" => [
//            'name' => 'Video-1x1',
//            'size' => [
//                1,
//                1
//            ]
//        ],
//        "Video-600x400" => [
//            'name' => 'Video-600x400',
//            'size' => [
//                600,
//                400
//            ]
//        ],
//        "Video-500x300" => [
//            'name' => 'Video-500x300',
//            'size' => [
//                500,
//                300
//            ]
//        ],
//
//    ];
    const DIMENSIONS = [
        "B-Stickyads" => [
            'name' => 'B-Sticky ads',
            'size' => [
                1,
                1
            ]
        ],
        "Medium-Rectangle" => [
            'name' => 'Medium Rectangle',
            'size' => [
                300,
                250
            ]
        ],
        "Large-Rectangle" => [
            'name' => 'Large Rectangle',
            'size' => [
                366,
                280
            ]
        ],
        "Leaderboard" => [
            'name' => 'Leaderboard',
            'size' => [
                728,
                90
            ]
        ],
        "Large-Leaderboard" => [
            'name' => 'Large Leaderboard',
            'size' => [
                750,
                100
            ]
        ],
        "Super-Leaderboard" => [
            'name' => 'Super Leaderboard',
            'size' => [
                970,
                90
            ]
        ],
        "Billboard" => [
            'name' => 'Billboard',
            'size' => [
                970,
                250
            ]
        ],
        "Wide-Skycraper" => [
            'name' => 'Wide Skycraper',
            'size' => [
                160,
                600
            ]
        ],
        "Half-page" => [
            'name' => 'Half page',
            'size' => [
                300,
                600
            ]
        ],
        "Flexible" => [
            'name' => 'Flexible',
            'size' => [
                'auto',
                'auto'
            ]
        ],
        "Video-Freesize" => [
            'name' => 'Video Freesize',
            'size' => [
                '100%',
                '100%'
            ]
        ],
        "Video-Large-498x280" => [
            'name' => 'Video Large (498x280)',
            'size' => [
                498,
                280
            ]
        ],
        "Video-Large-500x300" => [
            'name' => 'Video Large (500x300)',
            'size' => [
                500,
                300
            ]
        ],
        "Video-Large-600x400" => [
            'name' => 'Video Large (600x400)',
            'size' => [
                600,
                400
            ]
        ],
        "Smart-Feed" => [
            'name' => 'Smart Feed',
            'size' => [
                '100%',
                'auto'
            ]
        ],
        "Native-1x2" => [
            'name' => 'Native (1x2)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-1x3" => [
            'name' => 'Native (1x3)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-1x4" => [
            'name' => 'Native (1x4)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-2x1" => [
            'name' => 'Native (2x1)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-2x2" => [
            'name' => 'Native (2x2)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-3x1" => [
            'name' => 'Native (3x1)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-3x2" => [
            'name' => 'Native (3x2)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-4x1" => [
            'name' => 'Native (4x1)',
            'size' => [
                1,
                1
            ]
        ],
        "Native-4x2" => [
            'name' => 'Native (4x2)',
            'size' => [
                1,
                1
            ]
        ],
        "Mobile-320x50" => [
            'name' => 'Mobile (320x50)',
            'size' => [
                320,
                50
            ]
        ],
        "Mobile-320x100" => [
            'name' => 'Mobile (320x100)',
            'size' => [
                320,
                100
            ]
        ],
    ];

    const PUBLISHER_DIMENSIONS_GROUP = [
        'Best Performance' => [
            "B-Stickyads" => [
                'id' => 1,
                'name' => 'B-Sticky ads (1 x 1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Medium-Rectangle" => [
                'id' => 2,
                'name' => 'Medium Rectangle (300 x 250)',
                'size' => [
                    300,
                    250
                ]
            ],
            "Video-Freesize" => [
                'id' => 11,
                'name' => 'Video-Freesize',
                'size' => [
                    '100%',
                    '100%'
                ]
            ]
        ],
        'Banner format' => [
            "B-Stickyads" => [
                'id' => 1,
                'name' => 'B-Sticky ads (1 x 1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Medium-Rectangle" => [
                'id' => 2,
                'name' => 'Medium Rectangle (300 x 250)',
                'size' => [
                    300,
                    250
                ]
            ],
            "Leaderboard" => [
                'id' => 4,
                'name' => 'Leaderboard (728 x 90)',
                'size' => [
                    728,
                    90
                ]
            ],
            "Super-Leaderboard" => [
                'id' => 6,
                'name' => 'Super Leaderboard (970 x 90)',
                'size' => [
                    970,
                    90
                ]
            ],
            "Billboard" => [
                'id' => 7,
                'name' => 'Billboard (970 x 250)',
                'size' => [
                    970,
                    250
                ]
            ],
            "Wide-Skycraper" => [
                'id' => 8,
                'name' => 'Wide Skycraper (160 x 600)',
                'size' => [
                    160,
                    600
                ]
            ]
        ],
        'Video format' => [
            "Video-Freesize" => [
                'id' => 11,
                'name' => 'Video Freesize',
                'size' => [
                    '100%',
                    '100%'
                ]
            ]
        ],
        'Native format' => [
            "Smart-Feed" => [
                'id' => 15,
                'name' => 'Smart Feed',
                'size' => [
                    '100%',
                    'auto'
                ]
            ],
            "In-Article" => [
                'id' => 28,
                'name' => 'In Article',
                'size' => [
                    1,
                    1
                ]
            ]
        ]
    ];
    const DIMENSIONS_GROUP = [
        'Best Performance' => [
            "B-Stickyads" => [
                'id' => 1,
                'name' => 'B-Sticky ads (1 x 1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Medium-Rectangle" => [
                'id' => 2,
                'name' => 'Medium Rectangle (300 x 250)',
                'size' => [
                    300,
                    250
                ]
            ],
            "Video-Freesize" => [
                'id' => 11,
                'name' => 'Video-Freesize (100% x 100%)',
                'size' => [
                    '100%',
                    '100%'
                ]
            ],
            "Flexible" => [
                'id' => 4,
                'name' => 'Flexible (100% x 100%)',
                'size' => [
                    '100%',
                    '100%'
                ]
            ],
        ],
        'Banner format' => [
            "B-Stickyads" => [
                'id' => 1,
                'name' => 'B-Sticky ads (1 x 1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Medium-Rectangle" => [
                'id' => 2,
                'name' => 'Medium Rectangle (300 x 250)',
                'size' => [
                    300,
                    250
                ]
            ],
            "Large-Rectangle" => [
                'id' => 3,
                'name' => 'Large Rectangle (366 x 280)',
                'size' => [
                    366,
                    280
                ]
            ],
            "Leaderboard" => [
                'id' => 4,
                'name' => 'Leaderboard (728 x 90)',
                'size' => [
                    728,
                    90
                ]
            ],
            "Large-Leaderboard" => [
                'id' => 5,
                'name' => 'Large Leaderboard (750 x 100)',
                'size' => [
                    750,
                    100
                ]
            ],
            "Super-Leaderboard" => [
                'id' => 6,
                'name' => 'Super Leaderboard (970 x 90)',
                'size' => [
                    970,
                    90
                ]
            ],
            "Billboard" => [
                'id' => 7,
                'name' => 'Billboard (970 x 250)',
                'size' => [
                    970,
                    250
                ]
            ],
            "Wide-Skycraper" => [
                'id' => 8,
                'name' => 'Wide Skycraper (160 x 600)',
                'size' => [
                    160,
                    600
                ]
            ],
            "Half-page" => [
                'id' => 9,
                'name' => 'Half page (300 x 600)',
                'size' => [
                    300,
                    600
                ]
            ],
            "Flexible" => [
                'id' => 10,
                'name' => 'Flexible (auto x auto)',
                'size' => [
                    'auto',
                    'auto'
                ]
            ],
        ],
        'Video format' => [
            "Video-Freesize" => [
                'id' => 11,
                'name' => 'Video Freesize (100% x 100%)',
                'size' => [
                    '100%',
                    '100%'
                ]
            ],
            "Video-Large-498x280" => [
                'id' => 12,
                'name' => 'Video Large (498x280)',
                'size' => [
                    498,
                    280
                ]
            ],
            "Video-Large-500x300" => [
                'id' => 13,
                'name' => 'Video Large (500x300)',
                'size' => [
                    500,
                    300
                ]
            ],
            "Video-Large-600x400" => [
                'id' => 14,
                'name' => 'Video Large (600x400)',
                'size' => [
                    600,
                    400
                ]
            ],
        ],
        'Native format' => [
            "Smart-Feed" => [
                'id' => 15,
                'name' => 'Smart Feed',
                'size' => [
                    '100%',
                    'auto'
                ]
            ],
            "Native-1x2" => [
                'id' => 16,
                'name' => 'Native (1x2)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-1x3" => [
                'id' => 17,
                'name' => 'Native (1x3)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-1x4" => [
                'id' => 18,
                'name' => 'Native (1x4)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-2x1" => [
                'id' => 19,
                'name' => 'Native (2x1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-2x2" => [
                'id' => 20,
                'name' => 'Native (2x2)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-3x1" => [
                'id' => 21,
                'name' => 'Native (3x1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-3x2" => [
                'id' => 22,
                'name' => 'Native (3x2)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-4x1" => [
                'id' => 23,
                'name' => 'Native (4x1)',
                'size' => [
                    1,
                    1
                ]
            ],
            "Native-4x2" => [
                'id' => 25,
                'name' => 'Native (4x2)',
                'size' => [
                    1,
                    1
                ]
            ],
            "In-Article" => [
                'id' => 28,
                'name' => 'In Article',
                'size' => [
                    1,
                    1
                ]
            ]
        ],
        'Mobile format' => [
            "Mobile-320x50" => [
                'id' => 26,
                'name' => 'Mobile (320x50)',
                'size' => [
                    320,
                    50
                ]
            ],
            "Mobile-320x100" => [
                'id' => 27,
                'name' => 'Mobile (320x100)',
                'size' => [
                    320,
                    100
                ]
            ],
        ]

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

    const LIST_GEOS = [
        2077456 => 'Australia',
        6251999 => 'Canada',
        3017382 => 'France',
        2921044 => 'Germany',
        3175395 => 'Italy',
        2635167 => 'United Kingdom',
        6252001 => 'United States',
        1562822 => 'Vietnam'
    ];

    const IS_DELETE = 1;
    const NOT_DELETE = 0;

    const ACTIVE = 1;

    const CODE_COLOR = ['#dc3545', '#6984de', '#33d685', '#fd7e14', '#0dcaf0', '#ffc107'];
    const STATUS_ADSERVER = [
        3520 => 'Pending',
        3500 => 'Approved',
        3525 => 'Verification',
        3510 => 'Rejected',
    ];
    const CODE_EMPTY = 'EMPTY'; // Không tồn tại nôị dung
    const CODE_NOT_UPDATE = 'NOT_UPDATE'; // File chưa update
    const CODE_ACCEPT = 'ACCEPT'; // Hoạt động

    static function getNameDimension($height, $width)
    {
        foreach (self::DIMENSIONS as $key => $item) {
            if ($item['size'][0] == $height && $item['size'][1] == $width) {
                return $key;
            }
        }
        return '';
    }

    static function randomColor()
    {
        $colors = ['#dc3545', '#6984de', '#33d685', '#fd7e14', '#dc3545', '#0dcaf0', '#ffc107'];
        return $colors[array_rand($colors)];
    }

    public function listUserGroupAdmin()
    {
        return User::where('is_admin', '<>', 0)->where('active', self::ACTIVE)->get();
    }

    public function listUserGroupAM()
    {
        return User::where('is_admin', '<>', 0)->where('role_id', 5)->where('active', self::ACTIVE)->get();
    }

    private $previousHue = null; // Biến để lưu giá trị Hue của màu trước đó

    public function generateRandomColor() {
        $hueMin = 0; // Giá trị Hue tối thiểu
        $hueMax = 360; // Giá trị Hue tối đa
        $saturation = mt_rand(70, 100); // Chọn ngẫu nhiên giá trị Saturation từ 70 đến 100
        $lightness = mt_rand(50, 80); // Chọn ngẫu nhiên giá trị Lightness từ 50 đến 80

        // Kiểm tra xem đã có giá trị Hue trước đó hay chưa
        if ($this->previousHue !== null) {
            $hueMin = $this->previousHue + 30; // Đặt giá trị Hue tối thiểu là giá trị Hue trước đó + 30
            if ($hueMin > 360) {
                $hueMin -= 360; // Nếu giá trị Hue tối thiểu vượt quá 360, trừ đi 360 để giữ nó trong khoảng 0-360
            }
        }

        $hue = mt_rand($hueMin, $hueMax); // Chọn ngẫu nhiên giá trị Hue từ Hue tối thiểu đến Hue tối đa

        $this->previousHue = $hue; // Lưu giá trị Hue cho lần sử dụng tiếp theo

        $color = "hsl($hue, $saturation%, $lightness%)";
        return $color;
    }

    public function crawlData($url, $path)
    {
        $crawler = GoutteFacade::request('GET', $url);
        return $crawler->filter($path)->each(function ($node) {
            return $node->text();
        });
    }
}
