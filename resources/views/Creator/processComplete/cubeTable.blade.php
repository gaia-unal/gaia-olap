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

			{!! Form::open(['route'=> 'Creator.processComplete.storeConnection','method'=> 'POST', 'class'=> 'form-horizontal', 'id'=>'formulario']) !!} 
				<div class="row">
					<div class="col-md-8 .col-md-offset-2" align="center">		
						<div class="col-md-4">
							<select name="origen[]" id="origen" multiple="multiple" size="8">
								@foreach($tables as $table)
									<option value="{{$table->tablename}}">{{$table->tablename}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4">
							<input type="button" class="pasar izq btn btn-default" value="Pasar »">
							<input type="button" class="quitar der btn btn-default" value="« Quitar">
							<br />
							<input type="button" class="pasartodos izq btn btn-default" value="Todos »">
							<input type="button" class="quitartodos der btn btn-default" value="« Todos">
						</div>
						<div class="col-md-4">
							<select name="destino[]" id="destino" multiple="multiple" size="8"></select>
						</div>
					</div>
				</div>
				<div class="">
					<select name="fact[]" id="fact"></select>
				</div>
				<p class="clear"><input type="submit" class="submit" value="Procesar formulario"></p>


			{!! Form::close() !!}
		</div>
	</div>											
@endsection

@section('personal-js')
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
		$('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen'); });
		$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); }); });
		$('.quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); }); });
		$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
	});
</script>
@endsection