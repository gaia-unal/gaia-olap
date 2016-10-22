<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Repositories\CubeRepository;
use App\Repositories\TableRepository;
use App\Repositories\FieldRepository;
use App\Repositories\RelationRepository;
use App\Entities\Field;


class DashboardController extends Controller
{
	private $cubeRepository;
	private $tableRepository;
	private $fieldRepository;
	private $relationRepository;

	public function __construct(
		CubeRepository $cubeRepository,
		TableRepository $tableRepository,
		FieldRepository $fieldRepository,
		RelationRepository $relationRepository
		)
	{
		$this->cubeRepository = $cubeRepository;
		$this->tableRepository = $tableRepository;
		$this->fieldRepository = $fieldRepository;
		$this->relationRepository = $relationRepository;
	}
    public function index($cubeId)
    {
    	$cube = $this->cubeRepository->with(['tables'])->find($cubeId);
    	$tableCentral = $this->tableRepository->getTableCentral($cubeId);
    	$fieldsCentral = $this->fieldRepository->getFieldsTable($tableCentral->id);
    	$fieldsForeign = $this->relationRepository->getForeignKey($tableCentral->id);


    	$fieldsNoForeign = array_diff_key($fieldsCentral->toArray(), $fieldsForeign->toArray());

    	//dd($fieldsNoForeign);
    	return view('Creator.dashboard.index')	->with('fieldsNoForeign',$fieldsNoForeign)
    											->with('fieldsForeign',$fieldsForeign);
    }

    public function getDimensionFields($id)
    {
    	//$val = $request->all();
    	//$id = $val['id'];
    	$table = $this->relationRepository->getTableField($id)->idReferenceTable;
    	$values = $this->fieldRepository->getFieldsTable($table)->toArray();

    	return Response()->json($values,200);
    }
}
