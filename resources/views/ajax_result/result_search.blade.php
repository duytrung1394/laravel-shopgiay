@if(count($product) > 0)
        @foreach($product as $value)
        <div class='view-item'>
            <div class="media">
                <img class="" src="uploaded/product/{{$value->image_product}}" alt="image" width="45px">
                <div class="media-body">
                    <p class="mt-0 media__product-title"><a href="san-pham/{{$value->id}}/{{$value->slug_name}}.html">{!!changeColorkeySearch($key_search,$value->name)!!}</a></p>
                    <p>
                    @if($value->promotion_price > 0 )
                        <span class="product__price-on-sale product-price__popup">{{number_format($value->promotion_price)}}</span>
                        <s class="product__price--compare product-price__popup">{{number_format($value->unit_price)}}</s> vnđ
                    @else
                        <span class="product-price__popup"> {{number_format($value->unit_price)}}</span> vnđ
                    @endif
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <p class='text-center' style='margin: 10px;'>Không có sản phẩm phù hợp </p>
    @endif