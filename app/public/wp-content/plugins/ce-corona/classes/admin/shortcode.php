<?php
/**
 * Settings Class
 * 
 * @package Corona
 */
namespace CoderExpert\Corona;

defined( 'ABSPATH' ) or exit;

class Shortcode {
    public static function init() {
        Loader::add_action( 'wp_enqueue_scripts', __CLASS__, 'scripts' );
        add_shortcode( 'ce_corona', [ __CLASS__, 'display' ] );
        add_shortcode( 'cec_corona', [ __CLASS__, 'display_country' ] );
    }
    public static function scripts( $hook ){
        $suffix = ! ( defined('CORONA_DEV') && CORONA_DEV ) ? '.min' : '';
        wp_register_style( 'ce-corona', 
            CE_CORONA_ASSETS . 'css/corona.css', [], 
            \filemtime( CE_CORONA_PATH . 'assets/css/corona.css' ), 'all' 
        );
        wp_register_style( 'ce-corona-wp-widget', 
            CE_CORONA_ASSETS . 'css/corona-wp-widget.css', [], 
            \filemtime( CE_CORONA_PATH . 'assets/css/corona-wp-widget.css' ), 'all' 
        );
        wp_register_script( 'ce-corona-jcountto', 
            CE_CORONA_ASSETS . 'js/jquery-countTo.js', 
            [ 'jquery' ], 
            \filemtime( CE_CORONA_PATH . 'assets/js/jquery-countTo.js' ), true 
        );
        wp_register_script( 'ce-corona-wp-widget', 
            CE_CORONA_ASSETS . 'js/widget'. $suffix .'.js', 
            [ 'jquery', 'ce-corona-jcountto' ], 
            \filemtime( CE_CORONA_PATH . 'assets/js/widget'. $suffix .'.js' ), true 
        );
        wp_register_script( 'ce-corona', 
            CE_CORONA_ASSETS . 'js/corona'. $suffix .'.js', 
            [ 'jquery', 'wp-i18n', 'wp-components' ], 
            \filemtime( CE_CORONA_PATH . 'assets/js/corona'. $suffix .'.js' ), true 
        );

        wp_register_style( 'ce-elementor-country-corona', 
			CE_CORONA_ASSETS . 'css/corona-countrywise.css', [], 
			\filemtime( CE_CORONA_PATH . 'assets/css/corona-countrywise.css' ), 'all' 
		);
		wp_register_script( 'ce-elementor-corona-nformat', 
			CE_CORONA_ASSETS . 'js/ce-numberformat.js', 
			[ 'jquery' ], 
			\filemtime( CE_CORONA_PATH . 'assets/js/ce-numberformat.js' ), true 
		);
		wp_register_script( 'ce-elementor-country-corona', 
			CE_CORONA_ASSETS . 'js/countrywise'. $suffix .'.js', 
			[ 'jquery', 'wp-i18n', 'ce-elementor-corona-nformat' ], 
			\filemtime( CE_CORONA_PATH . 'assets/js/countrywise'. $suffix .'.js' ), true 
        );
        wp_set_script_translations( 'ce-corona', 'ce-corona', plugin_dir_path( CE_CORONA_FILE ) . 'languages' );
        self::coronaTableTranslate();
    }

    public static function coronaTableTranslate ( $key = 'ce-corona' ){
        wp_localize_script( $key, 'CeCoronaDataTable', array(
            'last_update'     => __( 'Last Updated', 'ce-corona' ),
            'flag'            => __( 'Flag', 'ce-corona' ),
            'country'         => __( 'Country', 'ce-corona' ),
            'state'           => __( 'States', 'ce-corona' ),
            'total_cases'     => __( 'Total Cases', 'ce-corona' ),
            'new_cases'       => __( 'New Cases', 'ce-corona' ),
            'total_deaths'    => __( 'Total Deaths', 'ce-corona' ),
            'new_deaths'      => __( 'New Deaths', 'ce-corona' ),
            'total_recovered' => __( 'Total Recovered', 'ce-corona' ),
            'active_case'     => __( 'Active', 'ce-corona' ),
            'in_critical'     => __( 'Critical', 'ce-corona' ),
            'total_tests'     => __( 'Total Tests', 'ce-corona' ),
            'tests_per_m'     => __( 'Tests/1M', 'ce-corona' ),
            'case_per_m'     => __( 'Case/1M', 'ce-corona' ),
            'deaths_per_m'     => __( 'Deaths/1M', 'ce-corona' ),
            'date'            => __( 'Date', 'ce-corona' )
        ));
    }

    public static function display( $atts, $content = null ) {
        wp_enqueue_style( 'ce-corona' );
        wp_enqueue_script( 'ce-corona' );

        \extract( shortcode_atts( array(
            'compareCountry'  => true,
            'now'             => true,
            'data_table'      => true,
            'global_data'     => true,
            'lastupdate'      => true,
            'countries'       => '',
            'table_style'     => 'default',
            'button_position' => 'above_data_table',
            'stats_title'     => __( 'Total Stats', 'ce-corona' ),
            'compare_text'    => __( 'Compare Data by Country', 'ce-corona' ),
            'recent_text'     => __( 'Recent', 'ce-corona' ),
            'affected_title'  => __( 'Affected Countries', 'ce-corona' ),
            'active_title'    => __( 'Active Cases', 'ce-corona' ),
            'deaths_title'    => __( 'Total Deaths', 'ce-corona' ),
            'confirmed_title' => __( 'Confirmed Cases', 'ce-corona' ),
            'recovered_title' => __( 'Total Recovered', 'ce-corona' ),
        ), $atts, 'ce_corona') );

        wp_localize_script( 'ce-corona', 'CeCorona', array(
            'logo'            => CE_CORONA_ASSETS . 'images/logo.png',
            'coronaBG'        => CE_CORONA_ASSETS . 'images/corona-bg.jpg',
            'compareCountry'  => $compareCountry == "true",
            'now'             => $now == "true",
            'countries'       => trim( str_replace(' ', '', $countries), " ,"),
            'data_table'      => $data_table == "true",
            'global_data'     => $global_data == "true",
            'lastupdate'      => $lastupdate == "true",
            'stats_title'     => __( $stats_title, 'ce-corona' ),
            'recent_text'     => __( $recent_text, 'ce-corona' ),
            'compare_text'    => __( $compare_text, 'ce-corona' ),
            'affected_title'  => __( $affected_title, 'ce-corona' ),
            'active_title'    => __( $active_title, 'ce-corona' ),
            'deaths_title'    => __( $deaths_title, 'ce-corona' ),
            'confirmed_title' => __( $confirmed_title, 'ce-corona' ),
            'recovered_title' => __( $recovered_title, 'ce-corona' ),
            'button_position' => $button_position,
            'table_style'     => $table_style,
        ) );

        return '<div id="ce-corona" class="alignwide"><div>';
    }

