@extends('master')
@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="row" style="align-items: center; padding-left: 40px">
            <div class="col-sm-4">
                <img src="source/image/product/{{$product->image}}"/>
            </div>
            <div class="col-sm-8">
                <div class="single-item-body">
                    <p class="single-item-title"><h2>{{$product->name}}</h2></p>
                    <br/>
                    <p class="single-item-price">
                        <span>Giá:</span>
                        @if($product->promotion_price != 0)
                            <span class="flash-del">{{$product->unit_price}}đ</span>
                            <span class="flash-sale">{{$product->promotion_price}}đ</span>
                        @else
                            <span class="flash-sale">{{$product->unit_price}}đ</span>
                        @endif
                    </p>
                </div>
                <div class="clearfix"></div>
                <div class="space20">&nbsp;</div>
                <div style="padding-bottom: 20px; font-size: 20px">
                    @if($product->quantity > 0)
                        <span style="color: green">Còn hàng</span>
                    @else
                        <span style="color: red">Hết hàng</span>
                    @endif
                </div>
                <div class="single-item-desc">
                    <span style="font-size: 20px">Mô tả:</span><span style="font-size: 16px">{!!$product->description!!}</span>
                </div>

                <div class="single-item-options">
                    <br/>
                    <a><u><i><b style="font-size: 200%; color: red">Thêm vào giỏ hàng:</b></i></u></a>
                    <a class="add-to-cart" href="{{route('add-to-cart', $product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection