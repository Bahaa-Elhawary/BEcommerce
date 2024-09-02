<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\productController;
use App\Http\Controllers\CartController;
use App\Models\category;
use App\Models\product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FirstController::class , 'MainPage']);
Route::get('/product/{catid?}', [FirstController::class , 'GetCategoryProducts'])->name('prods');
Route::get('/category', [FirstController::class , 'GetAllCategorywithProducts'])->name('cats');
Route::get('/addproduct', [productController::class , 'AddProduct']) ->middleware('auth');
Route::get('/reviews', [FirstController::class , 'reviews']);
Route::post('/storeReview', [FirstController::class , 'storeReview']);
Route::get('/editproduct/{productid?}', [productController::class , 'EditProduct'])->middleware('auth');
Route::get('/removeproduct/{productid?}', [productController::class , 'RemoveProducts'])->middleware('auth');
Route::post('/storeproduct', [productController::class , 'StoreProduct']);
Route::post('/search', function (Request $request){
    $products = product::where('name' ,'like' , '%'.$request->searchkey.'%') -> paginate(6);
    return view('product', ['products' => $products]);
});
Route::get('/ProductsTable', [productController::class, 'ProductsTable']);
Route::get('/single-product/{productid}', [productController::class, 'showProduct']);
Route::get('/AddProductImages/{productid}', [productController::class, 'AddProductImages']);
Route::get('/removeproductphoto/{imageid?}', [productController::class , 'removeproductphoto'])->middleware('auth');
Route::post('/storeProductImage', [productController::class , 'storeProductImage']);
Route::get('/cart', [CartController::class, 'cart'])->middleware('auth');
Route::get('/Completeorder', [CartController::class, 'Completeorder'])->middleware('auth');
Route::get('/previousorder', [CartController::class, 'previousorder'])->middleware('auth');
Route::post('/StoreOrder', [CartController::class , 'StoreOrder']);
Route::get('/deletecartitem/{cartid}', function($cartid){
    Cart::find($cartid)->delete();
    return redirect('/cart');
});
Route::get('/addproducttocart/{productid}', function($productid){
    $user_id = auth()->user() -> id;
    $result = Cart::where('user_id' , $user_id )->where("product_id" , $productid)->get();
    if ($result->count()>0) {
        $result -> first()->quantity +=1;
        $result -> first()->save();
    } else {
        $newCart = new Cart();
        $newCart -> product_id = $productid;
        $newCart -> user_id = $user_id;
        $newCart -> quantity = 1;
        $newCart -> save();
    }
    return redirect('/cart');
})-> middleware('auth');

Route::post('/lang', function(Request $request){
    session()->put('locale', $request->locale);
    return redirect()->back();
})->name('changeLanguage');





