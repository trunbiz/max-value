<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ZoneModel extends Model
{
    protected $table = 'zones';

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

    const DIMENSIONS_METHOD = [
      1 => 'Exact match',
      3 => 'Not wider than',
      4 => 'Not higher than',
      2 => 'Not larger than',
    ];
}
