@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		<div class="panel panel-primary col-xs-4">
			<div class="panel-heading">Register Worker</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				<div class="register-box-body">
					<p class="login-box-msg">Register a new worker</p>

					<form method="post" action="{{ url('/registerworker') }}">

						{!! csrf_field() !!}

						<div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
							<span class="glyphicon glyphicon-user form-control-feedback"></span>

							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>

							@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>

							@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>

							@if ($errors->has('password_confirmation'))
							<span class="help-block">
								<strong>{{ $errors->first('password_confirmation') }}</strong>
							</span>
							@endif
						</div>

						<div class="row">
							<!-- /.col -->
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
							</div>
							<!-- /.col -->
						</div>
					</form>


				</div>

			</div>
			
		</div>

	</div>
</div>
@endsection
