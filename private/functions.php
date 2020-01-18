<?php

function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function u($string="")
{
    return urlencode($string);
}

function raw_u($string="")
{
    return rawurlencode($string);
}

function h($string="")
{
    return htmlspecialchars($string);
}

function error_404()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}

function error_500()
{
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    exit();
}

function redirect_to($location)
{
    header("Location: " . $location);
    exit;
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if (!function_exists('money_format')) {
    function money_format($format, $number)
    {
        return '$' . number_format($number, 2);
    }
}

function isActivePage($url)
{
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    return ($activePage == $url) ? 'active':'';
}

function isActiveDir($dir)
{
    $path = dirname($_SERVER['SCRIPT_NAME']);
    $path_relative = str_replace(WWW_ROOT, '', $path);
    return ($path_relative == $dir) ? 'active' : '';
}

function hex2rgb( $colour ) {
    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

function get_rgb( $colour) {
    $colours = hex2rgb( $colour);
    return "rgb(" . $colours['red'] . ",". $colours['green'] . "," . $colours['blue'] . ")";
}

function get_rgba( $colour) {
    $colours = hex2rgb( $colour);
    return "rgba(" . $colours['red'] . ",". $colours['green'] . "," . $colours['blue'] . ",0.1)";
}

function get_time($datetime) {
    $output = (new DateTime($datetime))->format('H:i');
    return $output;
}

function get_date($datetime) {
    $output = (new DateTime($datetime))->format('d-m-Y');
    return $output;
}