    public static function display_country( $atts, $content = null ){
        wp_enqueue_style( 'ce-elementor-country-corona' );
        wp_enqueue_script( 'ce-elementor-corona-nformat' );
        wp_enqueue_script( 'ce-elementor-country-corona' );
        self::coronaTableTranslate( 'ce-elementor-country-corona' );

        $items = [ 'update_time', 'confirmed', 'recovered', 'deaths', 'todayCases', 'active', 'critical', 'todayDeaths', 'case_per_m', 'deaths_per_m', 'tests', 'tests_per_m' ];

        \extract( shortcode_atts( array(
            'country_code'       => 'US',
            'flag'               => true,
            'states'             => false,
            'table_style'        => 'default',
            'active_items'       => \implode(',', $items),
            'updated_title'      => __( 'Last Updated', 'ce-corona' ),
            'active_title'       => __( 'Active Cases', 'ce-corona' ),
            'deaths_title'       => __( 'Total Deaths', 'ce-corona' ),
            'todayDeaths_title'  => __( 'New Deaths', 'ce-corona' ),
            'new_case_title'     => __( 'New Case', 'ce-corona' ),
            'confirmed_title'    => __( 'Confirmed Cases', 'ce-corona' ),
            'recovered_title'    => __( 'Total Recovered', 'ce-corona' ),
            'critical_title'     => __( 'in Critical', 'ce-corona' ),
            'case_per_m_title'   => __( 'Case/1M', 'ce-corona' ),
            'deaths_per_m_title' => __( 'Deaths/1M', 'ce-corona' ),
            'tests_title'        => __( 'Total Tests', 'ce-corona' ),
            'tests_per_m_title'  => __( 'Tests/1M', 'ce-corona' ),
        ), $atts, 'ce_corona') );

        wp_localize_script( 'ce-elementor-country-corona', 'CeCorona', array(
            'logo'            => CE_CORONA_ASSETS . 'images/logo.png',
            'coronaBG'        => CE_CORONA_ASSETS . 'images/corona-bg.jpg',
            'compareCountry'  => "true",
            'table_style'     => $table_style,
            'now'             => "true",
            'data_table'      => "true",
            'global_data'     => "true",
            'lastupdate'      => "true",
            'stats_title'     => __( 'Total Stats', 'ce-corona' ),
            'recent_text'     => __( 'Recent', 'ce-corona' ),
            'compare_text'    => __( 'Compare By Country', 'ce-corona' ),
            'affected_title'  => __( 'Affected Countries', 'ce-corona' ),
            'active_title'    => __( $active_title, 'ce-corona' ),
            'deaths_title'    => __( $deaths_title, 'ce-corona' ),
            'confirmed_title' => __( $confirmed_title, 'ce-corona' ),
            'recovered_title' => __( $recovered_title, 'ce-corona' ),
            'button_position' => 'above_data_table',
        ) );

        $output = '<div id="cecShortcode">';
            $output .= '<div class="cec-elementor-country-wise cec-elementor-country-wise-loading alignwide" country_name="'. $country_code .'">';
                $output .= '<div class="cec-elementor-country-wise-inner">';
                    $output .= '<div class="cec-elementor-country">';
                        if( $flag == "true" ) {
                            $output .= '<img class="cec-elementor-country-flag" src="https://raw.githubusercontent.com/NovelCOVID/API/master/assets/flags/unknow.png" alt="'. self::countries()[ $country_code ] .'" />';
                        }
                        $output .= '<div class="cec-elementor-country-name-wrapper">';
                            $output .= '<span class="cec-elementor-country-name">'. self::countries()[ $country_code ] .'</span>';
                            if( in_array( 'update_time', explode(',', $active_items) ) ) {
                                $output .= '<span class="cec-elementor-updated-time-wrapper">'. $updated_title .': <span class="cec-elementor-updated-time">Loading...</span></span>';
                            }
                        $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="clearfix cec-cn-case-wrapper">';
                        $output .= self::case_box( 'confirmed', $confirmed_title, 0, $active_items );
                        $output .= self::case_box( 'todayCases', $new_case_title, 0, $active_items );
                        $output .= self::case_box( 'deaths', $deaths_title, 0, $active_items );
                        $output .= self::case_box( 'todayDeaths', $todayDeaths_title, 0, $active_items );
                        $output .= self::case_box( 'recovered', $recovered_title, 0, $active_items );
                        $output .= self::case_box( 'active', $active_title, 0, $active_items );
                        $output .= self::case_box( 'critical', $critical_title, 0, $active_items );
                        $output .= self::case_box( 'case_per_m', $case_per_m_title, 0, $active_items );
                        $output .= self::case_box( 'deaths_per_m', $deaths_per_m_title, 0, $active_items );
                        $output .= self::case_box( 'tests', $tests_title, 0, $active_items );
                        $output .= self::case_box( 'tests_per_m', $tests_per_m_title, 0, $active_items );
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            if( $states == 'true' && ( $country_code == 'US' || $country_code == 'USA' ) ) {
                $output .= '<div id="cecStates"></div>';
            }
        $output .= '</div>';

        return $output;
    }

