<?php

/*
	Plugin Name: Pretvori u latinicu
	Description: Pretvaramo ćirilicu u latinicu.
	Tags: ćirilica, latinica, sajbersove, sajber sove
	Author: Sajber Sove
	Author URI: https://sajbersove.rs/
	Version: 1.0
	License: GPLv2
*/

if (! defined('ABSPATH') ) {
  die('Forbidden');
};

// UNIKOD
if (!defined('UNI_CIRILICA')) {
    define('UNI_CIRILICA', array('u0411', 'u0412', 'u0413', 'u0414', 'u0402', 'u0416', 'u0417', 'u0418', 'u041b', 'u0409', 'u041d', 'u040a', 'u041f', 'u0420', 'u0421', 'u040b', 'u0423', 'u0424', 'u0425', 'u0426', 'u0427', 'u040f', 'u0428', 'u0431', 'u0432', 'u0433', 'u0434', 'u0452', 'u0436', 'u0437', 'u0438', 'u043a', 'u043b', 'u0459', 'u043c', 'u043d', 'u045a', 'u043f', 'u0440', 'u0441', 'u0442', 'u045b', 'u0443', 'u0444', 'u0445', 'u0446', 'u0447', 'u045f', 'u0448'));
}

if (!defined('UNI_LATINICA')) {
    define('UNI_LATINICA', array('u0042', 'u0056', 'u0047', 'u0044', 'u0110', 'u017d', 'u005a', 'u0049', 'u004c', 'u004c\u006a', 'u004e', 'u004e\u006a', 'u0050', 'u0052', 'u0053', 'u0106', 'u0055', 'u0046', 'u0048', 'u0043', 'u010c', 'u0044\u017e', 'u0160', 'u0062', 'u0076', 'u0067', 'u0064', 'u0111', 'u017e', 'u007a', 'u0069', 'u006b', 'u006c', 'u006c\u006a', 'u006d', 'u006e', 'u006e\u006a', 'u0070', 'u0072', 'u0073', 'u0074', 'u0107', 'u0075', 'u0066', 'u0068', 'u0063', 'u010d', 'u0064\u017e', 'u0161'));
}

// PISMA
if (!defined('CIRILICA')) {
    define('CIRILICA', array('А', 'Б', 'В', 'Г', 'Д', 'Ђ', 'Е', 'Ж', 'З', 'И', 'Ј', 'К', 'Л', 'Љ', 'М', 'Н', 'Њ', 'О', 'П', 'Р', 'С', 'Т', 'Ћ', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Џ', 'Ш', 'а', 'б', 'в', 'г', 'д', 'ђ', 'е', 'ж', 'з', 'и', 'ј', 'к', 'л', 'љ', 'м', 'н', 'њ', 'о', 'п', 'р', 'с', 'т', 'ћ', 'у', 'ф', 'х', 'ц', 'ч', 'џ', 'ш'));
}

if (!defined('LATINICA')) {
    define('LATINICA', array('A', 'B', 'V', 'G', 'D', 'Đ', 'E', 'Ž', 'Z', 'I', 'J', 'K', 'L', 'Lj', 'M', 'N', 'Nj', 'O', 'P', 'R', 'S', 'T', 'Ć', 'U', 'F', 'H', 'C', 'Č', 'Dž', 'Š', 'a', 'b', 'v', 'g', 'd', 'đ', 'e', 'ž', 'z', 'i', 'j', 'k', 'l', 'lj', 'm', 'n', 'nj', 'o', 'p', 'r', 's', 't', 'ć', 'u', 'f', 'h', 'c', 'č', 'dž', 'š'));
}

// Ako je izabrani jezik Srpski, radimo filtraciju i promene
$jezik = get_locale();
if ($jezik === 'sr_RS') {
    add_filter('gettext', 'radimo_filtraciju', 10, 3);
    add_filter('gettext_with_context', 'radimo_filtraciju', 10, 4);
    add_filter('ngettext', 'radimo_filtraciju', 10, 5);
    add_filter('ngettext_with_context', 'radimo_filtraciju', 10, 6);
    add_filter('load_script_translations', 'skripte', 10, 4);
}

if (!function_exists('radimo_filtraciju')) {
    function radimo_filtraciju($pretvori_filter, $text, $context = null, $domain = null) {
        $pretvori_filter = str_replace(CIRILICA, LATINICA, $pretvori_filter);
        return $pretvori_filter;
    }
}

if (!function_exists('skripte')) {
    function skripte($pretvori_skripte, $file, $handle, $domain) {
        $pretvori_skripte = str_replace(UNI_CIRILICA, UNI_LATINICA, $pretvori_skripte);
        return $pretvori_skripte;
    }
}
