<x-front-layout title="Cart">


    <x-slot name='breadcrumb'>
            <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{__('Cart')}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('home')}}"><i class="lni lni-home"></i> {{__('Home')}}</a></li>
                        <li><a href="{{route('product.index')}}">{{__('Shop')}}</a></li>
                        <li>{{__('Cart')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    </x-slot>

        <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>{{__('Product Name')}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{__('Quantity')}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{__('Subtotal')}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>{{__('Discount')}}</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>{{__('Remove')}}</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->
                @foreach ($cart->get() as $item)


                <!-- Cart Single List list -->
                <div class="cart-single-list" id="{{$item->id}}">
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-md-1 col-12">
                            <a href="{{route('product.show',$item->product->slug)}}">
                                <img src="{{$item->product->imageurl}}" alt="#"></a>
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <h5 class="product-name"><a href="{{route('product.show',$item->product->slug)}}">
                                    {{$item->product->name}}</a></h5>
                            <p class="product-des">
                                <span><em>Type:</em> Mirrorless</span>
                                <span><em>Color:</em> Black</span>
                            </p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="count-input">
                                <input class="form-control item-quantity" data-id="{{$item->id}}" value="{{$item->quantity}}">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>${{$item->quantity * $item->product->price}}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>$0</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <a class="remove-item" data-id="{{$item->id}}" href="javascript:void(0)"><i class="lni lni-close"></i></a>
                        </div>
                    </div>
                </div>
                <!-- End Single List list -->
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>{{__('Cart Subtotal')}}<span>${{$cart->total()}}</span></li>
                                        <li>{{__('Shipping')}}<span>Free</span></li>
                                        <li>{{__('You Save')}}<span>$29.00</span></li>
                                        <li class="last">{{__('You Pay')}}<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="checkout.html" class="btn">{{__('Checkout')}}</a>
                                        <a href="product-grids.html" class="btn btn-alt">{{__('Continue shopping')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->
    @push('scripts')

        <script>
            const csrf_token = "{{ csrf_token() }}";
        </script>
            <!-- Include jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    @endpush

</x-front-layout>