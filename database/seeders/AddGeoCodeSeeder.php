<?php

namespace Database\Seeders;

use App\Models\National;
use Illuminate\Database\Seeder;

class AddGeoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geo_codes = array(
            "United Arab Emirates" => "ae",
            "Afghanistan" => "af",
            "Armenia" => "am",
            "Azerbaijan" => "az",
            "Bangladesh" => "bd",
            "Bahrain" => "bh",
            "Brunei" => "bn",
            "Bhutan" => "bt",
            "China" => "cn",
            "Georgia" => "ge",
            "Hong Kong" => "hk",
            "Indonesia" => "id",
            "Israel" => "il",
            "India" => "in",
            "Iraq" => "iq",
            "Iran" => "ir",
            "Jordan" => "jo",
            "Japan" => "jp",
            "Kyrgyzstan" => "kg",
            "Cambodia" => "kh",
            "North Korea" => "kp",
            "South Korea" => "kr",
            "Kuwait" => "kw",
            "Kazakhstan" => "kz",
            "Laos" => "la",
            "Lebanon" => "lb",
            "Sri Lanka" => "lk",
            "Myanmar" => "mm",
            "Mongolia" => "mn",
            "Macao" => "mo",
            "Maldives" => "mv",
            "Malaysia" => "my",
            "Nepal" => "np",
            "Oman" => "om",
            "Philippines" => "ph",
            "Pakistan" => "pk",
            "Palestine" => "ps",
            "Qatar" => "qa",
            "Russia" => "ru",
            "Saudi Arabia" => "sa",
            "Singapore" => "sg",
            "Syria" => "sy",
            "Thailand" => "th",
            "Tajikistan" => "tj",
            "Timor-Leste" => "tl",
            "Turkmenistan" => "tm",
            "Turkey" => "tr",
            "Taiwan" => "tw",
            "Uzbekistan" => "uz",
            "Vietnam" => "vn",
            "Yemen" => "ye",
            "Andorra" => "ad",
            "Albania" => "al",
            "Austria" => "at",
            "Bosnia and Herzegovina" => "ba",
            "Belgium" => "be",
            "Bulgaria" => "bg",
            "Belarus" => "by",
            "Switzerland" => "ch",
            "Cyprus" => "cy",
            "Czechia" => "cz",
            "Germany" => "de",
            "Denmark" => "dk",
            "Estonia" => "ee",
            "Spain" => "es",
            "Finland" => "fi",
            "France" => "fr",
            "United Kingdom" => "gb",
            "Greece" => "gr",
            "Croatia" => "hr",
            "Hungary" => "hu",
            "Ireland" => "ie",
            "Iceland" => "is",
            "Italy" => "it",
            "Lithuania" => "lt",
            "Luxembourg" => "lu",
            "Latvia" => "lv",
            "Monaco" => "mc",
            "Moldova" => "md",
            "Montenegro" => "me",
            "North Macedonia" => "mk",
            "Malta" => "mt",
            "Netherlands" => "nl",
            "Norway" => "no",
            "Poland" => "pl",
            "Portugal" => "pt",
            "Romania" => "ro",
            "Serbia" => "rs",
            "Sweden" => "se",
            "Slovenia" => "si",
            "Slovakia" => "sk",
            "San Marino" => "sm",
            "Ukraine" => "ua",
            "Vatican City" => "va",
            "Angola" => "ao",
            "Burkina Faso" => "bf",
            "Burundi" => "bi",
            "Benin" => "bj",
            "Botswana" => "bw",
            "DR Congo" => "cd",
            "Central African Republic" => "cf",
            "Zimbabwe" => "zw",
            "Samoa" => "ws",
            "Wallis and Futuna" => "wf",
            "Vanuatu" => "vu",
            "U.S. Outlying Islands" => "um",
            "Tuvalu" => "tv",
            "Tonga" => "to",
            "Tokelau" => "tk",
            "French Southern Territories" => "tf",
            "Svalbard and Jan Mayen" => "sj",
            "Saint Helena" => "sh",
            "Solomon Islands" => "sb",
            "Réunion" => "re",
            "Palau" => "pw",
            "Pitcairn Islands" => "pn",
            "Papua New Guinea" => "pg",
            "French Polynesia" => "pf",
            "New Zealand" => "nz",
            "Niue" => "nu",
            "Nauru" => "nr",
            "Norfolk Island" => "nf",
            "New Caledonia" => "nc",
            "Northern Mariana Islands" => "mp",
            "Marshall Islands" => "mh",
            "Kiribati" => "ki",
            "British Indian Ocean Territory" => "io",
            "Heard and McDonald Islands" => "hm",
            "Guam" => "gu",
            "Federated States of Micronesia" => "fm",
            "Fiji" => "fj",
            "Christmas Island" => "cx",
            "Cook Islands" => "ck",
            "Cocos (Keeling) Islands" => "cc",
            "Bouvet Island" => "bv",
            "Australia" => "au",
            "American Samoa" => "as",
            "Venezuela" => "ve",
            "Uruguay" => "uy",
            "Suriname" => "sr",
            "Paraguay" => "py",
            "Peru" => "pe",
            "Guyana" => "gy",
            "South Georgia and the South Sandwich Islands" => "gs",
            "French Guiana" => "gf",
            "Falkland Islands" => "fk",
            "Ecuador" => "ec",
            "Colombia" => "co",
            "Chile" => "cl",
            "Brazil" => "br",
            "Bolivia" => "bo",
            "Argentina" => "ar",
            "U.S. Virgin Islands" => "vi",
            "British Virgin Islands" => "vg",
            "St Vincent and Grenadines" => "vc",
            "United States" => "us",
            "Trinidad and Tobago" => "tt",
            "Turks and Caicos Islands" => "tc",
            "Sint Maarten" => "sx",
            "El Salvador" => "sv",
            "Puerto Rico" => "pr",
            "Saint Pierre and Miquelon" => "pm",
            "Panama" => "pa",
            "Nicaragua" => "ni",
            "Mexico" => "mx",
            "Montserrat" => "ms",
            "Martinique" => "mq",
            "Saint Martin" => "mf",
            "Saint Lucia" => "lc",
            "Cayman Islands" => "ky",
            "St Kitts and Nevis" => "kn",
            "Jamaica" => "jm",
            "Haiti" => "ht",
            "Honduras" => "hn",
            "Guatemala" => "gt",
            "Guadeloupe" => "gp",
            "Greenland" => "gl",
            "Grenada" => "gd",
            "Dominican Republic" => "do",
            "Dominica" => "dm",
            "Curaçao" => "cw",
            "Cuba" => "cu",
            "Costa Rica" => "cr",
            "Canada" => "ca",
            "Belize" => "bz",
            "Bahamas" => "bs",
            "Bonaire" => "bq",
            "Bermuda" => "bm",
            "Saint Barthélemy" => "bl",
            "Barbados" => "bb",
            "Aruba" => "aw",
            "Anguilla" => "ai",
            "Antigua and Barbuda" => "ag",
            "Zambia" => "zm",
            "South Africa" => "za",
            "Mayotte" => "yt",
            "Uganda" => "ug",
            "Tanzania" => "tz",
            "Tunisia" => "tn",
            "Togo" => "tg",
            "Chad" => "td",
            "Eswatini" => "sz",
            "São Tomé and Príncipe" => "st",
            "South Sudan" => "ss",
            "Somalia" => "so",
            "Senegal" => "sn",
            "Sierra Leone" => "sl",
            "Sudan" => "sd",
            "Seychelles" => "sc",
            "Rwanda" => "rw",
            "Nigeria" => "ng",
            "Niger" => "ne",
            "Namibia" => "na",
            "Mozambique" => "mz",
            "Malawi" => "mw",
            "Mauritius" => "mu",
            "Mauritania" => "mr",
            "Mali" => "ml",
            "Madagascar" => "mg",
            "Morocco" => "ma",
            "Libya" => "ly",
            "Lesotho" => "ls",
            "Liberia" => "lr",
            "Comoros" => "km",
            "Kenya" => "ke",
            "Guinea-Bissau" => "gw",
            "Equatorial Guinea" => "gq",
            "Guinea" => "gn",
            "Gambia" => "gm",
            "Ghana" => "gh",
            "Gabon" => "ga",
            "Ethiopia" => "et",
            "Eritrea" => "er",
            "Western Sahara" => "eh",
            "Egypt" => "eg",
            "Algeria" => "dz",
            "Djibouti" => "dj",
            "Cabo Verde" => "cv",
            "Cameroon" => "cm",
            "Ivory Coast" => "ci",
            "Congo Republic" => "cg",
            "Liechtenstein" => "li",
            "Gibraltar" => "gi",
            "Guernsey" => "gg",
            "Faroe Islands" => "fo",
            "Åland Islands" => "ax"
        );
        $items = National::all();
        foreach ($items as $item)
        {
            $item->code = $geo_codes[$item->name] ?? null;
            $item->save();
        }
        return true;
    }
}
