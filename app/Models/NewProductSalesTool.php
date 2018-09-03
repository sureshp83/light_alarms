<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NewProductSalesTool extends Model
{
    protected $table = "new_product_sales_tool";

    protected $fillable = [
        'new_product_id',
        'sales_tool_id',
    ];

    public function newProduct()
    {
        return $this->belongsTo(NewProduct::class);
    }

    public function salesTool()
    {
        return $this->belongsTo(SalesTool::class);
    }
}
