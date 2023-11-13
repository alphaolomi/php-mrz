<?php

namespace Alphaolomi\Mrz;

/**
 * class Helper
 *
 * @author Evandro Kondrat
 * @package Alphaolomi\Mrz
 */
class Helper
{
    static function retiraAcentuacao(string $string)
    {

        return strtr(
            mb_convert_encoding($string, 'UTF-8', 'UTF-8'),
            mb_convert_encoding('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'UTF-8', 'UTF-8'),
            'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'
        );
    }

    static function transliterate(string $string)
    {
        $upper = mb_strtoupper(Helper::retiraAcentuacao($string));
        return str_replace(' ', '<', $upper);
    }

    static function field(string $string, int $str_length)
    {
        if (strlen($string) > $str_length) {
            throw new \Exception("LengthError");
        } else {
            return str_pad(mb_strtoupper(Helper::retiraAcentuacao($string)), $str_length, '<', STR_PAD_RIGHT);
        }
    }

    /**
     * >>> hash_string("ABCDEFGHIJKLMNOPQRSTUVWXYZ")
     * '7'
     * >>> hash_string("0123456789")
     * '7'
     * >>> hash_string("0123456789ABCDEF")
     * '0'
     * >>> hash_string("0")
     * '0'
     */
    static function hash_string(string $string)
    {
        $printable = '0123456789' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $upper = mb_strtoupper(Helper::retiraAcentuacao($string));
        $string_ready = str_replace('<', '0', $upper);

        $weight = [7, 3, 1];
        $summation = 0;

        $chars = str_split($string_ready);
        foreach ($chars as $key => $char) {
            $summation += strpos($printable, $char) * $weight[$key % 3];
        }
        return strval($summation % 10);
    }

    /**
     * @param string $string
     * @return string
     * @throws \Exception
     *
     * >>> sex("m")
     * 'M'
     *
     */
    static function sex(string $string)
    {
        if (strlen($string) != 1 || strpos("MmFf<", $string) === false) {
            throw new \Exception("Sex Error");
        }
        return mb_strtoupper($string);
    }

    /**
     * @param string $string
     * @return string
     * @throws \Exception
     *
     *
     */
    static function id(string $string)
    {
        $stringUpper = mb_strtoupper($string);
        if (strlen($string) > 2 || strpos("IiAaCc", $string[0]) === false) {
            throw new \Exception("ID Error:" . $string);
        }
        return str_pad($stringUpper, 2, '<', STR_PAD_RIGHT);
    }

    /**
     * @param string $string
     * @return string
     * @throws \Exception
     *
     * >>> country("alb")
     * 'ALB'
     * >>> country("yemen")
     * 'YEM'
     *
     */
    static function country(string $string)
    {
        $countries = [
            # Countries
            "Afghanistan" => "AFG",
            "Aland Islands" => "ALA",
            "Albania" => "ALB",
            "Algeria" => "DZA",
            "American Samoa" => "ASM",
            "Andorra" => "AND",
            "Angola" => "AGO",
            "Anguilla" => "AIA",
            "Antarctica" => "ATA",
            "Antigua And Barbuda" => "ATG",
            "Argentina" => "ARG",
            "Armenia" => "ARM",
            "Aruba" => "ABW",
            "Australia" => "AUS",
            "Austria" => "AUT",
            "Azerbaijan" => "AZE",
            "Bahamas" => "BHS",
            "Bahrain" => "BHR",
            "Bangladesh" => "BGD",
            "Barbados" => "BRB",
            "Belarus" => "BLR",
            "Belgium" => "BEL",
            "Belize" => "BLZ",
            "Benin" => "BEN",
            "Bermuda" => "BMU",
            "Bhutan" => "BTN",
            "Bolivia" => "BOL",
            "Bonaire, Sint Eustatius And Saba" => "BES",
            "Bosnia And Herzegovina" => "BIH",
            "Botswana" => "BWA",
            "Bouvet Island" => "BVT",
            "Brazil" => "BRA",
            "British Indian Ocean Territory" => "IOT",
            "Brunei" => "BRN",
            "Bulgaria" => "BGR",
            "Burkina Faso" => "BFA",
            "Burundi" => "BDI",
            "Cabo Verde" => "CPV",
            "Cambodia" => "KHM",
            "Cameroon" => "CMR",
            "Canada" => "CAN",
            "Cayman Islands" => "CYM",
            "Central African Republic" => "CAF",
            "Chad" => "TCD",
            "Chile" => "CHL",
            "China" => "CHN",
            "Christmas Island" => "CXR",
            "Cocos Islands" => "CCK",
            # "Keeling Islands" => "CCK",  # *
            "Colombia" => "COL",
            "Comoros" => "COM",
            "Congo" => "COG",
            "Democratic Republic Of The Congo" => "COD",
            "Cook Islands" => "COK",
            "Costa Rica" => "CRI",
            "Ivory Coast" => "CIV",
            "Croatia" => "HRV",
            "Cuba" => "CUB",
            "Curaçao" => "CUW",
            "Cyprus" => "CYP",
            "Czech Republic" => "CZE",
            "Denmark" => "DNK",
            "Djibouti" => "DJI",
            "Dominica" => "DMA",
            "Dominican Republic" => "DOM",
            "Ecuador" => "ECU",
            "Egypt" => "EGY",
            "El Salvador" => "SLV",
            "Equatorial Guinea" => "GNQ",
            "Eritrea" => "ERI",
            "Estonia" => "EST",
            "Ethiopia" => "ETH",
            "Falkland Islands" => "FLK",  # Sovereignty dispute between Argentina and United Kingdom
            "Faroe Islands" => "FRO",
            "Fiji" => "FJI",
            "Finland" => "FIN",
            "France" => "FRA",
            "French Guiana" => "GUF",
            "French Polynesia" => "PYF",
            "French Southern Territories" => "ATF",
            "Gabon" => "GAB",
            "Gambia" => "GMB",
            "Georgia" => "GEO",
            "Germany" => "D",
            "Ghana" => "GHA",
            "Gibraltar" => "GIB",
            "Greece" => "GRC",
            "Greenland" => "GRL",
            "Grenada" => "GRD",
            "Guadeloupe" => "GLP",
            "Guam" => "GUM",
            "Guatemala" => "GTM",
            "Guernsey" => "GGY",
            "Guinea" => "GIN",
            "Guinea Bissau" => "GNB",
            "Guyana" => "GUY",
            "Haiti" => "HTI",
            "Heard Island And Mcdonald Islands" => "HMD",
            # "Holy See" => "VAT",
            "Vatican City State" => "VAT",  # *
            "Honduras" => "HND",
            "Hong Kong" => "HKG",
            "Hungary" => "HUN",
            "Iceland" => "ISL",
            "India" => "IND",
            "Indonesia" => "IDN",
            "Iran" => "IRN",
            "Iraq" => "IRQ",
            "Ireland" => "IRL",
            "Isle Of Man" => "IMN",
            "Israel" => "ISR",
            "Italy" => "ITA",
            "Jamaica" => "JAM",
            "Japan" => "JPN",
            "Jersey" => "JEY",
            "Jordan" => "JOR",
            "Kazakhstan" => "KAZ",
            "Kenya" => "KEN",
            "Kiribati" => "KIR",
            "Kosovo" => "RKS",  # not ICAO-endorsed. Another Kosovo code below (see Organizations)
            "North Korea" => "PRK",
            "South Korea" => "KOR",
            "Kuwait" => "KWT",
            "Kyrgyzstan" => "KGZ",
            "Lao Democratic Republic" => "LAO",
            "Latvia" => "LVA",
            "Lebanon" => "LBN",
            "Lesotho" => "LSO",
            "Liberia" => "LBR",
            "Libya" => "LBY",
            "Liechtenstein" => "LIE",
            "Lithuania" => "LTU",
            "Luxembourg" => "LUX",
            "Macao" => "MAC",
            "Macedonia" => "MKD",
            "Madagascar" => "MDG",
            "Malawi" => "MWI",
            "Malaysia" => "MYS",
            "Maldives" => "MDV",
            "Mali" => "MLI",
            "Malta" => "MLT",
            "Marshall Islands" => "MHL",
            "Martinique" => "MTQ",
            "Mauritania" => "MRT",
            "Mauritius" => "MUS",
            "Mayotte" => "MYT",
            "Mexico" => "MEX",
            "Micronesia" => "FSM",
            "Moldova" => "MDA",
            "Monaco" => "MCO",
            "Mongolia" => "MNG",
            "Montenegro" => "MNE",
            "Montserrat" => "MSR",
            "Morocco" => "MAR",
            "Mozambique" => "MOZ",
            "Myanmar" => "MMR",
            "Namibia" => "NAM",
            "Nauru" => "NRU",
            "Nepal" => "NPL",
            "Netherlands" => "NLD",
            "Netherlands Antilles" => "ANT",
            "Neutral Zone" => "NTZ",
            "New Caledonia" => "NCL",
            "New Zealand" => "NZL",
            "Nicaragua" => "NIC",
            "Niger" => "NER",
            "Nigeria" => "NGA",
            "Niue" => "NIU",
            "Norfolk Island" => "NFK",
            "Northern Mariana Islands" => "MNP",
            "Norway" => "NOR",
            "Oman" => "OMN",
            "Pakistan" => "PAK",
            "Palau" => "PLW",
            "Palestine" => "PSE",
            "Panama" => "PAN",
            "Papua New Guinea" => "PNG",
            "Paraguay" => "PRY",
            "Peru" => "PER",
            "Philippines" => "PHL",
            "Pitcairn" => "PCN",
            "Poland" => "POL",
            "Portugal" => "PRT",
            "Puerto Rico" => "PRI",
            "Qatar" => "QAT",
            "Reunion" => "REU",
            "Romania" => "ROU",
            "Russia" => "RUS",
            "Rwanda" => "RWA",
            "Saint Barthelemy" => "BLM",
            "Saint Helena, Ascension And Tristan Da Cunha" => "SHN",
            "Saint Kitts And Nevis" => "KNA",
            "Saint Lucia" => "LCA",
            "Saint Martin" => "MAF",
            "Saint Pierre And Miquelon" => "SPM",
            "Saint Vincent And The Grenadines" => "VCT",
            "Samoa" => "WSM",
            "San Marino" => "SMR",
            "Sao Tome And Principe" => "STP",
            "Saudi Arabia" => "SAU",
            "Senegal" => "SEN",
            "Serbia" => "SRB",
            "Seychelles" => "SYC",
            "Sierra Leone" => "SLE",
            "Singapore" => "SGP",
            "Sint Maarten" => "SXM",
            "Slovakia" => "SVK",
            "Slovenia" => "SVN",
            "Solomon Islands" => "SLB",
            "Somalia" => "SOM",
            "South Africa" => "ZAF",
            "South Georgia And The South Sandwich Islands" => "SGS",
            "South Sudan" => "SSD",
            "Spain" => "ESP",
            "Sri Lanka" => "LKA",
            "Sudan" => "SDN",
            "Suriname" => "SUR",
            "Svalbard And Jan Mayen" => "SJM",
            "Swaziland" => "SWZ",
            "Sweden" => "SWE",
            "Switzerland" => "CHE",
            "Syria" => "SYR",
            "Taiwan" => "TWN",
            "Tajikistan" => "TJK",
            "Tanzania" => "TZA",
            "Thailand" => "THA",
            "East Timor" => "TLS",
            "Togo" => "TGO",
            "Tokelau" => "TKL",
            "Tonga" => "TON",
            "Trinidad And Tobago" => "TTO",
            "Tunisia" => "TUN",
            "Turkey" => "TUR",
            "Turkmenistan" => "TKM",
            "Turks And Caicos Islands" => "TCA",
            "Tuvalu" => "TUV",
            "Uganda" => "UGA",
            "Ukraine" => "UKR",
            "Arab Emirates" => "ARE",
            "United Kingdom" => "GB",
            "British" => "GBR",
            "British Overseas Territories" => "GBD",
            "British National Overseas" => "GBN",
            "British Overseas Citizen" => "GBO",
            "British Protected" => "GBP",
            "British Subject" => "GBS",
            "United States" => "USA",
            "United States Minor Outlying Islands" => "UMI",
            "Uruguay" => "URY",
            "Utopia" => "UTO",  # ICAO Example. Not real country
            "Uzbekistan" => "UZB",
            "Vanuatu" => "VUT",
            "Venezuela" => "VEN",
            "Vietnam" => "VNM",
            "Virgin Islands" => "VGB",
            "Virgin Islands Of The United States" => "VIR",
            "Wallis And Futuna" => "WLF",
            "Western Sahara" => "ESH",
            "Yemen" => "YEM",
            "Zambia" => "ZMB",
            "Zimbabwe" => "ZWE",

            # Organizations
            "European Union" => "EUE",
            "United Nations Organization" => "UNO",
            "United Nations Agency" => "UNA",
            "Kosovo UN" => "UNK",  # ceased being issued in 2008. Another Kosovo code above (See countries)
            "World Service Authority" => "WSA",
            "African Development Bank" => "XBA",
            "Afrexim" => "XIM",
            "Caricom" => "XCC",
            "Comesa" => "XCO",
            "Ecowas" => "XEC",
            "Interpol" => "INP",
            "International Criminal Police Organization" => "XPO",
            "Military Order Of Malta" => "XOM",

            # Others
            "Refugee A" => "XXA",  # Stateless
            "Refugee B" => "XXB",
            "Refugee C" => "XXC",
            "Unknown" => "XXX"
        ];


        $ucContry = ucwords(mb_strtolower($string));
        if (in_array(mb_strtoupper($string), $countries)) {
            return str_pad(mb_strtoupper($string), 3, '<', STR_PAD_RIGHT);
        } elseif (array_key_exists($ucContry, $countries)) {
            return str_pad($countries[$ucContry], 3, '<', STR_PAD_RIGHT);
        } else {
            throw new \Exception("Country Error:" . $ucContry);
        }
    }

    static function str_contains($haystack, $needle)
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }

    static function break_full_name(string $fullName, string $filiation1 = "", string $filiation2 = ""): array
    {
        $fullNameArr = explode(' ', $fullName);
        $sizeArr = sizeof($fullNameArr);

        // remove first name
        $filiationLastNames1 = strstr($filiation1, " ");
        $filiationLastNames2 = strstr($filiation2, " ");
        if ($sizeArr == 2) {
            return [$fullNameArr[0], $fullNameArr[1]];
        } else if ($sizeArr > 2) {
            $given_names = $fullNameArr[0];
            $surnameFixed = $fullNameArr[$sizeArr - 1];

            $remainingArr = array_values(array_diff($fullNameArr, [$given_names]));
            $remainingArr = array_values(array_diff($remainingArr, [$surnameFixed]));

            $shorten = false;
            $addToSurname = false;
            $surnameTemp = "";
            while (sizeof($remainingArr) != 0) {
                $remainingSize = 28 - strlen($given_names) - strlen($surnameTemp . $surnameFixed);
                $tempStr = implode(" ", $remainingArr);

                if (strlen($tempStr) >= $remainingSize) {
                    $shorten = true;
                }

                $chunk = $remainingArr[0];
                $remainingArr = array_values(array_diff($remainingArr, [$chunk]));

                if ($shorten) {
                    $chunkHandle = $chunk[0];
                } else {
                    $chunkHandle = $chunk;
                }

                if ($addToSurname || self::str_contains($filiationLastNames1, $chunk) || self::str_contains($filiationLastNames2, $chunk)) {
                    // once added to the surname, everything else will be
                    $addToSurname = true;
                    $surnameTemp .= $chunkHandle . " ";
                } else {
                    $given_names .= " " . $chunkHandle;
                }
            }

            return [$given_names, $surnameTemp . $surnameFixed];
        } else {
            return [$fullName, ""];
        }
    }
}
