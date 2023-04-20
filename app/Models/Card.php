<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public function getAbstract($max = 50){
        return substr($this->text, 0, $max) . "...";
    }
}