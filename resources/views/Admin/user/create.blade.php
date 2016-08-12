@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="box box-success">
	<div class="box-header with-border">
		<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Crear Usuario</i></font></strong></h1>
		<div class="box-tools pull-right">
			<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>

	    @include('layouts.partials.errors')

		{!! Form::open(['route'=> 'Admin.user.store','method'=> 'POST', 'class'=> 'form-horizontal']) !!}
			@include('form.user.createForm',['cancelar' => 'Admin.user.index'])
		{!! Form::close() !!}

</div>

@endsection