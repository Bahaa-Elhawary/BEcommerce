@extends('Layouts.master')
@section('content')
    @if (auth()->check())
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
                                    <input type="text" style="width: 100%" placeholder="Name" name="name"
                                        id="name" value="{{ old('name') }}">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                <p style="display: flex">
                                    <input type="number" style="width: 50%" required class="mr-4" placeholder="Price"
                                        name="price" id="price" value="{{ old('price') }}">
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <input type="number" style="width: 50%" required placeholder="Quantity" name="quantity"
                                        id="quantity" value="{{ old('quantity') }}">
                                    <span class="text-danger">
                                        @error('quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                <p>
                                    <textarea name="description" id="description" required cols="30" rows="10" placeholder="Description">
                                            {{ old('description') }}
                                        </textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                <p>
                                    <select class="form-control" required name="category_id" id="category_id">
                                        @foreach ($allcategories as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                <p>
                                    <input class="form-control" type="file" name="photo" id="photo">
                                    <span class="text-danger">
                                        @error('photo')
                                            {{ $message }}
                                        @enderror
                                    </span>
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
    @else
        ليس لديك الصلاحية لإضافة منشور.
    @endif
@endsection
