<?php


if (!function_exists('num_view')) {
    function num_view($number, $dec = 4)
    {
        return (float)number_format($number,$dec,'.','');
    }

   
}


if (!function_exists('num_view_html')) {
    function num_view_html($number, $dec = 4)
    {
        $t = (string)number_format($number,$dec,'.','');

        $exp = explode('.',$t);


        $html = '<span class="formatted_num">';
        
            $html .= '<span class="org_num">';
            $html .= $exp[0];
            $html .= '</span>';

            $html .= '<span class="dec_point">.</span>';

            $html .= '<span class="dec_num">';
            $html .= $exp[1];
            $html .= '</span>';

        $html .= '</span>';

        return $html;

    }
}