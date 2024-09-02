<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductPhoto;

class productController extends Controller
{
    public function AddProduct()
    {

        $allcategories = category::all();
        return view('Products.addproduct', ['allcategories' => $allcategories]);
    }

    public function showProduct($productid)
    {
        $product = Product::with('Category', 'productphotos')->find($productid);
        $relatedProducts = Product::where('category_id' , $product -> category_id) -> where('id' , '!=' , $productid)
        ->inRandomOrder()
        ->limit(3)
        ->get();

        return view('Products.showProduct', ['products' => $product, 'relatedProducts' => $relatedProducts]);
    }

    public function AddProductImages($productid)
    {
        $product = Product::find($productid);
        $productImages = ProductPhoto::where('product_id', $productid)->get();
        return view('Products.AddProductImage', ['products' => $product, 'productImages' => $productImages,
                                                'productid' => $productid]);
    }

    public function storeProductImage(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $photo = new ProductPhoto();
        $photo->product_id = $request->product_id;

        if ($request->has('photo')) {
            $path = $request->photo->move(
                'uploads',
                Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName()
            );
            $photo->imagepath = $path;
        }
        $photo->save();
        return redirect('/ProductsTable');
    }

    public function ProductsTable()
    {
        $products = Product::all();
        return view('Products.ProducTstable', ['products' => $products]);
    }

    public function EditProduct($productid = null)
    {
        if ($productid != null) {
            $currentProduct = product::find($productid);
            if ($currentProduct == null) {
                abort("403", "Can't find the required product!");
            }
            $allcategories = category::all();
            return view('Products.editproduct', ["product" => $currentProduct, 'allcategories' => $allcategories]);
        } else {
            return redirect('/addproduct');
        }
    }

    public function RemoveProducts($productid = null)
    {
        if ($productid != null) {
            $currentProduct = product::find($productid);
            $currentProduct->delete();
            return redirect('/product');
        } else {
            abort(403, 'Please enter product id in the route');
        }
    }

    public function removeproductphoto($imageid = null)
    {
        if ($imageid != null) {
            $photo = ProductPhoto::find($imageid);
            $photo->delete();
            return redirect('/ProductsTable');
        } else {
            abort(403, 'Please enter image id in the route');
        }
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            "name" => ['required', 'max:30'],
            "price" => 'required',
            "quantity" => 'required|integer',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //for editing the product:
        if ($request->id) {

            $currentProduct = product::find($request->id);
            $currentProduct->name = $request->name;
            $currentProduct->price = $request->price;
            $currentProduct->quantity = $request->quantity;
            $currentProduct->description = $request->description;
            $currentProduct->category_id = $request->category_id;

            if ($request->has('photo')) {
                $path = $request->photo->move(
                    'uploads',
                    Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName()
                );
                $currentProduct->imagepath = $path;
            }

            $currentProduct->save();
            return redirect('/product');
        }

        //for adding the product:
        else {
            $newProduct = new product();
            $newProduct->name = $request->name;
            $newProduct->price = $request->price;
            $newProduct->quantity = $request->quantity;
            $newProduct->description = $request->description;
            $newProduct->category_id = $request->category_id;
            $path = '';

            if ($request->has('photo')) {
                $path = $request->photo->move(
                    'uploads',
                    Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName()
                );
            }
            $newProduct->imagepath = $path;
            $newProduct->save();
            return redirect('/');
        }
    }
}


