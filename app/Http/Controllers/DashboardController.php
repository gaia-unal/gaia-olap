<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\CubeRepository;
use App\Repositories\TableRepository;
use App\Repositories\FieldRepository;
use App\Repositories\RelationRepository;
use App\Repositories\ConnectionRepository;
use App\Entities\Field;


class DashboardController extends Controller
{
	private $cubeRepository;
	private $tableRepository;
	private $fieldRepository;
	private $relationRepository;
    private $connectionRepository;

	public function __construct(
		CubeRepository $cubeRepository,
		TableRepository $tableRepository,
		FieldRepository $fieldRepository,
		RelationRepository $relationRepository,
        ConnectionRepository $connectionRepository
		)
	{
		$this->cubeRepository = $cubeRepository;
		$this->tableRepository = $tableRepository;
		$this->fieldRepository = $fieldRepository;
		$this->relationRepository = $relationRepository;
        $this->connectionRepository = $connectionRepository;
	}
    public function index($cubeId)
    {
    	$cube = $this->cubeRepository->with(['tables'])->find($cubeId);
    	$tableCentral = $this->tableRepository->getTableCentral($cubeId);
    	$fieldsCentral = $this->fieldRepository->getFieldsTable($tableCentral->id);
    	$fieldsForeign = $this->relationRepository->getForeignKey($tableCentral->id);


    	$fieldsNoForeign = array_diff_key(
    							$fieldsCentral->toArray(), 
    							$fieldsForeign->toArray()
    						);

    	//dd($fieldsNoForeign);
    	return view('Creator.dashboard.index')	->with('fieldsNoForeign',$fieldsNoForeign)
    											->with('fieldsForeign',$fieldsForeign)
    											->with('cubeId',$cubeId);
    }

    public function getDimensionFields($id)
    {
    	//$val = $request->all();
    	//$id = $val['id'];
    	$table = $this->relationRepository->getTableField($id)->idReferenceTable;
    	$values = $this->fieldRepository->getFieldsTable($table)->toArray();

    	return Response()->json($values,200);
    }

    public function informationConsultCube(Request $request)
    {
    	$data = $request->all();
    	// se convierte el array javaScript en array php
    	$operation_option = explode(',', $data['operation-option']);
    	$operation_dimention = explode(',',$data['operation-dimension']);
    	$cube_id = $data['cubeId'];
    	
    	// se eliminan los campos innecesarios de data
    	$data = $this->deleteColumns($data);

    	//se ordenan los elementos 
    	$operation_option= $this->orderElements(
    								$data,
    								$operation_option
    							);

    	$operation_dimention= $this->orderElements(
    									$data,
    									$operation_dimention
    								);
		
		$consulta = $this->createConsult(
								$operation_option,
								$operation_dimention,
								$cube_id
							);
    	

    	return Response()->json($consulta ,200);
    }


    private function createConsult($operation_option,$operation_dimention,$cube_id)
    {
    	$tableCentral = $this->tableRepository->getTableCentral($cube_id);

    	$cadenaSelect = $this->generateSelectPart(
    								$operation_option,
    								$operation_dimention,
    								$tableCentral->name
    							);
    	$cadenaFromWhere = $this->generateFromPart(
    							$operation_option,
    							$operation_dimention,
    							$tableCentral->name
   							);

    	$unirCadena = $this->unirCadena($cadenaSelect,$cadenaFromWhere);
        $resultado = array('colums' => $cadenaSelect['colums'], 'consult' => $unirCadena );

    	return $resultado;
    }

    private function unirCadena($cadenaSelect,$cadenaFromWhere)
    {
    	return $cadenaSelect['select']." ".$cadenaFromWhere." ".$cadenaSelect['groubBy']." ".$cadenaSelect['orderBy']."";// limit 100
    }

    private function generateFromPart($operation_option,$operation_dimention,$tableName)
    {
    	$from = " From ".$tableName.",";
    	$where = " Where";
    	$difDim = $this->nameDimDiff($operation_dimention);

    	foreach ($difDim as $key => $value) {
    		$from .= " ".$value['nameReferenceTable'].",";

    		$where .= 	" ".$value['nameLocalTable'].".".$value['nameLocalField']." = ".
    					$value['nameReferenceTable'].".".$value['nameReferenceField']." and";
    	}

		$from = substr($from, 0, -1);
		$where = substr($where, 0, -3);

    	return $from.$where;
    }

