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
        $bios = Bio::get()->all();
        return view('bio_top',compact(['bios']));
    }
    public function bio_save(Request $request){
        // 新しいルームオブジェクトを生成する
        $bio = new Bio;
        // データベースに追加する
        $bio->fill($request->all())->save();
        dd("save");
    }
    public function bio_edit_delete(Request $request){
        if($request->which == "edit"){
            $bio = Bio::find($request->id);
            $bio->fill($request->all())->save();
            $bio->save();
        };
        return redirect()->route('manage.bio');
    }
}
