<?php
if (!function_exists('productSelect')) {
    /**
     * Return <select> element loaded with products.
     *
     * @returns string  html output.
     */
    function productSelect($placeholder, $field, $style = 'custom-select', $selected = '')
    {
        return _helperSelect(
            \App\Models\NewProduct::pluck('name', 'slug'),
            $placeholder,
            $field,
            $style,
            $selected
        );
    }
}



if (!function_exists('_helperSelect')) {
    /**
     * Return <select> element for a given data object.
     *
     * @returns string  html output.
     */
    function _helperSelect($data, $placeholder, $field, $style = 'custom-select', $selected = '')
    {
        $selected = $selected ?: old($field);

        $out = [];
        $out[] = "<select name='$field' id='$field' ";
        $out[] = "class='form-control $style' ";
        $out[] = "required='required'>";
        $out[] = "<option value=''>$placeholder</option>";

        foreach ($data as $key => $prod) {
            $_selected = ($selected === $prod) ? " selected='selected'" : '';

            $out[] = "<option value='$key'$_selected>$prod</option>";
        }
        $out[] = '</select>';

        return implode(' ', $out);
    }
}

