@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="box box-success">
	<div class="box-header with-border">
		<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Actualizar Usuario</i></font></strong></h1>
		<div class="box-tools pull-right">
			<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
		@include('layouts.partials.errors')
		{!! Form::model($connection, ['route'=> ['Creator.connection.update', $connection],'method'=> 'PUT', 'class'=> 'form-horizontal']) !!}
		
			@include('form.connection.connectionForm',['cancelar' => 'Creator.connection.index', 'action' => 'update'])
		
		{!! Form::close() !!}
	</div>

@endsection