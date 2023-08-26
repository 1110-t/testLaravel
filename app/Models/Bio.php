<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function biodetails(){
        return $this->hasMany(Biodetail::class);
    }
    public static function order_change(Bio $bio,$updown){
        $target = Bio::where('order', '=', $bio->order)->first();
        if($target ){
            $target->order += $updown;
            $target->save();
        }else{
            return false;
        }
    }
}
