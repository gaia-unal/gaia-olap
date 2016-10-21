@extends('layouts.app')

@section('htmlheader_title')
	{{ Auth::user()->name }}
@endsection

@section('main-content')
<style type="text/css">

#option-central,#option-dimension{
    min-width: 150px;
    min-height: 30px;
   /*border: 1px solid green;*/
}
#operation-option, #operation-dimension {
    min-width: 150px;
    min-height: 250px;
	/*border: 1px solid green;*/
}
#grafic {
    min-width: 500px;
    min-height: 500px;
    -webkit-border-radius: 50px;
	-moz-border-radius: 5px;
	border-radius: 5px; 
	/*border: 1px solid green;*/
}
#y-central, #x-dimension {
    min-width: 500px;
    min-height: 50px;
	/*border: 1px solid green;*/
}

#option-central, #option-dimension {
    margin-top: 1em;
    width: 50px;
}
.select {
	border: 1px solid #ccc;
	width: 100px;
	overflow: hidden;
	-webkit-border-radius: 50px;
	-moz-border-radius: 5px;
	border-radius: 5px;
  
}
.select-option, .dimention-selected{
    min-width: 150px;
    min-height: 70px;
	border: 1px solid green;
    -webkit-border-radius: 50px;
	-moz-border-radius: 5px;
	border-radius: 5px;

}
.option-locale{
	height: 20px;
    width: 100px;
    margin: 0 auto;
}
.option-field {
    height: 25px;
    width: 140px;
    margin: 5px;
    text-align: center;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;

}
#y-central .option-field ,#x-dimension .option-field, #option-central .ui-sortable-placeholder, 
	#option-dimension .ui-sortable-placeholder {
    display: inline-block;
}
.defect-color {
    background-color: #4F7F70;
}
.ui-sortable-placeholder {
    border: 1px dotted black;
    visibility: visible !important;
    background-color: inherit;
}
}
</style>
<div class="col-lg-12 container-fluid">
	<div class="row">
		<div class="panel panel-default col-lg-2">
			<div class="page-header">
				<h5 class="">Opciones Operación</h5>
			</div>		
 			<div class="option-central connectedSortable-central" id="option-central">
 					
				<?php foreach ($fieldsNoForeign as $key => $value): ?>
				  	<div class="option-field defect-color" id="{{$key}}" name="{{$value}}"><p>{{$value}}</p></div>	
				<?php endforeach ?>
			</div>
			<br>
			<div class="page-header">
				<h5>Opciones Agrupación</h5>
			</div>
			
			<div class="option-dimension connectedSortable-dimension" id="option-dimension">  	
				<?php foreach ($fieldsForeign as $key => $value): ?>
					<div class="option-field defect-color" id="{{$key}}" name="{{$value}}"><p>{{$value}}</p></div>	
				<?php endforeach ?>  	
 			</div>	
 			<br>
 			<br>
		</div>

		<div class="panel panel-success col-lg-8">
		<br>

			<div class="col-lg-12" id="option-selected">
				<div  class="col-lg-12">
					<div class="col-lg-1 pull-left">
						<h5>Operación (y): </h5>
					</div>
					<div class="col-lg-10 pull-right" id="y">
						<nav class="navbar navbar-default">
						  <div class="container-fluid">
						    <div class="navbar-header">
								<div class="y-central connectedSortable-central" id="y-central">
									
								</div>
						    </div>
						  </div>
						</nav>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="col-lg-1 pull-left">
						<h5>Agrupación (x): </h5>
					</div>
					<div class="col-lg-10 pull-right" id="x">
						<nav class="navbar navbar-default">
						  <div class="container-fluid">
						    <div class="navbar-header">
								<div class="x-dimension connectedSortable-dimension" id="x-dimension">
									
								</div>
						    </div>
						  </div>
						</nav>
					</div>	
				</div>
			</div>
			<br />
			<div class="grafic col-lg-12" id="grafic">

				 <!-- Load Grafic-->

			</div>
			<br>
			<br>
		</div>
		<div class="panel panel-default col-lg-2">
		{!! Form::open(['id'=>'form-global']) !!}	
			<div class="page-header">
				<h5 class="">Operaciones Sumarias</h5>
			</div>
			<div class="operation-option" id="operation-option">
				<!-- Load Operation Sumary-->

			</div>
			<div class="page-header">
				<h5 class="">Operaciones Agrupación</h5>
			</div>
			<div class="operation-dimension" id="operation-dimension">
				<!-- Load Operation Dimension-->
			</div>
		{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@section('personal-js')
	<script type="text/javascript">
		var body = document.getElementById("body").classList.add('sidebar-collapse');
	</script>

	<script>
        $("#option-central").sortable({
            connectWith: ".connectedSortable-central",
            cursor: "move"
        });
        
        $("#option-dimension").sortable({
            connectWith: ".connectedSortable-dimension",
            cursor: "move"
        });

        var $xcentral = $("#y-central");
        $xcentral.sortable({
            connectWith: ".connectedSortable-central",
            cursor: "move",
            update: function(){ 
				var ordenElements = $(this).sortable("toArray");
				var selectActual = document.querySelectorAll('.option-locale select');
				var cantidadEnY = ordenElements.length;
				var cantidadSelected = lengthSelected();

				if (cantidadSelected > 0) {
					var ids = idsEnSelected(cantidadSelected);
					if (cantidadEnY > cantidadSelected) {

						var nuevo = getNuevo(ids,ordenElements);
						if (nuevo) {
							insertElements(nuevo);
						}

					}else if (cantidadEnY < cantidadSelected) {

						var eliminado = getEliminado(ids,ordenElements);
						var elementoEliminar = $("div[name="+eliminado+"]").remove();
					}else{
						/* Cambiar el orden de los divs*/
					}
				}else{
					insertElements(ordenElements);
					
				}
			}
        });
       	
       	var $ydimension = $("#x-dimension");
        $ydimension.sortable({
            connectWith: ".connectedSortable-dimension",
            cursor: "move",
            update: function(){ 
				var ordenElements = $(this).sortable("toArray").toString();
			    xinsertElements(ordenElements);
			   }
        });






 	</script>



 	<script type="text/javascript">

	 	function getNuevo(ids,ordenElement) {
	 		
	 		for (var i = 0; i < ordenElement.length; i++) {
	 			if (ids.indexOf(ordenElement[i]) == -1) {
	 				return ordenElement[i];
	 			}
	 		}

	 		return false;
	 	}
	 	function getEliminado(ids,ordenElement) {
	 		
	 		for (var i = 0; i < ids.length; i++) {
	 			if (ordenElement.indexOf(ids[i]) == -1) {
	 				return ids[i];
	 			}
	 		}

	 		return false;
	 	}

 		function idsEnSelected(tamanho) {
 			var x = document.querySelectorAll('.option-locale select');
 			var miArray = new Array();
 			for (var i = 0; i < tamanho; i++) {
 				miArray[i] = x[i].id;
 			}
 			return miArray;
 		}
 		function insertElements(elements) {
 			return $( ".operation-option" ).append(elementInsert(elements));
 		}

 		function elementInsert(idElement) {
 			var name = document.getElementById(idElement).getAttribute("name");
 			var id = idElement;
			var elementSelect = "<div class='select-option' name='"+id+"'><div class='option-locale'><label><h5>"+name+"</h5></label><select class='select' id='"+id+"' > <option value='AVG'>Promedio</option> <option value='MIN'>Mínimo</option> <option value='MAX'>Máximo</option><option value='SUM'>Suma</option></select></div></div>";

			return elementSelect;
 		}

 		function lengthSelected() {
        	return document.querySelectorAll('.option-locale select').length;
        }

 		function xinsertElements(elements) {
 			return $( ".operation-dimension" ).append(xelementInsert(elements));

 		}

        function xelementInsert(idElement){
 			var name = document.getElementById(idElement).getAttribute("name");
 			var id = idElement;

			var elementSelect = "<div class='dimention-selected' name='"+id+"'><div class='option-locale'><label><h5>"+name+"</h5></label><select class='select' id='"+id+"'> </select></div></div>";

			return getDimensionFields(id);	
        }

        function getDimensionFields(dimension) {
        	
		    var token, url, data;
		    token = $('input[name=_token]').val();
		    url = '{{route('Creator.Dashboard.getDimensionFields')}}';
		    data = {dimention: dimention};

        }
 	</script>
@endsection


  