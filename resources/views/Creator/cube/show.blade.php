@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="row">
	<div class="col-md-4">
		<div class="box box-success">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ asset('img/3d-cube.png') }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $cube->name }}</h3>
				<p class="text-muted text-center">{{ $cube->connection->name }}</p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Tablas</b>
						<a class="pull-right">10</a>
					</li>
					<li class="list-group-item">
						<b>Compartido</b>
						<a class="pull-right">50</a>
					</li>
					<li class="list-group-item">
						<b>visualizaciones</b>
						<a class="pull-right">3000</a>
					</li>
					<li class="list-group-item">
						<b>Descripcion</b>
						<a class="pull-right">{{ $cube->description }}</a>
					</li>
				</ul>
				<a href="{{ route('Creator.cube.index')}}" class="btn btn-success  col-md-5"><b>
				Volver</b></a>
				&nbsp;
				<a href="{{ route('Creator.cube.edit', $cube->id)}}" class="btn btn-success col-md-5 pull-right"><b>
				Editar</b></a>
			</div>
		</div>
	</div>
	<div class="col-md-8">
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