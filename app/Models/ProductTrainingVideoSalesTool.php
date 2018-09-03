<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductTrainingVideoSalesTool extends Model
{
    protected $table = "prod_train_video_sales_tool";

    protected $fillable = [
        'prod_train_video_id',
        'sales_tool_id',
    ];

    public function productTrainingVideo()
    {
        return $this->belongsTo(ProductTrainingVideo::class);
    }

    public function salesTool()
    {
        return $this->belongsTo(SalesTool::class);
    }
}
