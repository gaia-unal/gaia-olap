@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection


@section('main-content')

	<div class="container spark-screen">
		<div class="row">
			<div class=" col-md-11,5">
			
				<div class="box box-primary">
					
					<div class="box-header with-border">
						<h5 class="box-title">Cubos Olap Desarrollados</h5>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" ><i class="glyphicon glyphicon-th"></i></button>
							<button class="btn btn-box-tool" ><i class="glyphicon glyphicon-th-list"></i></button>
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					
					<div class="box-body box-dealgut">

						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
							  <span class="info-box-icon bg-default"><i class="fa fa-star-o"></i></span>
							  <div class="info-box-content">
							    <span class="info-box-text">Likes</span>
							    <span class="info-box-number">93,139</span>
							  </div>
							</div>	
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
