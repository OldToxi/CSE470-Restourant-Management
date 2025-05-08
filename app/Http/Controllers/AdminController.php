<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food;

class AdminController extends Controller
{
    public function addfood()
    {
        return view('admin.addfood');
    }
    public function uploadfood(Request $request)
    {
        $data= new food;
        $data->title= $request->title;
        $data->detail= $request->Info;
        $data->price= $request->price;
        #$image= $request->img;
        $image = $request->file('img');
        $filename= time().'.'.$image->getClientOriginalExtension();
        $request->img->move('food_img',$filename);

        $data->image=$filename;

        $data->save();
        return redirect()->back();

    }
     public function viewfood()
     {
        $data=food::all();
        return view('admin.show_food',compact('data'));
     }
     public function delfood($id)
     {
        $data=food::find($id);
        $data->delete();
        return redirect()->back();
     }
}
