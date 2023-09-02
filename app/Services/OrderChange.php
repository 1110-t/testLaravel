<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Model;

class OrderChange{
    public function exec($which,$target,Model $obj){
        if($which == "up"){
            if($target->order > 1){
                $target->order -= 1;
                $this->updown($target,$obj,1);
                $target->save();
            }
        };
        if($which == "down"){
            $rimit = $obj::count();
            if($target->order < $rimit){
                $target->order += 1;
                $this->updown($target,$obj,-1);
                $target->save();
            }
        }
    }
    public function updown($target,$obj,$updown){
        $target2 = $obj::where('order', '=', $target->order)->first();
        if($target2){
            $target2->order += $updown;
            $target2->save();
        }else{
            return false;
        }
    }
}