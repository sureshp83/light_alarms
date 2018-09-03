<?php
if (!function_exists('imgOrDummy')) {
    function imgOrDummy($path, $dummy)
    {
        if (file_exists(public_path('/storage/'.$path))) {
            return asset('/storage/'.$path);
        }

        return asset("img/".$dummy);
    }
}
