<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['title','image', 'text'];

    public function getAbstract($max = 50){
        return substr($this->text, 0, $max) . "...";
    }

    public static function generateSlug($title){
        $possible_slug = Str::of($title)->slug('-');
        $cards = Card::where('slug', $possible_slug)->get();

        $original_slug = $possible_slug;

        $i = 2;
        while(count($cards)){
            $possible_slug = $original_slug . "-" . $i;
            $cards = Card::where('slug', $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }

    protected function getUpdatedAtAttribute($value){
        return date('d/m/Y H:i', strtotime($value));
    }

    protected function getCreatedAtAttribute($value){
        return date('d/m/Y H:i', strtotime($value));
    }

}