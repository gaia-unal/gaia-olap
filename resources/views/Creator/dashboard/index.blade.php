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
.option-locale, .dimention-locale{
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
						    	
								<div type="input" class="y-central connectedSortable-central" id="y-central" name="y-central">
									
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
								<div class="x-dimension connectedSortable-dimension" id="x-dimension" name="x-dimension">
									
								</div>
						    </div>
						  </div>
						</nav>
					</div>	
				</div>
			</div>
			<br />

			<div class="col-lg-12">
				<button class="btn btn-success btn-block" type="button" id="generate-cube">Generar CUBO</button>
			</div>

			<div class="grafic col-lg-12" id="grafic">

				 <!-- Load Grafic-->

			</div>
			<br>
			<br>
		</div>
		<div class="panel panel-default col-lg-2">
			{!! Form::open(['id'=>'form-global']) !!}
			<input type="hidden" name="operation-option" value="">
			<input type="hidden" name="operation-dimension" value="">
			<input type="hidden" name="cubeId" value="{{$cubeId}}">

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
	    $("#operation-option").sortable({
            cursor: "move"
        });
        $("#operation-dimension").sortable({
            cursor: "move"
        });
        $("#option-central").sortable({
            connectWith: ".connectedSortable-central",
            cursor: "move"
        });
        
        $("#option-dimension").sortable({
            connectWith: ".connectedSortable-dimension",
            cursor: "move"
        });

        var $ycentral = $("#y-central");
        $ycentral.sortable({
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
       	
       	var $xdimension = $("#x-dimension");
        $xdimension.sortable({
            connectWith: ".connectedSortable-dimension",
            cursor: "move",
            update: function(){ 

					var ordenElements = $(this).sortable("toArray");
					var selectActual = document.querySelectorAll('.dimention-selected select');
					var cantidadEnY = ordenElements.length;
					var cantidadSelected = xlengthSelected();

					if (cantidadSelected > 0) {
						var ids = xidsEnSelected(cantidadSelected);
						if (cantidadEnY > cantidadSelected) {

							var nuevo = xgetNuevo(ids,ordenElements);
							if (nuevo) {
								xinsertElements(nuevo);
							}

						}else if (cantidadEnY < cantidadSelected) {

							var eliminado = xgetEliminado(ids,ordenElements);
							var elementoEliminar = $("div[name="+eliminado+"]").remove();
						}else{
							/* Cambiar el orden de los divs*/
						}
					}else{
						xinsertElements(ordenElements);
						
					}

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

	 	function xgetNuevo(ids,ordenElement) {
	 		
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

	 	function xgetEliminado(ids,ordenElement) {
	 		
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

 		function xidsEnSelected(tamanho) {
 			var x = document.querySelectorAll('.dimention-selected select');
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
			var elementSelect = "<div class='select-option' name='"+id+"'><div class='option-locale'><label for='"+id+"'><h5>"+name+"</h5></label><select class='select' id='"+id+"' name='"+id+"' > <option value='AVG'>Promedio</option> <option value='MIN'>Mínimo</option> <option value='MAX'>Máximo</option><option value='SUM'>Suma</option></select></div></div>";

			return elementSelect;
 		}

 		function lengthSelected() {
        	return document.querySelectorAll('.option-locale select').length;
        }

        function xlengthSelected() {
        	return document.querySelectorAll('.dimention-selected select').length;
        }

 		function xinsertElements(elements) {
 			$( ".operation-dimension" ).append(xelementInsert(elements));
 			
 			return true;
 		}


        function xelementInsert(idElement){
 			var name = document.getElementById(idElement).getAttribute("name");
 			var id = idElement;
 			var options =  getDimensionFields(id);
			var elementSelect = "<div class='dimention-selected' name='"+id+"'><div class='dimention-locale'><label for='"+id+"'><h5>"+name+"</h5></label><select class='select' id='"+id+"' name='"+id+"'></select></div></div>" ;

			return elementSelect;	
        }

        function getDimensionFields(id) {      	
			var options = '';
		    $.ajax({
			    url: '/Creator/Dashboard/getDimensionFields/'+id,
			    type: 'get',
			    dataType: 'JSON',
			    success: function (data) {
			    	$.each(data, function(index, val) {
					    options += '<option value="'+ index +'">'+val+'</option>';
					});
					var elementos = document.querySelectorAll('.dimention-selected select');

					$.each(elementos, function(index, val) {
						 if (id == val.id) {
						 	$(this).append(options);
						 }
					});
			    }
			});

			return options;
        }
 	</script>


 	<script type="text/javascript">
 		$(function(){
			 $("#generate-cube").click(function(){

			 $("input[name='operation-option']").val(optenerValY());
			 $("input[name='operation-dimension']").val(optenerValX());
			 var url = "/Creator/Dashboard/informationConsultCube";


			    $.ajax({
			           type: "POST",
			           url: url,
			           data: $("#form-global").serialize(), // Adjuntar los campos del formulario enviado.
			           success: function(data)
			           {
			           		console.log(data);
			              //$("#respuesta").html(data); // Mostrar la respuestas del script PHP.
			           }
			         });

			    return false; // Evitar ejecutar el submit del formulario.
			 });
			});


 		function optenerValY() {
 			return $("#y-central").sortable("toArray");
 		}

 		function optenerValX() {
 			return $("#x-dimension").sortable("toArray");
 		}

 	</script>
@endsection


  