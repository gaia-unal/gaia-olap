@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

	<div class="box box-success">
		<div class="box-header with-border">
			<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Selecciones Tablas a Usar</i></font></strong></h1>
			<div class="box-tools pull-right">
				<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body box-dealgut">

			<br /><br /><br />
			{!! Form::open(['route'=> 'Creator.processComplete.proccessTables','method'=> 'POST', 'class'=> 'form-horizontal', 'id'=>'formulario']) !!} 
				<div class="form-group">

					<div class="col-md-8 col-md-offset-2 invoice-col" align="center">		
						<div class="col-md-4">
							<select class="col-md-12 " name="origen[]" id="origen" multiple="multiple" size="8">
							<ul>
								@foreach($tables as $table)
									
								<li><option class="col-md-12 " value="{{$table->tablename}}">{{$table->tablename}}</option></li>
									
								@endforeach
							</ul>
							</select>
						</div>
						<div class="col-md-2">
							<button type="button" class="glyphicon glyphicon-forward pasar izq btn btn-default"></button>

							<button type="button" class="glyphicon glyphicon-backward quitar izq btn btn-default"></button>

							<button type="button" class="glyphicon glyphicon-fast-forward pasartodos izq btn btn-default"></button>

							<button type="button" class="glyphicon glyphicon-fast-backward quitartodos der btn btn-default"></button>

						</div>
						<div class="col-md-4">
							<select class="col-md-12" name="destino[]" id="destino" multiple="multiple" size="8"></select>
						</div>
					</div>
				</div>
		</div>

			<div class="form-group ">
				<label class="col-md-3 control-label col-md-offset-2" >seleccione TABLA de HECHOS</label>	
				<div class="col-md-4">
					<select class="form-control" name="fact[]" id="fact"></select>
				</div>			
			</div>
			<br /><br /><br />
			
            <div align="center">
                <p class="text-muted">Nota: Seleccione las tablas que desea incluir en el cubo; Acto seguido seleccione la tabla de hechos</p> 
            </div>

		<div class="box-footer">
			<a href="{{ route('Creator.index') }}" class="btn btn-default">Cancelar</a>
	
			<div class="pull-right">
				<button  type="submit" class=" submit clear btn btn-success pull-right" value="Procesar formulario" >Siguiente</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>											
@endsection

@section('personal-js')
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('.pasar').click(function() {
		 	return !$('#origen option:selected').remove().appendTo('#destino'); 
		});

		$('.quitar').click(function() {
			return !$('#destino option:selected').remove().appendTo('#origen');
		});

		$('.pasar').click(function() {
			return !$('#fact option').remove(); 
		});
		
		$('.quitar').click(function() {
			return !$('#fact option').remove(); 
		});
		
		$('.pasartodos').click(function() {
			return !$('#fact option').remove(); 
		});
		
		$('.quitartodos').click(function() {
			return !$('#fact option').remove(); 
		});

		$('.pasar').click(function() {
			return !$('#destino option').clone().appendTo('#fact'); 
		});

		$('.quitar').click(function() {
			return !$('#destino option').clone().appendTo('#fact'); 
		});

		$('.pasartodos').click(function() { 
			$('#origen option').each(function() {
				$(this).remove().appendTo('#destino'); 
			});
			$('#destino option').clone().appendTo('#fact');
		});

		$('.quitartodos').click(function() { 
			$('#destino option').each(function() {
				$(this).remove().appendTo('#origen');
			});
		});

		$('.submit').click(function() {
			$('#destino option').prop('selected', 'selected');
		});

	});
</script>
@endsection