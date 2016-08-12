@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="row">
	<div class="col-md-3">
		<div class="box box-success">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ asset('img/avatar.png') }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $user->name }}</h3>
				<p class="text-muted text-center">{{ $user->email }}</p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Conexiones</b>
						<a class="pull-right">1,322</a>
					</li>
					<li class="list-group-item">
						<b>Cubos Creados</b>
						<a class="pull-right">543</a>
					</li>
					<li class="list-group-item">
						<b>Compartidos por mi</b>
						<a class="pull-right">13,287</a>
					</li>
					<li class="list-group-item">
						<b>Compartidos a mi</b>
						<a class="pull-right">13,287</a>
					</li>
				</ul>
				<a href="{{ route('Admin.user.index')}}" class="btn btn-success btn-block"><b>Volver</b></a>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="box box-success">
			<div class="box-header with-border">
				<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Estadisticos</i></font></strong></h1>
				<div class="box-tools pull-right">
					<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
   				<p>Aqui van los estadisticos !cuando esten listos claro!</p>
			</div>
		</div>
	</div>
</div>


@endsection