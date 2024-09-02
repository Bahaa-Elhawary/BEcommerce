@extends('Layouts.master')
@section('content')
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="section-title text-center">
            <h3><span class="orange-text">Product</span> Detaials</h3>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="single-product-img">
                    <img src="{{asset($products -> imagepath)}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-product-content">
                    <h3>{{$products -> name}}</h3>
                    <h4>القسم: {{$products -> Category -> name}}</h4>
                    <p class="single-product-pricing"><span>الكمية: {{$products -> quantity}}</span> $ {{$products -> price}} </p>
                    <p>{{$products -> description}}</p>
                    <div class="single-product-form">
                        <a href="/addproducttocart/{{$products -> id}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> الإضافة إلى السلة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="testimonail-section mt-80 mb-150">
    <div class="container">
        <div class="row">
            @if ($products->productPhotos->count() > 1)
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="testimonial-sliders">
                        @foreach ($products->productPhotos as $item)
                            <div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img style="width: 30%; height: 250px; max-width: none !important; border: black 5px; border-radius:20px !important" src="{{asset($item -> imagepath)}}" alt="">
                                </div>
                                <div class="client-meta">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="section-title text-center">
        <h3><span class="orange-text">Related</span> Products</h3>
    </div>
    <div class="row">
        @foreach ($relatedProducts as $item)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="/single-product/{{$item->id}}">
                            <img style="max-height:250px !important; min-height:250px !important"
                                src="{{ url($item->imagepath) }}" alt=""></a>
                    </div>
                    <h3>{{ $item->name }}</h3>
                    <p class="product-price"><span>{{ $item->quantity }}</span> {{ $item->price }} $ </p>
                    <a href="/addproducttocart/{{$item -> id}}" class="cart-btn">
                        <i class="fas fa-shopping-cart"></i>
                        إضافة إلى السلة
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


