@extends('Layouts.master')
@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> new Product</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                        <div class="contact-form">
                            <form method="POST" enctype="multipart/form-data" action="/storeproduct">
                                @csrf()
                                <p>
                                    <input type="hidden" style="width: 100%" required placeholder="" name="id" id="id"
                                    value="{{$product -> id}}">
                                    <input type="text" style="width: 100%" required placeholder="Name" name="name" id="name"
                                    value="{{$product -> name}}">
                                    <span class="text-danger">
                                        @error('name')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </p>
                                <p style="display: flex">
                                    <input type="number" style="width: 50%" required class="mr-4" placeholder="Price" name="price" id="price"
                                    value="{{$product -> price}}">
                                    <span class="text-danger">
                                        @error('price')
                                            {{$message}}
                                        @enderror
                                    </span>
                                    <input type="number" style="width: 50%" required placeholder="Quantity" name="quantity" id="quantity"
                                    value="{{$product -> quantity}}">
                                    <span class="text-danger">
                                        @error('quantity')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </p>
                                <p>
                                    <textarea name="description" id="description" required cols="30" rows="10" placeholder="Description" >
                                        {{$product -> description}}
                                    </textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </p>
                                <p>
                                    <select class="form-control" required name="category_id" id="category_id">
                                        @foreach ($allcategories as $item)
                                            @if ($item -> id == $product -> category_id)
                                                <option value="{{$item -> id}}" selected> {{$item -> name}} </option>
                                            @else
                                                <option value="{{$item -> id}}"> {{$item -> name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('category_id')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </p>
                                <input class="form-control" type="file" name="photo" id="photo">
                                <span class="text-danger">
                                    @error('photo')
                                        {{$message}}
                                    @enderror
                                </span>
                                <p>
                                <img src="{{asset($product -> imagepath)}}" width="200" height="200">
                                </p>
                                <p>
                                    <input type="submit" value="حفظ">
                                </p>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
