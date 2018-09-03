<?php
if (!function_exists('svgIcon')) {
    /**
     * Return SVG string for a given icon name.
     * Icons are placed on blade /resources/views/inc/icons-svg.blade.php.
     *
     * @returns string  SVG output.
     */
    function svgIcon($icon, $style = '')
    {
        return '<svg class="icon '.$style.'">'
             . '<use xlink:href="#'.$icon.'"></use></svg>';
    }
}
