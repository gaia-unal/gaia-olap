@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="box box-success">
	<div class="box-header with-border">
		<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Crear Cube</i></font></strong></h1>
		<div class="box-tools pull-right">
			<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>

	<div class="box-body">

	    @include('layouts.partials.errors')

		{!! Form::model($connections,['route'=> 'Creator.cube.store','method'=> 'POST', 'class'=> 'form-horizontal']) !!}	
			@include('form.cube.cubeForm',['cancelar' => 'Creator.cube.index', 'action' => 'create'])
		{!! Form::close() !!}
	</div>
</div>

@endsection