<?php
if (!function_exists('usaStates')) {
    /**
     * Return USA states <select> element and select an option if submitted.
     *
     * @returns string  html output.
     */
    function usaStates($field, $style = 'custom-select', $selected = '')
    {
        $states = usaStatesArray();

        $selected = $selected ?: old($field);

        $out = [];
        $out[] = "<select name='$field' id='$field' ";
        $out[] = "class='form-control $style' ";
        $out[] = "required='required'>";
        $out[] = "<option value=''>".trans('auth.inp.select_state')."</option>";

        foreach ($states as $key => $state) {
            $out[] = "<option value='$key'"
                    .(($selected === $key || $selected === $state) ? " selected='selected'>" : ">")
                    .$state
                    ."</option>";
        }
        $out[] = '</select>';

        return implode(' ', $out);
    }



    /**
     * Return USA states data array only.
     *
     * @returns array
     */
    function usaStatesArray()
    {
        return [
            "AL" => "Alabama",
            "AK" => "Alaska",
            "AZ" => "Arizona",
            "AR" => "Arkansas",
            "CA" => "California",
            "CO" => "Colorado",
            "CT" => "Connecticut",
            "DE" => "Delaware",
            "DC" => "District Of Columbia",
            "FL" => "Florida",
            "GA" => "Georgia",
            "HI" => "Hawaii",
            "ID" => "Idaho",
            "IL" => "Illinois",
            "IN" => "Indiana",
            "IA" => "Iowa",
            "KS" => "Kansas",
            "KY" => "Kentucky",
            "LA" => "Louisiana",
            "ME" => "Maine",
            "MD" => "Maryland",
            "MA" => "Massachusetts",
            "MI" => "Michigan",
            "MN" => "Minnesota",
            "MS" => "Mississippi",
            "MO" => "Missouri",
            "MT" => "Montana",
            "NE" => "Nebraska",
            "NV" => "Nevada",
            "NH" => "New Hampshire",
            "NJ" => "New Jersey",
            "NM" => "New Mexico",
            "NY" => "New York",
            "NC" => "North Carolina",
            "ND" => "North Dakota",
            "OH" => "Ohio",
            "OK" => "Oklahoma",
            "OR" => "Oregon",
            "PA" => "Pennsylvania",
            "RI" => "Rhode Island",
            "SC" => "South Carolina",
            "SD" => "South Dakota",
            "TN" => "Tennessee",
            "TX" => "Texas",
            "UT" => "Utah",
            "VT" => "Vermont",
            "VA" => "Virginia",
            "WA" => "Washington",
            "WV" => "West Virginia",
            "WI" => "Wisconsin",
            "WY" => "Wyoming",
        ];
    }
}
