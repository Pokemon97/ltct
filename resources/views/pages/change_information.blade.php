@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h3 class="inner-title">Sửa thông tin cá nhân</h3>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('home-page')}}">Home</a> / <span>Sửa thông tin cá nhân</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    
    <div class="container">
        <div id="content">
            
            <form action="{{route('change_information')}}" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-3"></div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="col-sm-6">
                        <h4>Sửa thông tin cá nhân </h4>
                        <div class="space20">&nbsp;</div>

                        
                        <div class="form-block">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required value="{{Auth::user()->email}}" readonly="">
                        </div>

                        <div class="form-block">
                            <label for="your_last_name">Họ Tên*</label>
                            <input type="text" id="your_last_name" name="fullname" value="{{Auth::user()->full_name}}" required>
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa Chỉ</label>
                            <input type="text" id="adress" name="address" value="{{Auth::user()->address}}">
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện Thoại</label>
                            <input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}">
                        </div>

                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Reset</button>

                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection