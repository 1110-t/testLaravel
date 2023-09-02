<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodetailimage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function order_change(Biodetailimage $bio,$updown){
        $target = Biodetailimage::where('order', '=', $bio->order)->first();
        if($target ){
            $target->order += $updown;
            $target->save();
        }else{
            return false;
        }
    }
}
