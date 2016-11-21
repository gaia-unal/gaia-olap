@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

				<div class="box box-success">
					<div class="box-header with-border">
						<h1 class="box-title"><strong><font color="#00a65a" size="5px"><i>Lista de Cubos</i></font></strong></h1>
						<div class="box-tools pull-right">
							<a href="{{ route('Creator.cube.create') }}" class="btn btn-box btn-success"><i class="glyphicon glyphicon-edit"> Nuevo</i></a>
							<button href="" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>

					<div class="box-body box-dealgut">

					 <table id="example" class="table table-striped table-bordered">
					        <thead>
					            <tr class="success">
					                <th>Id</th>
					                <th>Nombre</th>
					                <th>Description</th>
					                <th>Acciones</th>
					            </tr>
					        </thead>     

							<tbody>
								@foreach($cubes as $cube)
								{{ Form::open(['route'=> ['Creator.cube.destroy', $cube->id],'method'=> 'DELETE']) }}
									<tr>
										<td>{{ $cube-> id}}</td>
										<td>{{ $cube-> name}}</td>
										<td>{{ $cube-> description}}</td>
										<td>
											<div class="buttonsTable">

												<a href="{{ route('Creator.Dashboard.index', $cube->id) }}" class="btn btn-box-tool" ><i class="glyphicon glyphicon-signal"></i></a>

												<a href="{{ route('Creator.cube.show', $cube->id) }}" class="btn btn-box-tool" ><i class="glyphicon glyphicon-eye-open"></i></a>

												<a href="{{ route('Creator.cube.edit', $cube->id) }}" class="btn btn-box-tool" ><i class="glyphicon glyphicon-pencil"></i></a>


													<button type="submit" class="btn btn-box-tool" ><i class="glyphicon glyphicon-trash"></i></button>

											</div>	
										</td>
									</tr>
									{!! Form::close() !!}	
								@endforeach
							</tbody>
						</table>
						{!! $cubes->render() !!}
					  </div>
				</div>
												
@endsection