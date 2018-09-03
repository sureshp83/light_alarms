@component('mail::message')
##Sales Literature Request

    Quantity: {{ $quantity }}
    Part number: {{ $part_number }}
    Literatures:
@foreach ($literatures as $literature)
    {{ ($loop->index + 1) }}. {{ $literature }}
@endforeach


##Ship to
    Contact name: {{ $contact_name }}
    Contact phone number: {{ $contact_phone_number }}
    Agency name: {{ $agency_name }}
    Ship date: {{ $ship_date }}
    Address: {{ $address }}
    City: {{ $city }}
    State: {{ $state }}
    Zip code: {{ $zip_code }}

    Special instructions:
    {{ $special_instructions }}

@endcomponent
