<?php

if (!function_exists('getSiteName')) {
    function getSiteName() {
        return env('APP_NAME') ?? "Artemis Academy";
    }
}
if (!function_exists('createPersianSlug')) {
    function createPersianSlug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرژزسشصضطظعغفقكگپچلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}
