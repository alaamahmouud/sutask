<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use HasFactory;
    use Rateable;

    protected $fillable = ['price' ,'title' ,'des'];

}