    private function nameDimDiff($operation_dimention)
    {
    	$tem = array();
    	$nameref= array();
    	$bandera = 0;
    	foreach ($operation_dimention as $key => $value) {

    		$fieldRelation = $this->relationRepository->getTableField($key);

    		if (!in_array($fieldRelation->nameReferenceTable, $nameref)) {

    			array_push($nameref,$fieldRelation->nameReferenceTable);
	    		$tem+= array( $bandera => array(
	    					"nameLocalTable" => $fieldRelation->nameLocalTable,
	    					"nameLocalField" => $fieldRelation->nameLocalField,
	    					"nameReferenceTable" => $fieldRelation->nameReferenceTable,
	    					"nameReferenceField" => $fieldRelation->nameReferenceField
	    				));
	    		$bandera++;
    		}    		
    	}


    	return $tem;

    }

    private function generateSelectPart($operation_option,$operation_dimention,$tableName)
    {
    	$select = "SELECT ";
    	$groubBy = " Group by ";
    	$orderBy = " Order by";
        $colums = array();

    	foreach ($operation_dimention as $key => $value) {

    		$fieldRelation = $this->relationRepository->getTableField($key);
    		$field = $this->fieldRepository->find($value);
    		$dim_name = $fieldRelation->nameReferenceTable;
    		$field_name = $field->name;
    		$select .= $dim_name.".".$field_name." As dim".$field_name.", ";
            array_push($colums,'dim'.$field_name);
    		$groubBy .= " ".$dim_name.".".$field_name.",";
    		$orderBy .= " ".$dim_name.".".$field_name.",";
    	}

    	foreach ($operation_option as $key => $value) {

    		$field = $this->fieldRepository->find($key);
    		$fieldName = $field->name;
    		$select .= " ".$value."(".$tableName.".".$fieldName.") as ".$value.$fieldName.",";
            array_push($colums, ''.$value.$fieldName);
    	}

    	$select = substr($select, 0, -1);
    	$groubBy = substr($groubBy, 0, -1);
    	$orderBy = substr($orderBy, 0, -1);



    	return array(	'select' => $select,
    					'groubBy' => $groubBy,
    					'orderBy' => $orderBy,
                        'colums'   => $colums
    				);
    }

    public function deleteColumns($data)
    {
    	unset($data['operation-option']);
    	unset($data['operation-dimension']);
    	unset($data['_token']);
    	unset($data['cubeId']);

    	return $data;
    }




    private function orderElements($data,$operation)
    {
    	$tem = array();
    	for ($i=0; $i < count($operation) ; $i++) { 
    		if (array_key_exists($operation[$i],$data)) {
    			$tem += array($operation[$i] => $data[$operation[$i]]);
    		}
    	}
    	return $tem;
    }

    public function getConsultData(Request $request)
    {
        $data = $request->all();
        $cubeId = $data['cubeId'];
        $consult = $data['consult'];
        $connectionId = $this->cubeRepository->getConnection($cubeId);
        $data = $this->connectionRepository->resultConsult($connectionId,$consult);
        return Response()->json($data ,200);
    }

    private function convertObject($data)
    {
        $dataTem = array();

        for ($i=0; $i < count($data); $i++) { 
            array_push($dataTem,get_object_vars($data[$i])); 
        }
        return $dataTem;
    }

    public function formatData(Request $request)
    {
        $requestAll = $request->all();
        $colums = $requestAll['colums'];
        $dataTem = $requestAll['data'];     
        
        //$dataTem = $this->convertObject($data);
        $colums = explode(',',$colums);


        foreach ($colums as $key => $value) {
            $tem = array_column($dataTem,$value);
            if (substr($value, 0, 3) == 'dim') {
                $matrizX[$value] = $tem;
            }else{
                $matrizY[$value] = $tem;
            }
  
        }
        $matriz['matrizX'] = $matrizX;
        $matriz['matrizY'] = $matrizY;

        return Response()->json($matriz,200);
    }

    public function formatDimX(Request $request)
    {
        $dataAll = $request->all();
        $colums = $dataAll['colums'];
        $dataTem = $dataAll['data'];

        $dataX = $dataTem['matrizX'];
        $dataY = $dataTem['matrizY'];
        $colums = explode(',',$colums);
        $datatem = array();

        /* Hay que colocar undefined los valores null en las dimenciones  ¿ que hacer con los null en operaciones? */
        /* Aqui hay que unir los valores de las dimenciones en cadenas de texto mezcladas.*/

        $cant = count($dataX[$colums[0]]);
        for ($i=0; $i < $cant ; $i++) { 
            $cadenaTem = '';
            foreach ($colums as $key => $value) {
                
                if (substr($value, 0, 3) == 'dim') {

                    if ($dataX[$value][$i] == '') {
                        $cadenaTem .= "  undefined / ";
                    }else{
                        $cadenaTem .= " ".$dataX[$value][$i]." / ";
                    }  
                }
            }
            
            array_push($datatem, array($i , substr($cadenaTem, 0, -2)));
            
        }
        $data['dataY'] = $dataY;
        $data['dataX'] = $datatem;
        return Response()->json($data,200);

    }


}