    public static function case_box( $key, $title, $value, $items ){
        $output = '';
        if( in_array( $key, explode(',', str_replace(' ', '', $items)) ) ) {
            $output .= '<div class="cec-cn-case-singe cec-cn-case-'. $key .'">';
                // $output .= '<div>';
                    $output .= '<span class="cec-cn-title">' . __( $title, 'ce-corona' ) . '</span>';
                    $output .= '<span class="cec-cn-number">'. $value .'</span>';
                // $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
    }

    public static function countries(){
        return array(
            "AF"  => "Afghanistan",
            "AL"  => "Albania",
            "DZ"  => "Algeria",
            "AS"  => "American Samoa",
            "AD"  => "Andorra",
            "AO"  => "Angola",
            "AI"  => "Anguilla",
            "AQ"  => "Antarctica",
            "AG"  => "Antigua and Barbuda",
            "AR"  => "Argentina",
            "AM"  => "Armenia",
            "AW"  => "Aruba",
            "AU"  => "Australia",
            "AT"  => "Austria",
            "AZ"  => "Azerbaijan",
            "BS"  => "Bahamas",
            "BH"  => "Bahrain",
            "BD"  => "Bangladesh",
            "BB"  => "Barbados",
            "BY"  => "Belarus",
            "BE"  => "Belgium",
            "BZ"  => "Belize",
            "BJ"  => "Benin",
            "BM"  => "Bermuda",
            "BT"  => "Bhutan",
            "BO"  => "Bolivia",
            "BA"  => "Bosnia and Herzegovina",
            "BW"  => "Botswana",
            "BV"  => "Bouvet Island",
            "BR"  => "Brazil",
            "IO"  => "British Indian Ocean Territory",
            "BN"  => "Brunei Darussalam",
            "BG"  => "Bulgaria",
            "BF"  => "Burkina Faso",
            "BI"  => "Burundi",
            "KH"  => "Cambodia",
            "CM"  => "Cameroon",
            "CA"  => "Canada",
            "CV"  => "Cape Verde",
            "KY"  => "Cayman Islands",
            "CF"  => "Central African Republic",
            "TD"  => "Chad",
            "CL"  => "Chile",
            "CN"  => "China",
            "CX"  => "Christmas Island",
            "CC"  => "Cocos (Keeling) Islands",
            "CO"  => "Colombia",
            "KM"  => "Comoros",
            "CG"  => "Congo",
            "CD"  => "Congo, the Democratic Republic of the",
            "CK"  => "Cook Islands",
            "CR"  => "Costa Rica",
            "CI"  => "Cote D'Ivoire",
            "HR"  => "Croatia",
            "CU"  => "Cuba",
            "CY"  => "Cyprus",
            "CZ"  => "Czech Republic",
            "DK"  => "Denmark",
            "DJ"  => "Djibouti",
            "DM"  => "Dominica",
            "DO"  => "Dominican Republic",
            "EC"  => "Ecuador",
            "EG"  => "Egypt",
            "SV"  => "El Salvador",
            "GQ"  => "Equatorial Guinea",
            "ER"  => "Eritrea",
            "EE"  => "Estonia",
            "ET"  => "Ethiopia",
            "FK"  => "Falkland Islands (Malvinas)",
            "FO"  => "Faroe Islands",
            "FJ"  => "Fiji",
            "FI"  => "Finland",
            "FR"  => "France",
            "GF"  => "French Guiana",
            "PF"  => "French Polynesia",
            "TF"  => "French Southern Territories",
            "GA"  => "Gabon",
            "GM"  => "Gambia",
            "GE"  => "Georgia",
            "DE"  => "Germany",
            "GH"  => "Ghana",
            "GI"  => "Gibraltar",
            "GR"  => "Greece",
            "GL"  => "Greenland",
            "GD"  => "Grenada",
            "GP"  => "Guadeloupe",
            "GU"  => "Guam",
            "GT"  => "Guatemala",
            "GN"  => "Guinea",
            "GW"  => "Guinea-Bissau",
            "GY"  => "Guyana",
            "HT"  => "Haiti",
            "HM"  => "Heard Island and Mcdonald Islands",
            "VA"  => "Holy See (Vatican City State)",
            "HN"  => "Honduras",
            "HK"  => "Hong Kong",
            "HU"  => "Hungary",
            "IS"  => "Iceland",
            "IN"  => "India",
            "ID"  => "Indonesia",
            "IR"  => "Iran, Islamic Republic of",
            "IQ"  => "Iraq",
            "IE"  => "Ireland",
            "IL"  => "Israel",
            "IT"  => "Italy",
            "JM"  => "Jamaica",
            "JP"  => "Japan",
            "JO"  => "Jordan",
            "KZ"  => "Kazakhstan",
            "KE"  => "Kenya",
            "KI"  => "Kiribati",
            "KP"  => "Korea, Democratic People's Republic of",
            "KR"  => "Korea, Republic of",
            "KW"  => "Kuwait",
            "KG"  => "Kyrgyzstan",
            "LA"  => "Lao People's Democratic Republic",
            "LV"  => "Latvia",
            "LB"  => "Lebanon",
            "LS"  => "Lesotho",
            "LR"  => "Liberia",
            "LY"  => "Libyan Arab Jamahiriya",
            "LI"  => "Liechtenstein",
            "LT"  => "Lithuania",
            "LU"  => "Luxembourg",
            "MO"  => "Macao",
            "MK"  => "Macedonia, the Former Yugoslav Republic of",
            "MG"  => "Madagascar",
            "MW"  => "Malawi",
            "MY"  => "Malaysia",
            "MV"  => "Maldives",
            "ML"  => "Mali",
            "MT"  => "Malta",
            "MH"  => "Marshall Islands",
            "MQ"  => "Martinique",
            "MR"  => "Mauritania",
            "MU"  => "Mauritius",
            "YT"  => "Mayotte",
            "MX"  => "Mexico",
            "FM"  => "Micronesia, Federated States of",
            "MD"  => "Moldova, Republic of",
            "MC"  => "Monaco",
            "MN"  => "Mongolia",
            "MS"  => "Montserrat",
            "MA"  => "Morocco",
            "MZ"  => "Mozambique",
            "MM"  => "Myanmar",
            "NA"  => "Namibia",
            "NR"  => "Nauru",
            "NP"  => "Nepal",
            "NL"  => "Netherlands",
            "AN"  => "Netherlands Antilles",
            "NC"  => "New Caledonia",
            "NZ"  => "New Zealand",
            "NI"  => "Nicaragua",
            "NE"  => "Niger",
            "NG"  => "Nigeria",
            "NU"  => "Niue",
            "NF"  => "Norfolk Island",
            "MP"  => "Northern Mariana Islands",
            "NO"  => "Norway",
            "OM"  => "Oman",
            "PK"  => "Pakistan",
            "PW"  => "Palau",
            "PS"  => "Palestinian Territory, Occupied",
            "PA"  => "Panama",
            "PG"  => "Papua New Guinea",
            "PY"  => "Paraguay",
            "PE"  => "Peru",
            "PH"  => "Philippines",
            "PN"  => "Pitcairn",
            "PL"  => "Poland",
            "PT"  => "Portugal",
            "PR"  => "Puerto Rico",
            "QA"  => "Qatar",
            "RE"  => "Reunion",
            "RO"  => "Romania",
            "RU"  => "Russian Federation",
            "RW"  => "Rwanda",
            "SH"  => "Saint Helena",
            "KN"  => "Saint Kitts and Nevis",
            "LC"  => "Saint Lucia",
            "PM"  => "Saint Pierre and Miquelon",
            "VC"  => "Saint Vincent and the Grenadines",
            "WS"  => "Samoa",
            "SM"  => "San Marino",
            "ST"  => "Sao Tome and Principe",
            "SA"  => "Saudi Arabia",
            "SN"  => "Senegal",
            "CS"  => "Serbia and Montenegro",
            "SC"  => "Seychelles",
            "SL"  => "Sierra Leone",
            "SG"  => "Singapore",
            "SK"  => "Slovakia",
            "SI"  => "Slovenia",
            "SB"  => "Solomon Islands",
            "SO"  => "Somalia",
            "ZA"  => "South Africa",
            "GS"  => "South Georgia and the South Sandwich Islands",
            "ES"  => "Spain",
            "LK"  => "Sri Lanka",
            "SD"  => "Sudan",
            "SR"  => "Suriname",
            "SJ"  => "Svalbard and Jan Mayen",
            "SZ"  => "Swaziland",
            "SE"  => "Sweden",
            "CH"  => "Switzerland",
            "SY"  => "Syrian Arab Republic",
            "TW"  => "Taiwan, Province of China",
            "TJ"  => "Tajikistan",
            "TZ"  => "Tanzania, United Republic of",
            "TH"  => "Thailand",
            "TL"  => "Timor-Leste",
            "TG"  => "Togo",
            "TK"  => "Tokelau",
            "TO"  => "Tonga",
            "TT"  => "Trinidad and Tobago",
            "TN"  => "Tunisia",
            "TR"  => "Turkey",
            "TM"  => "Turkmenistan",
            "TC"  => "Turks and Caicos Islands",
            "TV"  => "Tuvalu",
            "UG"  => "Uganda",
            "UA"  => "Ukraine",
            "AE"  => "United Arab Emirates",
            "GB"  => "United Kingdom",
            "US"  => "United States",
            "USA" => "United States",
            "UM"  => "United States Minor Outlying Islands",
            "UY"  => "Uruguay",
            "UZ"  => "Uzbekistan",
            "VU"  => "Vanuatu",
            "VE"  => "Venezuela",
            "VN"  => "Viet Nam",
            "VG"  => "Virgin Islands, British",
            "VI"  => "Virgin Islands, U.s.",
            "WF"  => "Wallis and Futuna",
            "EH"  => "Western Sahara",
            "YE"  => "Yemen",
            "ZM"  => "Zambia",
            "ZW"  => "Zimbabwe"
        );
    }
}