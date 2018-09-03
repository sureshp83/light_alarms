@component('mail::message')
##Display Board Request

    Name of distributor: {{ $name_of_distributor }}
    Quantity:  {{ $quantity }}
    Products:
@foreach ($product_ids as $product)
    {{ ($loop->index + 1) }}. [{{ $product }}]({!! env('APP_URL')."/new-products/$product" !!})
@endforeach


##Ship to
    Contact name: {{ $contact_name }}
    Contact phone number: {{ $contact_phone_number }}
    Company: {{ $company }}
    Ship receiving date: {{ $ship_date }}
    Address: {{ $address }}
    City: {{ $city }}
    State: {{ $state }}
    Zip_code: {{ $zip_code }}

    Special_instructions:
    {{ $special_instructions }}

@endcomponent
