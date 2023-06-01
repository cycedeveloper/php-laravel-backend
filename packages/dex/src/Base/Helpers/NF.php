<?php
namespace Sayedsoft\Dex\Base\Helpers;

/**
 * Number fotmatter
 */
class NF
{   
    public static function set($number,$dec = 4) {
        return (float)number_format($number,$dec,'.','');
    }
}

