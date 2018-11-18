@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản phẩm</h4>
                        <br>
                        <div class="row">
                            @foreach($product as $new)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="single-item-header">
                                        <a href="{{route('productDetail', $new->id)}}"><img src="source/image/product/{{$new->image}}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title"><b style="color: red; font-size: 125%"><i>{{$new->name}}</i></b></p>
                                        <p class="single-item-price">
                                            @if($new->promotion_price != 0)
                                                <span class="flash-del">{{$new->unit_price}}đ</span>
                                                <span class="flash-sale">{{$new->promotion_price}}đ</span>
                                            @else
                                                <span class="flash-sale">{{$new->unit_price}}đ</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('add-to-cart', $new->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('productDetail', $new->id)}}">Chi tiết<i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
@endsection