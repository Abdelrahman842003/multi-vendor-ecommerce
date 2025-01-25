<div class="single-product">
    <div class="product-image">
        <img src="{{asset($product->image_url)}}" alt="#">
        @if($product->sale_price)
            <span class="sale-tag">-{{$product->sale_price}}%</span>
        @endif

        <div class="button">
            <a href="{{route('frontend.product.show', $product->id)}}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>

        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{route('frontend.product.show', $product->id)}}">{{ \Illuminate\Support\Str::limit($product->name, 20) }}</a>
        </h4>
        <ul class="review">
            @for($i=1; $i <= 5; $i++)
                <li><i class="lni {{ $i <= $product->rating ? 'lni-star-filled' : 'lni-star' }}"></i></li>
            @endfor
            <li><span> Review({{ $product->rating}})</span></li>
        </ul>
        <div class="price">
            <span>{{ $product->price}} $</span>
            @if($product->compare_price != null)
                <span class="discount-price">{{ $product->compare_price }} $</span>
            @endif
        </div>
    </div>
</div>
