@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h3 class="inner-title">Đổi mật khẩu</h3>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('home-page')}}">Home</a> / <span>Đổi mật khẩu</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form action="{{route('change_password')}}" method="post" class="beta-form-checkout">
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
					@if(session('loi'))
                        <div class="alert alert-danger">
                                {{session('loi')}}
                        </div>
                    @endif

					@if(Session::has('success'))
						<div class="alert alert-success">{{Session::get('success')}}</div>
					@endif
					<div class="col-sm-6">
						<h4>Đổi mật khẩu </h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="phone">Mật Khẩu cũ*</label>
							<input type="password" id="old_password" name="old_password" required>
						</div>

						<div class="form-block">
							<label for="phone">Mật Khẩu mới*</label>
							<input type="password" id="password" name="password" required>
						</div>
						<div class="form-block">
							<label for="phone">Nhập Lại Mật Khẩu*</label>
							<input type="password" id="re_password" name="re_password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection