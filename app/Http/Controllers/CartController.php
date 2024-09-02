<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\orderdetails;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();
        return view('Products.cart', ['cartProducts' => $cartProducts]);
    }

    public function Completeorder()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();
        return view('Products.Completeorder', ['cartProducts' => $cartProducts]);
    }

    public function previousorder()
    {
        $user_id = auth()->user()->id;
        $result = Order::with('orderdetails')->where('user_id', $user_id)->get();
        return view('Products.previousorder', ['orders' => $result]);
    }

    public function StoreOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $newOrder = new Order();
        $newOrder->name = $request->name;
        $newOrder->address = $request->address;
        $newOrder->email = $request->email;
        $newOrder->phone = $request->phone;
        $newOrder->note = $request->note;
        $newOrder->user_id = $user_id;
        $newOrder->save();
        $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();

        foreach ($cartProducts as $item) {
            $newOrderDetail = new orderdetails();
            $newOrderDetail->product_id =  $item->product_id;
            $newOrderDetail->price =  $item->Product->price;
            $newOrderDetail->quantity =  $item -> quantity;
            $newOrderDetail->order_id =  $newOrder -> id;
            $newOrderDetail->save();
        }

        Cart::where('user_id', $user_id)->delete();
        return redirect('/');
    }
}
