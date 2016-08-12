@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

				<div class="box box-success">
					<div class="box-header with-border">
						<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Lista de Usuarios</i></font></strong></h1>
						<div class="box-tools pull-right">
							<a href="{{ route('Admin.user.create') }}" class="btn btn-box btn-success"><i class="glyphicon glyphicon-edit"> Nuevo</i></a>
							<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>

					<div class="box-body box-dealgut">

					 <table id="example" class="table table-striped table-bordered">
					        <thead>
					            <tr class="success">
					                <th>Id</th>
					                <th>Nombre</th>
					                <th>Correo</th>
					                <th>rol</th>
					                <th>Acciones</th>

					            </tr>
					        </thead>     

							<tbody>
								@foreach($users as $user)
								{{ Form::open(['route'=> ['Admin.user.destroy', $user->id],'method'=> 'DELETE']) }}
									<tr>
										<td>{{ $user-> id}}</td>
										<td>{{ $user-> name}}</td>
										<td>{{ $user-> email}}</td>
										<td>{{ $user-> type}}</td>
										<td>
											<div class="buttonsTable">
												<a href="{{ route('Admin.user.show', $user->id) }}" class="btn btn-box-tool" ><i class="glyphicon glyphicon-eye-open"></i></a>

												<a href="{{ route('Admin.user.edit', $user->id) }}" class="btn btn-box-tool" ><i class="glyphicon glyphicon-pencil"></i></a>


													<button type="submit" class="btn btn-box-tool" ><i class="glyphicon glyphicon-trash"></i></button>

											</div>	
										</td>
									</tr>
									{!! Form::close() !!}	
								@endforeach
							</tbody>
						</table>
						{!! $users->render() !!}
					  </div>
				</div>
												
@endsection