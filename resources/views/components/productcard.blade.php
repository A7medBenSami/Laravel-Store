                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{$product->image_url}}" alt="#">
                            @if ($product->sale)
                                <span class="sale-tag">-{{$product->sale}}%</span>
                            @endif

                            @if ($product->new)
                                <span class="new-tag">New</span>
                            @endif





                            <div class="button">
                                <form action="{{route('cart.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                <a href="{{route('cart.store')}}" class="btn"><i class="lni lni-cart"></i> {{__('Add To Cart')}}</a>
                                </form>
                            </div>




                        </div>
                        <div class="product-info">
                            <span class="category">{{$product->category->name}}</span>
                            <h4 class="title">
                                <a href="{{route('product.show',$product->slug)}}">{{$product->name}}</a>
                            </h4>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                <span>${{$product->price}}</span>
                                <span class="discount-price">${{$product->compare_price}}</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
