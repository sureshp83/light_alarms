<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestSalesLiterature extends Model
{
    use SoftDeletes;

    protected $table = "request_sales_literature";

    protected $casts = [
        'literatures' => 'array',
    ];

    protected $fillable = [
        "contact_name",
        "contact_phone_number",
        "agency_name",
        "ship_date",
        "address",
        "city",
        "state",
        "zip_code",
        "special_instructions",
        "quantity",
        "part_number",
        "literatures",
    ];
}
