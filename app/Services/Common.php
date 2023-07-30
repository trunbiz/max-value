<?php

namespace App\Services;

class Common
{

    const DIMENSIONS = [
        28 => '120x60 / Button 2',
        46 => '120x600 / Skyscrape',
        29 => '120x240 / Vertical Banner',
        25 => '120x90 / Button 1',
        32 => '125x125 / Square Button',
        11 => '160x600 / Wide Skyscraper',
        10 => '180x150 / Rectangle',
        36 => '200x200 / Small Square',
        19 => '234x60 / Half Banner',
        5 => '240x400 / Vertical Rectangle',
        37 => '250x250 / Square Pop-Up',
        40 => '300x100 / 3:1 Rectangle',
        9 => '300x250 / Medium Rectangle',
        47 => '300x600 / Half-page Ad',
        52 => '315x300',
        35 => '320x100 / Large Mobile Banner',
        34 => '320x50 / Mobile Banner',
        48 => '320x480 / Mobile Interstitial',
        38 => '336x280 / Large Rectangle',
        1 => '468x60 / Full Banner',
        49 => '480x320',
        42 => '580x400 / Netboard',
        50 => '600x400',
        41 => '720x300 / Pop-Under',
        6 => '728x90 / Leaderboard',
        33 => '88x31 / Micro Bar',
        51 => '930x180 / Top Banner',
        20 => '970x90 / Large Leaderboard',
        21 => '970x250 / Billboard',
        24 => '980x120 / Panorama',
        666 => 'Custom'
    ];
    const DIMENSION_METHOD = [
        1 => 'Exact match',
        3 => 'Not wider than',
        4 => 'Not higher than',
        2 => 'Not larger than',
    ];
}
