<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\food;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function my_home()
    {
        $data= food::all();
        return view('home.index',compact('data'));
    }
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if($usertype=='user')
            {
                $data= food::all();
                return view('home.index',compact('data'));
            }
            else
            {
                return view('admin.index');
            }
        }

    }

    public function add_cart(Request $request,$id)
    {
        if (Auth::id())
        {
            $Food= food::find($id);
            $cart_title=$Food->title;
            $cart_detail=$Food->detail;
            $cart_price=$Food->price;
            $cart_image=$Food->image;

            $data= new Cart;
            $data->title= $cart_title;
            $data->detail= $cart_detail;
            $data->price= $cart_price* $request->qty;
            $data->image= $cart_image;
            $data->quantity= $request->qty;
            $data->userid= Auth()->user()->id;

            $data->save();
            return redirect()-> back();
        }
        else
        {
            return redirect("login");
        }
    }

    public function my_cart()
    {
        $user_id= Auth()->user()->id;
        $data= Cart::where('userid','=',$user_id)->get();
        return view('home.my_cart',compact('data'));
    }
}
