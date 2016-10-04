@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection


@section('main-content')

<div class="box box-success">
    <div class="box-header with-border">
        <h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Crear Conexión</i></font></strong></h1>
        <div class="box-tools pull-right">
            <button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>

    <div class="box-body">

        <h2 class="text-center text-success">Estas creando un cubo para la Conexión {{ $connection->name}} </h2>       

        @include('layouts.partials.errors')

        {!! Form::open(['route'=> 'Creator.processComplete.storeCube','method'=> 'POST', 'class'=> 'form-horizontal']) !!}   


            <div class="fieldForm">
                {!! Form::hidden('connectionId', $connection->id,  ['value' => $connection->id]) !!}
            </div>

            <div class="form-group has-feedback">
                {!! Form::label('name','Nombre',['class' => 'col-sm-2 control-label']) !!}          
                <div class="col-sm-10">
                    {!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Nombre','required']) !!}
                </div>
            </div>

            <div class="form-group has-feedback">
                {!! Form::label('description','Descripción',['class' => 'col-sm-2 control-label']) !!}          
                <div class="col-sm-10">
                    {!! Form::textArea('description', null ,['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
                </div>
            </div>

            <div align="center">
                <p class="text-muted">Nota: Ingrese Los datos Generales del CUBO para la conexión {{ $connection->name}}</p> 
            </div>

            <div class="box-footer">
                <a href="{{ route('Creator.index') }}" class="btn btn-default">Cancelar</a>
                
                <div class="pull-right">
                    <button  type="submit" class="btn btn-success pull-right"  >Siguiente</button>
                </div>

            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
