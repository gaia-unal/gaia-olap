@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection


@section('main-content')
	
	Seccion Administrador
	
@endsection