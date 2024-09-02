<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirstController extends Controller
{
    public function MainPage()
    {
        $categories = category::all();
        return view('welcome', ['categories' =>  $categories]);
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            "name" => ['required', 'max:30'],
            "phone" => 'required',
            "email" => 'required|email',
            "subject" => 'required',
            'message' => 'required'
        ]);
        $newReview = new Review();
        $newReview -> name = $request -> name;
        $newReview -> phone = $request -> phone;
        $newReview -> email = $request -> email;
        $newReview -> subject = $request -> subject;
        $newReview -> message = $request -> message;
        $newReview -> save();
        return redirect('/reviews');
    }

    public function reviews()
    {
        $reviews = Review::all();
        return view('reviews', ['reviews' =>  $reviews]);
    }

    public function GetCategoryProducts($catid = null)
    {
        if ($catid) {
            $products = product::where('category_id', $catid)->paginate(6);
            return view('product', ['products' => $products]);
        } else {
            $products = product::paginate(6);
            return view('product', ['products' => $products]);
        }
    }

    public function GetAllCategorywithProducts()
    {
        $categories = category::all();
        $products = product::all();
        return view('category', ['products' => $products, 'categories' =>  $categories]);
    }
}
