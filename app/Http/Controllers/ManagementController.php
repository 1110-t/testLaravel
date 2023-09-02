<?php

namespace App\Http\Controllers;
use App\Models\Bio;
use App\Models\Biodetail;
use App\Models\Biodetailimage;
use App\Services\OrderChange;
use Illuminate\Support\Facades\Storage;
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
    public function bio_detail_save(Request $request){
        // 新しいルームオブジェクトを生成する
        $bio = new Biodetail;
        // データベースに追加する
        $bio->fill($request->all());
        $bio->date_display = $request->has('date_display');
        $bio->save();
        return redirect()->route('manage.bio');
    }
    public function bio_detail_image_save(Request $request){
        // アップロードされたファイル名を取得
        for ($i=0; $i < count($request->file('path')); $i++) { 
            $originalfile_name = $request->file('path')[$i]->getClientOriginalName();
            $exist = true;
            $count = 0;
            $file_name = $originalfile_name;
            while($exist){
                $exist = Biodetailimage::where('path','=',$file_name)->exists();
                if($exist){
                    $count += 1;
                };
                $noext = pathinfo($originalfile_name, PATHINFO_FILENAME);
                $ext = pathinfo($originalfile_name, PATHINFO_EXTENSION);
                if($count){
                    $file_name = $noext.$count.".".$ext;
                }else{
                    $file_name = $noext.".".$ext;
                }
            };
            // 新しいルームオブジェクトを生成する
            $bio = new Biodetailimage;
            $bio->fill($request->all());
            // データベースに追加する
            $bio->path = $file_name;
            // orderをセットする
            $order = Biodetailimage::where("biodetail_id","=",$request->biodetail_id)->count() + 1;
            $bio->order = $order;
            $bio->save();
            // 取得したファイル名で保存
            $request->file('path')[$i]->storeAs('public/bio/' . $file_name);
        }
        return redirect()->route('manage.bio');
    }
    public function bio_detailimage_edit_delete(Request $request,OrderChange $oc){
        if($request->which == "delete"){
            $bio = Biodetailimage::find($request->id);
            Storage::disk('public')->delete('bio/' . $request->path);
            $bio->delete();
        };
        if($request->which == "up" || $request->which == "down"){
            $bio = Biodetailimage::find($request->id);
            $oc->exec($request->which,$bio,new Biodetailimage);
        };
        return redirect()->route('manage.bio');
    }
    public function bio_detail_edit_delete(Request $request){
        if($request->which == "delete"){
            $bio = Biodetail::find($request->id);
            $bio->delete();
        };
        if($request->which == "edit"){
            $bio = Biodetail::find($request->id);
            $bio->fill($request->all());
            $bio->date_display = $request->has('date_display');
            $bio->save();
        };
        return redirect()->route('manage.bio');
    }
    public function bio_edit_delete(Request $request,OrderChange $oc){
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
            $oc->exec($request->which,$bio,new Bio);
        };
        return redirect()->route('manage.bio');
    }
}
