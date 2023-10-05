<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];
    function parent(){
        return $this->hasOne(Category::class ,'parent-id')->withDefault(['name' => '-']);

    }
}
