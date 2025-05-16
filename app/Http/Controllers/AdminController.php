<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food;
use App\Models\order;
use Illuminate\Support\Facades\Auth;

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
     public function orders()
     {
        $data=order::all();
        return view('admin.order',compact('data'));
     }
     public function on_the_way($id)
     {
        $data=order::find($id);
        $data-> delivery_status="On the way";
        $data->save();
        return redirect()->back();
     }
     public function delivered($id)
     {
        $data=order::find($id);
        $data-> delivery_status="Delivered";
        $data->save();
        return redirect()->back();
     }
     public function cancel($id)
     {
        $data=order::find($id);
        $data-> delivery_status="Cancel";
        $data->save();
        return redirect()->back();
     }
      
   }
