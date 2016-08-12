
		
		<div class="box-body">
			<div class="form-group has-feedback">
				{!! Form::label('name','Nombre',['class' => 'col-sm-2 control-label']) !!}
				
				<div class="col-sm-10">
					{!! Form::text('name', $user->name ,['class' => 'form-control', 'placeholder' => 'Nombre','required']) !!}
				</div>
			</div>

			<div class="form-group">
				{!! Form::label('email','Correo Electronico',['class' => 'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					{!! Form::email('email', $user->email ,['class' => 'form-control', 'placeholder' => 'exmple@gmail.com','required']) !!}	
				</div>
			</div>
			
			<div class="form-group">
				{!! Form::label('type','Rol',['class' => 'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					{!! Form::select('type', ['Admin' => 'Administrador', 'Creator' => 'Creador' ] ,$user->type, ['class' => 'form-control','required']) !!}
				</div>			
			</div>

			<div class="box-footer">
				<a href="{{ route($cancelar) }}" class="btn btn-default">Cancelar</a>
				<button  type="submit" class="btn btn-success pull-right">Enviar</button>
			</div>
		</div>