

<div class="form-group has-feedback">
	{!! Form::label('connectionId','Conexión',['class' => 'col-sm-2 control-label']) !!}
		
	<div class="col-sm-10">
		{!! Form::select('connectionId',$connections, null, ['class' => 'form-control', 'required']) !!}
	</div>			
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
		{!! Form::text('description', null ,['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
	</div>
</div>

<div class="box-footer">
	<a href="{{ route($cancelar) }}" class="btn btn-default">Cancelar</a>
	
	<div class="pull-right">
		<button  type="submit" class="btn btn-success pull-right"  >Enviar</button>
	</div>

</div>