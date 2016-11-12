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

			<div class="grafic col-lg-12" id="grafic" style="height: 400px; min-width: 310px" >
			<br />
				<div class="box box-success">
		            <div class="box-header with-border">
		              <i class="fa fa-bar-chart-o"></i>

		              <h3 class="box-title">Line Chart</h3>

		              <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		              </div>
		            </div>
		            <div class="box-body">
		              <div id="line-chart" style="height: 300px;"></div>
		            </div>
		            <!-- /.box-body-->
		          </div>

			</div>
			<br>
			<br>
		</div>
		<div class="panel panel-default col-lg-2">
			{!! Form::open(['id'=>'form-global']) !!}
			<input type="hidden" name="operation-option" value="">
			<input type="hidden" name="operation-dimension" value="">
			<input type="hidden" name="cubeId" value="{{$cubeId}}">
			<input type="hidden" name="consult" value="">
			<input type="hidden" name="colums" value="">
			<input type="hidden" name="dataEnBruto" value="">

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
			var elementSelect = "<div class='select-option' name='"+id+"'><div class='option-locale'><label for='"+id+"'><h5>"+name+"</h5></label><select class='select' id='"+id+"' name='"+id+"' > <option value='avg'>Promedio</option> <option value='min'>Mínimo</option> <option value='max'>Máximo</option><option value='sum'>Suma</option></select></div></div>";

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
				extractSelect();
			 });
		});
		function optenerValY() {
 			return $("#y-central").sortable("toArray");
 		}

 		function optenerValX() {
 			return $("#x-dimension").sortable("toArray");
 		}

 		function extractSelect() {

			$("input[name='operation-option']").val(optenerValY());
			$("input[name='operation-dimension']").val(optenerValX());
			var url = "/Creator/Dashboard/informationConsultCube";
			var data= $("#form-global").serialize()

			$.post( url, data, function( data ) {
				console.log(data);
				extractSelectData(data);
			});
 		}
 		function extractSelectData(data) {

			$("input[name='consult']").val(data['consult']);
			$("input[name='colums']").val(data['colums']);
			var url = "/Creator/Dashboard/getConsultData";
			var data = $("#form-global").serialize();

			$.post( url, data, function( data ) {
				console.log(data);
				formatData(data);
			});
 		}

 		function formatData(data) {
 			
 			$("input[name='dataEnBruto']").val(data);
			var data = {colums: $("input[name='colums']").val(),data:data};
			var url = "/Creator/Dashboard/formatData";
			$.post( url, data, function( data ) {
				console.log(data);
				formatDimX(data);
			});
 		}

 		function formatDimX(data) {
 			
 			$("input[name='dataEnBruto']").val(data);
			var data = {colums: $("input[name='colums']").val(),data:data};
			var url = "/Creator/Dashboard/formatDimX";
			$.post( url, data, function( data ) {
				console.log(data);
				generateGraficFlot(data['dataX'],data['dataY']);
				//generateGrafic(data);
			});
 		}
</script>

<script>
  function generateGraficFlot(dataX,dataY) {



   /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [], cos = [];
    for (var i = 0; i < 3; i += 0.5) {
      sin.push([i, Math.sin(i)]);
      cos.push([i, Math.cos(i)]);
    }
    $.each(dataY, function(index, val) {
		sin = val;
	});
    var line_data1 = {
      data: sin,
      color: "#3c8dbc"
    };
    var line_data2 = {
      data: cos,
      color: "#00c0ef"
    };

   	console.log(dataY['avgprecipitacion'])
  	console.log( line_data1)
  	console.log( line_data2)

    $.plot("#line-chart", [line_data1, line_data2], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3"
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: false,
        color: ["#3c8dbc", "#f56954"]
      },
      yaxis: {
      	show: true,
      },
      xaxis: {
      	ticks: dataX,
        show: true
      }
    });
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#line-chart").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2);

        $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#line-chart-tooltip").hide();
      }

    });
    /* END LINE CHART */
  };

</script>
@endsection


  