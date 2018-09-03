@component('mail::message')
##New Agency T & B Approval

Name of Agency : {{ $name_of_agency }}

Contact No :  {{ $contactno }}

Address: {{ $address }}

City: {{ $city }}

State: {{ $state }}

Zip_code: {{ $zip_code }}

Special_instructions:
{{ $special_instructions }}

@endcomponent
