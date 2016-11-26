@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection


@section('main-content')

	<div class="container spark-screen">
		<div class="row">
			<h1 class="">Cubos Olap Desarrollados</h1>
			<div class=" col-md-11">
			@foreach($connections as $connection)
			
				<div class="box box-success">
					
					<div class="box-header with-border">
						<h5 class="box-title"><span class="glyphicon glyphicon-folder-open" aria-hidden="true">&nbsp</span> Conexión {{$connection->name}}</h5>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" ><i class="glyphicon glyphicon-th"></i></button>
							<button class="btn btn-box-tool" ><i class="glyphicon glyphicon-th-list"></i></button>
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					
					<div class="box-body box-dealgut">
					@foreach($connection->cubes as $cube)
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="info-box">
							  <span class="info-box-icon bg-default"><i class="fa fa-line-chart"></i></span>
							  <div class="info-box-content">
							    <span class="info-box-text">{{ $cube->name}}</span>
							    <span class="info-box-description">{{ $cube->description}}</span>
							  </div>
							  <div class="pull-right">
							    <span class="info-box-number pull-right"><a class="btn btn" href="{{ route('Creator.Dashboard.index', $cube->id) }}"><i class="fa fa-play"></i>&nbsp Acceder</a></span>
							  </div>
							</div>	
						</div>
					@endforeach
					</div>
					
				</div>


			@endforeach
			</div>
		</div>
	</div>
@endsection
