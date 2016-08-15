
<div class="form-group has-feedback">
	{!! Form::hidden('userId', currentUser()->id,  ['value' => currentUser()->id]) !!}	
</div>

<div class="form-group has-feedback">
	{!! Form::label('name','Nombre',['class' => 'col-sm-2 control-label']) !!}			
	<div class="col-sm-10">
		{!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Nombre','required']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('host','Host',['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('host', null ,['class' => 'form-control', 'placeholder' => '','required']) !!}	
	</div>
</div>
			
<div class="form-group">
	{!! Form::label('port','Puerto',['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::number('port', null ,['class' => 'form-control', 'placeholder' => '','required']) !!}
	</div>			
</div>

<div class="form-group">
	{!! Form::label('userName','Nombre de Usuario',['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('userName', null ,['class' => 'form-control', 'placeholder' => '','required']) !!}	
	</div>
</div>

<div class="form-group">
	{!! Form::label('database','Base de datos',['class' => 'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::text('database', null ,['class' => 'form-control', 'placeholder' => '','required']) !!}	
	</div>
</div>			

@if($action == 'create')

	<div class="form-group">
		{!! Form::label('password','Contraseña',['class' => 'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********','required']) !!}	
		</div>
	</div>
@endif

<div class="box-footer">
	<a href="{{ route($cancelar) }}" class="btn btn-default">Cancelar</a>
	
	<div class="pull-right">
		<button  type="submit" class="btn btn-success pull-right"  >Enviar</button>
		&nbsp;
		<a href="#" class="btn btn-default" id='test_connection' disabled="none">Probar</a>
	</div>

</div>