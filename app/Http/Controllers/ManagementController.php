<?php

namespace App\Http\Controllers;
use App\Models\Bio;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function top(Request $request){
        return view('top');
    }
    public function bio_top(Request $request){
        $bios = Bio::orderBy("order","asc")->get();
        return view('bio_top',compact(['bios']));
    }
    public function bio_save(Request $request){
        // 新しいルームオブジェクトを生成する
        $bio = new Bio;
        // データベースに追加する
        $bio->fill($request->all());
        $bio->order = Bio::count()+1;
        $bio->save();
        return redirect()->route('manage.bio');
    }
    public function bio_edit_delete(Request $request){
        if($request->which == "delete"){
            $bio = Bio::find($request->id);
            $bio->delete();
        };
        if($request->which == "edit"){
            $bio = Bio::find($request->id);
            $bio->fill($request->all())->save();
            $bio->save();
        };
        if($request->which == "up" || $request->which == "down"){
            $bio = Bio::find($request->id);
            if($request->which == "up"){
                if($bio->order > 1){
                    $bio->order -= 1;
                    Bio::order_change($bio,1);
                    $bio->save();
                }
            };
            if($request->which == "down"){
                $rimit = Bio::count();
                if($bio->order < $rimit){
                    $bio->order += 1;
                    Bio::order_change($bio,-1);
                    $bio->save();
                }
            }
        };
        return redirect()->route('manage.bio');
    }
}
