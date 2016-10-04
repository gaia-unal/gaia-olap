@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

	<div class="box box-success">
		<div class="box-header with-border">
			<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Indique la Conexión</i></font></strong></h1>
			<div class="box-tools pull-right">
				<a href="{{ route('Creator.processComplete.createdConnection') }}" class="btn btn-box btn-success"><i class="glyphicon glyphicon-edit">Nueva</i></a>
				<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body box-dealgut">

			<br><br>

			{!! Form::open(['route'=> 'Creator.processComplete.selectedConnection','method'=> 'POST', 'class'=> 'form-horizontal', 'id'=>'ConnectionCreate']) !!}	
				
				<div class="form-group has-feedback">
					
					{!! Form::label('connectionId','Conexión',['class' => 'col-sm-2 control-label']) !!}
					<div class="col-sm-10">
						{!! Form::select('connectionId',$connections, null, ['class' => 'form-control', 'required']) !!}
					</div>			
				</div>
				<div align="center">
					<p class="text-muted">Nota: Seleccione una conexión, si la conexión que desea no esta creada proceda a crear una accediendo desde el boton "Nueva".</p>	
				</div>

				<div class="box-footer">
					<a href="{{ route('Creator.index') }}" class="btn btn-default">Cancelar</a>
					
					<div class="pull-right">
						<button  type="submit" class="btn btn-success pull-right">Siguiente</button>
					</div>

				</div>

			{!! Form::close() !!}
		</div>
	</div>
												
@endsection