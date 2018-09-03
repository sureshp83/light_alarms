<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestDisplayBoard extends Model
{
    use SoftDeletes;

    protected $table = "request_display_board";

    protected $casts = [
        'product_ids' => 'array',
    ];

    protected $fillable = [
        "name_of_distributor",
        "quantity",
        "product_ids",
        "contact_name",
        "contact_phone_number",
        "company",
        "ship_date",
        "address",
        "city",
        "state",
        "zip_code",
        "special_instructions",
    ];
}
