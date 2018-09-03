<?php

namespace App\Models;

use App\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use Sluggable, HasMediaTrait;
    //
}
