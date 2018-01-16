@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')
<br>
<div class="row">

	<div class="col-md-4">
		<div class="box box-success">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="{{ asset('img/connection.png') }}" alt="User profile picture">
				<h3 class="profile-username text-center">{{ $connection->name }}</h3>
				<p class="text-muted text-center">{{ $connection->user->name }}</p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Host</b>
						<a class="pull-right">{{ $connection->host }}</a>
					</li>
					<li class="list-group-item">
						<b>Puerto</b>
						<a class="pull-right">{{ $connection->port }}</a>
					</li>
					<li class="list-group-item">
						<b>Nombre de usuario</b>
						<a class="pull-right">{{ $connection->userName }}</a>
					</li>
					<li class="list-group-item">
						<b>Base de datos</b>
						<a class="pull-right">{{ $connection->database }}</a>
					</li>
				</ul>
				<a href="{{ route('Creator.connection.index')}}" class="btn btn-success  col-md-5"><b>
				Volver</b></a>
				&nbsp;
				<a href="{{ route('Creator.connection.edit', $connection->id)}}" class="btn btn-success col-md-5 pull-right"><b>
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
   				<img class="" width="600" align="center"  src="{{ asset('img/graficos.png') }}" alt="User profile picture">
			</div>
		</div>
	</div>
</div>


@endsection
