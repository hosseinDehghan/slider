<?php

namespace Hosein\Sliders\Controllers;

use Hosein\Sliders\slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SlidersController extends Controller
{
    public function index(){
        $data["listSlider"]=slider::all();
        return view("SliderView::slider",$data);
    }
    public function create(Request $request){
        $validator=Validator::make($request->all(),[
           'title'=>'required|max:100',
           'caption'=>'required|max:255',
           'link'=>'required|max:100',
           'image'=>'required|mimes:jpg,jpeg,png|max:10000'
        ]);
        if($validator->fails()){
            return redirect('slider')
                ->withErrors($validator,"slider")
                ->withInput();
        }
        $file = $request->file('image');
        $destination=public_path()."/upload/";
        $filename=$this->uploadfile($destination,$file);
        if($filename!=false){
            $slider=new slider();
            $slider->title=$request->all()["title"];
            $slider->caption=$request->all()["caption"];
            $slider->link=$request->all()["link"];
            $slider->image=$filename;
            $slider->status=(isset($request->all()["status"]))?1:0;
            $slider->save();
        }
        return redirect('slider')->with("slidermessage","با موفقیت ثبت شد.");
    }
    public function uploadfile($destination,$file){
        $filename=$file->getClientOriginalName();
        $name=explode('.',$file->getClientOriginalName())[0];
        $extenstion=$file->getClientOriginalExtension();
        while(file_exists($destination.$filename)){
            $filename=$name."_".rand(1,10000000).".".$extenstion;
        }
        if($file->move($destination,$filename)){
            return $filename;
        }
        return false;
    }
    public function deletefile($destination,$filename){
        if(file_exists($destination."/".$filename)){
            unlink($destination."/".$filename);
            return 1;
        }
        return 0;
    }
    public function edit($id){
        $slider=slider::where("id",$id)->first();
        return redirect("slider")->with("slider",$slider);
    }
    public function update(Request $request,$id){
        $slider=slider::where("id",$id)->first();
        $destination=public_path()."/upload/";
        $file=$slider->image;
        if(!empty($request->file("image"))){
            $oldfile=$file;
            $file=$this->uploadfile($destination,$request->file("image"));
            if($file!=false){
                $this->deletefile($destination,$oldfile);
            }
        }
        $slider->title=$request->all()["title"];
        $slider->caption=$request->all()["caption"];
        $slider->link=$request->all()["link"];
        $slider->image=$file;
        $slider->status=(isset($request->all()["status"]))?1:0;
        $slider->save();
        return redirect("slider")->with("slidermessage","با موفقیت ویرایش شد.");
    }
    public function delete($id){
        $slider=slider::where("id",$id)->first();
        $destination=public_path()."/upload/";
        if(file_exists(public_path()."/upload/".$slider->image))
            $this->deletefile($destination,$slider->image);
        $slider->delete();
        return redirect("slider");
    }
}
