@extends('Layouts.master')
@section('content')
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">
                    <h3><span class="orange-text">آراء</span> العملاء</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-5 mb-lg-0">
                <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="POST" action="/storeReview">
                            @csrf()
                            <p>
                                <input type="text"  placeholder="Name" name="name" id="name" value="{{old('name')}}">
                                <span class="text-danger">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </span>
                                <input type="text" required
                                placeholder="phone" name="phone" id="phone" value="{{old('phone')}}">
                                <span class="text-danger">
                                    @error('phone')
                                        {{$message}}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="email"  required
                                placeholder="email" name="email" id="email" value="{{old('email')}}">
                                <span class="text-danger">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </span>
                                <input type="text"  required placeholder="Subject" name="subject" id="subject" value="{{old('subject')}}">
                                <span class="text-danger">
                                    @error('subject')
                                        {{$message}}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="message" id="message" required cols="30" rows="10" placeholder="message" >
                                    {{old('message')}}
                                </textarea>
                                <span class="text-danger">
                                    @error('message')
                                        {{$message}}
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


<div class="testimonail-section mt-80 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="testimonial-sliders">
                    @foreach ($reviews as $item)
                        <div class="single-testimonial-slider">
                            <div class="client-avater">
                                <img src="assets/img/avaters/avatar2.png" alt="">
                            </div>
                            <div class="client-meta">
                                <h3>{{$item -> name}}<span>{{$item -> subject}}</span></h3>
                                <p class="testimonial-body">
                                    {{$item -> message}}
                                </p>
                                <div class="last-icon">
                                    <i class="fas fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



