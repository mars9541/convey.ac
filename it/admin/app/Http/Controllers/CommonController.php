<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class CommonController extends Controller {

    public static function EncryptNI($NI_Number)
    {
        if(empty($NI_Number)) return 0;

        if(strlen($NI_Number) > 9) {
            $hex = self::ConvertEncryptString($NI_Number);
            return $hex.'0000';
        } else {
            $hex = self::ConvertEncryptString($NI_Number);
            $double_hex = self::ConvertEncryptString($hex + 1990032319910105);

            return $double_hex;
        }

    }

    public static function DecryptNI($double_hex)
    {
        if(empty($double_hex)) return '';

        $sub_str = substr($double_hex, strlen($double_hex) - 4, 4);
        if($sub_str == '0000') {
            $double_hex = substr($double_hex, 0, strlen($double_hex) - 4);
            $first_bin = self::ConvertDecryptString($double_hex);

            return $first_bin;
        } else {
            if (ctype_xdigit($double_hex) && strlen($double_hex) % 2 == 0) {
                $first_bin = self::ConvertDecryptString($double_hex);
                if($first_bin != "") {
                    $bin = self::ConvertDecryptString($first_bin - 1990032319910105);
                } else {
                    return '';
                }

                return $bin;
            } else {
                return '';
            }
        }


    }

    public static function ConvertEncryptString($ni_number)
    {
        $alphabet = array('A' => '11', 'C' => '21', 'D' => '31', 'E' => '42', 'F' => '52', 'G' => '62', 'H' => '73', 'I' => '83', 'J' => '93',
            'K' => '14', 'L' => '24', 'M' => '34', 'N' => '45', 'O' => '55', 'P' => '65', 'Q' => '76', 'R' => '86', 'S' => '96',
            'T' => '17', 'U' => '27', 'V' => '37', 'W' => '48', 'X' => '58', 'Y' => '68', 'Z' => '79', 'a' => '89', 'b' => '99',
            'c' => '12', 'd' => '22', 'e' => '32', 'f' => '43', 'g' => '53', 'h' => '63', 'i' => '74', 'j' => '84', 'k' => '94',
            'l' => '15', 'm' => '25', 'n' => '35', 'o' => '46', 'p' => '57', 'q' => '67', 'r' => '78', 's' => '88', 't' => '98',
            'u' => '19', 'v' => '29', 'w' => '39', 'x' => '40', 'y' => '50', 'z' => '60', '0' => '71', '1' => '81', '2' => '91',
            '3' => '10', '4' => '13', '5' => '16', '6' => '18', '7' => '20', '8' => '23', '9' => '26', 'B' => '28'
        );

        $return_str = "";
        for($i = 0; $i < strlen($ni_number); $i++) {
            $sub_str = substr($ni_number, $i, 1);
            $return_str .= $alphabet[$sub_str];
        }

        return $return_str;
    }

    public static function ConvertDecryptString($encrypt_str)
    {
        $alphabet = array('A' => '11', 'C' => '21', 'D' => '31', 'E' => '42', 'F' => '52', 'G' => '62', 'H' => '73', 'I' => '83', 'J' => '93',
            'K' => '14', 'L' => '24', 'M' => '34', 'N' => '45', 'O' => '55', 'P' => '65', 'Q' => '76', 'R' => '86', 'S' => '96',
            'T' => '17', 'U' => '27', 'V' => '37', 'W' => '48', 'X' => '58', 'Y' => '68', 'Z' => '79', 'a' => '89', 'b' => '99',
            'c' => '12', 'd' => '22', 'e' => '32', 'f' => '43', 'g' => '53', 'h' => '63', 'i' => '74', 'j' => '84', 'k' => '94',
            'l' => '15', 'm' => '25', 'n' => '35', 'o' => '46', 'p' => '57', 'q' => '67', 'r' => '78', 's' => '88', 't' => '98',
            'u' => '19', 'v' => '29', 'w' => '39', 'x' => '40', 'y' => '50', 'z' => '60', '0' => '71', '1' => '81', '2' => '91',
            '3' => '10', '4' => '13', '5' => '16', '6' => '18', '7' => '20', '8' => '23', '9' => '26', 'B' => '28'
        );

        $return_str = "";
        for($i = 0; $i < strlen($encrypt_str); $i += 2) {
            $sub_str = substr($encrypt_str, $i, 2);
            $key = array_search($sub_str, $alphabet);

            if (false !== $key) {
                $return_str .= $key;
            } else {
                return '';
            }
        }

        return $return_str;
    }

    public static function countriesArray()
    {
        return array('AF'=>'Afghanistan',
            'AX'=>'Åland Islands',
            'AL'=>'Albania',
            'DZ'=>'Algeria',
            'AS'=>'American Samoa',
            'AD'=>'Andorra',
            'AO'=>'Angola',
            'AI'=>'Anguilla',
            'AQ'=>'Antarctica',
            'AG'=>'Antigua and Barbuda',
            'AR'=>'Argentina',
            'AM'=>'Armenia',
            'AW'=>'Aruba',
            'AU'=>'Australia',
            'AT'=>'Austria',
            'AZ'=>'Azerbaijan',
            'BS'=>'Bahamas',
            'BH'=>'Bahrain',
            'BD'=>'Bangladesh',
            'BB'=>'Barbados',
            'BY'=>'Belarus',
            'BE'=>'Belgium',
            'BZ'=>'Belize',
            'BJ'=>'Benin',
            'BM'=>'Bermuda',
            'BT'=>'Bhutan',
            'BO'=>'Bolivia, Plurinational State of',
            'BQ'=>'Bonaire, Sint Eustatius and Saba',
            'BA'=>'Bosnia and Herzegovina',
            'BW'=>'Botswana',
            'BV'=>'Bouvet Island',
            'BR'=>'Brazil',
            'IO'=>'British Indian Ocean Territory',
            'BN'=>'Brunei Darussalam',
            'BG'=>'Bulgaria',
            'BF'=>'Burkina Faso',
            'BI'=>'Burundi',
            'KH'=>'Cambodia',
            'CM'=>'Cameroon',
            'CA'=>'Canada',
            'CV'=>'Cape Verde',
            'KY'=>'Cayman Islands',
            'CF'=>'Central African Republic',
            'TD'=>'Chad',
            'CL'=>'Chile',
            'CN'=>'China',
            'CX'=>'Christmas Island',
            'CC'=>'Cocos (Keeling) Islands',
            'CO'=>'Colombia',
            'KM'=>'Comoros',
            'CG'=>'Congo',
            'CD'=>'Congo, the Democratic Republic of the',
            'CK'=>'Cook Islands',
            'CR'=>'Costa Rica',
            'CI'=>'Côte d\'Ivoire',
            'HR'=>'Croatia',
            'CU'=>'Cuba',
            'CW'=>'Curaçao',
            'CY'=>'Cyprus',
            'CZ'=>'Czech Republic',
            'DK'=>'Denmark',
            'DJ'=>'Djibouti',
            'DM'=>'Dominica',
            'DO'=>'Dominican Republic',
            'EC'=>'Ecuador',
            'EG'=>'Egypt',
            'SV'=>'El Salvador',
            'GQ'=>'Equatorial Guinea',
            'ER'=>'Eritrea',
            'EE'=>'Estonia',
            'ET'=>'Ethiopia',
            'FK'=>'Falkland Islands (Malvinas)',
            'FO'=>'Faroe Islands',
            'FJ'=>'Fiji',
            'FI'=>'Finland',
            'FR'=>'France',
            'GF'=>'French Guiana',
            'PF'=>'French Polynesia',
            'TF'=>'French Southern Territories',
            'GA'=>'Gabon',
            'GM'=>'Gambia',
            'GE'=>'Georgia',
            'DE'=>'Germany',
            'GH'=>'Ghana',
            'GI'=>'Gibraltar',
            'GR'=>'Greece',
            'GL'=>'Greenland',
            'GD'=>'Grenada',
            'GP'=>'Guadeloupe',
            'GU'=>'Guam',
            'GT'=>'Guatemala',
            'GG'=>'Guernsey',
            'GN'=>'Guinea',
            'GW'=>'Guinea-Bissau',
            'GY'=>'Guyana',
            'HT'=>'Haiti',
            'HM'=>'Heard Island and McDonald Islands',
            'VA'=>'Holy See (Vatican City State)',
            'HN'=>'Honduras',
            'HK'=>'Hong Kong',
            'HU'=>'Hungary',
            'IS'=>'Iceland',
            'IN'=>'India',
            'ID'=>'Indonesia',
            'IR'=>'Iran, Islamic Republic of',
            'IQ'=>'Iraq',
            'IE'=>'Ireland',
            'IM'=>'Isle of Man',
            'IL'=>'Israel',
            'IT'=>'Italy',
            'JM'=>'Jamaica',
            'JP'=>'Japan',
            'JE'=>'Jersey',
            'JO'=>'Jordan',
            'KZ'=>'Kazakhstan',
            'KE'=>'Kenya',
            'KI'=>'Kiribati',
            'KP'=>'Korea, Democratic People\'s Republic of',
            'KR'=>'Korea, Republic of',
            'KW'=>'Kuwait',
            'KG'=>'Kyrgyzstan',
            'LA'=>'Lao People\'s Democratic Republic',
            'LV'=>'Latvia',
            'LB'=>'Lebanon',
            'LS'=>'Lesotho',
            'LR'=>'Liberia',
            'LY'=>'Libya',
            'LI'=>'Liechtenstein',
            'LT'=>'Lithuania',
            'LU'=>'Luxembourg',
            'MO'=>'Macao',
            'MK'=>'Macedonia, the former Yugoslav Republic of',
            'MG'=>'Madagascar',
            'MW'=>'Malawi',
            'MY'=>'Malaysia',
            'MV'=>'Maldives',
            'ML'=>'Mali',
            'MT'=>'Malta',
            'MH'=>'Marshall Islands',
            'MQ'=>'Martinique',
            'MR'=>'Mauritania',
            'MU'=>'Mauritius',
            'YT'=>'Mayotte',
            'MX'=>'Mexico',
            'FM'=>'Micronesia, Federated States of',
            'MD'=>'Moldova, Republic of',
            'MC'=>'Monaco',
            'MN'=>'Mongolia',
            'ME'=>'Montenegro',
            'MS'=>'Montserrat',
            'MA'=>'Morocco',
            'MZ'=>'Mozambique',
            'MM'=>'Myanmar',
            'NA'=>'Namibia',
            'NR'=>'Nauru',
            'NP'=>'Nepal',
            'NL'=>'Netherlands',
            'NC'=>'New Caledonia',
            'NZ'=>'New Zealand',
            'NI'=>'Nicaragua',
            'NE'=>'Niger',
            'NG'=>'Nigeria',
            'NU'=>'Niue',
            'NF'=>'Norfolk Island',
            'MP'=>'Northern Mariana Islands',
            'NO'=>'Norway',
            'OM'=>'Oman',
            'PK'=>'Pakistan',
            'PW'=>'Palau',
            'PS'=>'Palestinian Territory, Occupied',
            'PA'=>'Panama',
            'PG'=>'Papua New Guinea',
            'PY'=>'Paraguay',
            'PE'=>'Peru',
            'PH'=>'Philippines',
            'PN'=>'Pitcairn',
            'PL'=>'Poland',
            'PT'=>'Portugal',
            'PR'=>'Puerto Rico',
            'QA'=>'Qatar',
            'RE'=>'Réunion',
            'RO'=>'Romania',
            'RU'=>'Russian Federation',
            'RW'=>'Rwanda',
            'BL'=>'Saint Barthélemy',
            'SH'=>'Saint Helena, Ascension and Tristan da Cunha',
            'KN'=>'Saint Kitts and Nevis',
            'LC'=>'Saint Lucia',
            'MF'=>'Saint Martin (French part)',
            'PM'=>'Saint Pierre and Miquelon',
            'VC'=>'Saint Vincent and the Grenadines',
            'WS'=>'Samoa',
            'SM'=>'San Marino',
            'ST'=>'Sao Tome and Principe',
            'SA'=>'Saudi Arabia',
            'SN'=>'Senegal',
            'RS'=>'Serbia',
            'SC'=>'Seychelles',
            'SL'=>'Sierra Leone',
            'SG'=>'Singapore',
            'SX'=>'Sint Maarten (Dutch part)',
            'SK'=>'Slovakia',
            'SI'=>'Slovenia',
            'SB'=>'Solomon Islands',
            'SO'=>'Somalia',
            'ZA'=>'South Africa',
            'GS'=>'South Georgia and the South Sandwich Islands',
            'SS'=>'South Sudan',
            'ES'=>'Spain',
            'LK'=>'Sri Lanka',
            'SD'=>'Sudan',
            'SR'=>'Suriname',
            'SJ'=>'Svalbard and Jan Mayen',
            'SZ'=>'Swaziland',
            'SE'=>'Sweden',
            'CH'=>'Switzerland',
            'SY'=>'Syrian Arab Republic',
            'TW'=>'Taiwan, Province of China',
            'TJ'=>'Tajikistan',
            'TZ'=>'Tanzania, United Republic of',
            'TH'=>'Thailand',
            'TL'=>'Timor-Leste',
            'TG'=>'Togo',
            'TK'=>'Tokelau',
            'TO'=>'Tonga',
            'TT'=>'Trinidad and Tobago',
            'TN'=>'Tunisia',
            'TR'=>'Turkey',
            'TM'=>'Turkmenistan',
            'TC'=>'Turks and Caicos Islands',
            'TV'=>'Tuvalu',
            'UG'=>'Uganda',
            'UA'=>'Ukraine',
            'AE'=>'United Arab Emirates',
            'GB'=>'United Kingdom',
            'US'=>'United States',
            'UM'=>'United States Minor Outlying Islands',
            'UY'=>'Uruguay',
            'UZ'=>'Uzbekistan',
            'VU'=>'Vanuatu',
            'VE'=>'Venezuela, Bolivarian Republic of',
            'VN'=>'Viet Nam',
            'VG'=>'Virgin Islands, British',
            'VI'=>'Virgin Islands, U.S.',
            'WF'=>'Wallis and Futuna',
            'EH'=>'Western Sahara',
            'YE'=>'Yemen',
            'ZM'=>'Zambia',
            'ZW'=>'Zimbabwe');
    }

}
