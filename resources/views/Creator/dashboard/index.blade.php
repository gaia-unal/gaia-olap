@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')

<div class="col-lg-12 container-fluid">
	<div class="row">
		<div class="panel panel-default col-lg-2">
			<div class="" id="option-grafic">
				hola
			</div>
			<br/>
			<div class="" id="option-columns">

				<div class="menu-option-columns btn-group btn-group-xs " id="">
					<a href="#" class="btn btn-default" id="central">Central</a>
					<a href="#" class="btn btn-default " id="dimenciones">Dimenciones</a>
				</div>

 				<div class="central" id="option-central">
 					<ul id="sortable1" class="connectedSortable list-group">

				  		<?php foreach ($fieldsNoForeign as $key => $value): ?>
				  			<li class="ui-state-default list-group-item" id="{{$key}}" name="central">{{$value}}</li>	
				  		<?php endforeach ?>
			  		
					</ul>
 				</div>

 				<div class="dimenciones" id="option-dimenciones" style="display: none;">
				  	<ul id="sortable2" class="connectedSortable list-group">
				  		<?php foreach ($fieldsForeign as $key => $value): ?>
				  			<li class="ui-state-default list-group-item" id="{{$key}}" name="dimenciones">{{$value}}</li>	
				  		<?php endforeach ?>
				  	</ul>
 				</div>
			</div>
			
		</div>
		<div class="panel panel-success col-lg-8">
			<div class="col-lg-12" id="option-selected">
				<div class="col-lg-11 pull-right" id="y">
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <div class="navbar-header">
							<ul id="sortable3" class="connectedSortable list-inline">
							  <li class="ui-state-highlight list-group-item">Item 1</li>
							</ul>
					    </div>
					  </div>
					</nav>
				</div>
				<div class="col-lg-11 pull-right" id="x">
					<nav class="navbar navbar-default">
					  <div class="container-fluid">
					    <div class="navbar-header">
							<ul id="sortable4" class="connectedSortable list-inline">
							  <li class="ui-state-highlight list-group-item">Item 1</li>
							</ul>
					    </div>
					  </div>
					</nav>
				</div>
			</div>

			<br />

			<div class="col-lg-12" id="grafic">

				 hola

			</div>
		</div>
		<div class="panel panel-default col-lg-2">
			<div class="" id="">
				hola
			</div>
			<div class="" id="option-operation">
				hola
			</div>
			
		</div>
	</div>
</div>

@endsection

@section('personal-js')
	<script type="text/javascript">
		var body = document.getElementById("body").classList.add('sidebar-collapse');
	</script>


	<script type="text/javascript">
		$("#dimenciones").click(function(e){  
			$("#option-central").css("display", "none");
			$("#option-dimenciones").css("display", "block");
	    });

	    $("#central").click(function(e){  
			$("#option-dimenciones").css("display", "none");
			$("#option-central").css("display", "block");
	    }); 
	</script>

	  <script>
		  $( function() {
		    $( "#sortable1, #sortable2, #sortable3, #sortable4" ).sortable({
		      connectWith: ".connectedSortable",
		      cursor: "move"
		    }).disableSelection();
		  } );
 	 </script>
@endsection   