@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h3 class="inner-title">Thông tin cá nhân</h3>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('home-page')}}">Home</a> / <span>Thông tin cá nhân</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<form  class="beta-form-checkout">
				
			
					
						<h4>Thông tin cá nhân </h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="email">Email: {{Auth::user()->email}}</label>
						</div>

						<div class="form-block">
							<label for="your_last_name">Họ Tên: {{Auth::user()->full_name}}</label>
						</div>

						<div class="form-block">
							<label for="adress">Địa Chỉ: {{Auth::user()->address}}</label>
						</div>

						<div class="form-block">
							<label for="phone">Điện Thoại: {{Auth::user()->phone}}</label>
						</div>
						<div class="form-block">
							
						
						<a href="{{route('change_information')}}"><b style="color: blue; font-size: 120%">Sửa thông tin</b></a>
						
					
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection