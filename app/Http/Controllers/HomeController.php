<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\food;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderPlaced;

class HomeController extends Controller
{
    public function my_home()
    {
        $data = food::all();
        return view('home.index', compact('data'));
    }
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user') {
                $data = food::all();
                return view('home.index', compact('data'));
            } else {
                $total_user = User::where('usertype', '=', 'user')->count();
                $all_foods = food::count();
                $total_orders = order::count();
                $total_delivered = order::where('delivery_status', '=', 'Delivered')->count();
                return view('admin.index', compact('total_user', 'all_foods', 'total_orders', 'total_delivered'));
            }
        }
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $Food = food::find($id);
            $cart_title = $Food->title;
            $cart_detail = $Food->detail;
            $cart_price = $Food->price;
            $cart_image = $Food->image;

            $data = new Cart();
            $data->title = $cart_title;
            $data->detail = $cart_detail;
            $data->price = $cart_price * $request->qty;
            $data->image = $cart_image;
            $data->quantity = $request->qty;
            $data->userid = Auth()->user()->id;

            $data->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function my_cart()
    {
        $user_id = Auth()->user()->id;
        $data = Cart::where('userid', '=', $user_id)->get();
        return view('home.my_cart', compact('data'));
    }

    public function remove_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function confirm_order(Request $request)
    {
        $user_id = Auth()->user()->id;
        $cart = Cart::where('userid', '=', $user_id)->get();
        $admin = User::where('usertype', 'admin')->first();
        foreach ($cart as $cart) {
            $order = new Order();
            $order->name = $request->name;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->title = $cart->title;
            $order->quantity = $cart->quantity;
            $order->price = $cart->price;
            $order->image = $cart->image;
            $order->save();
            $admin->notify(new OrderPlaced($order));
            $data = Cart::find($cart->id);
            $data->delete();
        }
        return redirect()->back();
    }
    
    public function customer_orders()
    {
        $users = Auth::user();
        $data = order::where('email', $users->email)->get();
        return view('home.customer_orders', compact('data'));
    }

    //Rating Function
    public function rate_order(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order && $order->delivery_status === 'Delivered') {
            $order->rating = $request->rating;
            $order->save();
        }

        return redirect()->back();
    }

    public function submit_feedback(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order && $order->delivery_status == 'Delivered') {
            $order->feedback = $request->feedback;
            $order->save();
        }
        return redirect()->back();
    }
}
