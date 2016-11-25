<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\CubeRepository;
use App\Repositories\ConnectionRepository;
use App\Repositories\TableRepository;
use App\Repositories\FieldRepository;
use App\Repositories\RelationRepository;
use App\Validator\ConnectionValidator;
use App\Validator\CubeValidator;
use App\Validator\TableValidator;
use App\Validator\FieldValidator;
use App\Validator\RelationValidator;
use Prettus\Validator\Exceptions\ValidatorException;


class processCompleteController extends Controller
{
    private $connectionRepository;

    private $cubeRepository;

    private $tableRepository;

    private $fieldRepository;

    private $relationRepository;

    private $connectionValidator;

    private $cubeValidator;

    private $tableValidator;

    private $fieldValidator;

    private $relationValidator;

    public function __construct(
    	CubeRepository $cubeRepository,
        ConnectionRepository $connectionRepository,
        TableRepository $tableRepository,
        FieldRepository $fieldRepository,
        RelationRepository $relationRepository,
        ConnectionValidator $connectionValidator,
        TableValidator $tableValidator,
        FieldValidator $fieldValidator,
        RelationValidator $relationValidator,
        CubeValidator $cubeValidator
        ){
        $this->tableRepository=$tableRepository;
        $this->cubeRepository = $cubeRepository;
        $this->connectionRepository = $connectionRepository;
        $this->fieldRepository = $fieldRepository;
        $this->relationRepository = $relationRepository;
        $this->cubeValidator = $cubeValidator;
        $this->connectionValidator = $connectionValidator;
        $this->tableValidator = $tableValidator;
        $this->fieldValidator = $fieldValidator;
        $this->relationValidator = $relationValidator;
    }
    
    protected function saveTable($table)
    {
        $table=$this->tableRepository
                    ->create($table);

        return $table;

    }

    private function runTables($data, $table)
    {
        $newTables[] = null;
        $cant = 0;

        foreach ($data['destino'] as $key => $value) {
            
            $table->name = $value;
            if ($data['fact'][0] == $value) {
                $table->principal = true;
            }else{
                $table->principal = false;
            }
            $newTables[$cant] = $this->saveTable($table->toArray());
            $cant++;
        }

        return $newTables;
    }

    private function getCubeTable($data)
    {
        $connections = $this->cubeRepository
                            ->findWhere([
                                'id' => $data
                                ]);

        return $connection = $this ->cubeRepository
                            ->deletlevel($connections);
    }

    private function getConnectionCube($data)
    {
        $connections = $this->connectionRepository
                            ->findWhere([
                                'userId' => currentUser()->id, 
                                'id' => $data
                                ]);

        return $connection = $this ->connectionRepository
                            ->deletlevel($connections);
    }


    public function index()
    {
        $connections = $this->connectionRepository
        					->findWhere(['userId' => currentUser()->id])
        					->lists('name', 'id');
        
        return view('Creator.processComplete.index')->with('connections',$connections);
    }


    public function selectedConnection(Request $request)
    {
        $connection = $this->getConnectionCube($request->connectionId);

        return view('Creator.processComplete.createdCube')->with('connection',$connection);
    }

    public function createdConnection()
    {
    	return view('Creator.processComplete.createdConnection');
    }

    public function storeCube(Request $request)
    {
        try{

            $this->cubeValidator
                    ->with($request->all())
                    ->passesOrFail();

            $cube= $this  	->cubeRepository
                        	->create($request->all());
            
            $message= ([
                'message'=>'Cubo Creado',
            ]);

            return redirect() ->route('Creator.processComplete.cubeTable',['cubeId' => $cube->id]);


        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>true,
                'message' =>$e->getMessage()
            ]);

            return redirect()   ->back()
                                ->with('message',$message);
        }

    }

    public function storeConnection(Request $request)
    {
        try{

            $this->connectionValidator
                    ->with($request->all())
                    ->passesOrFail();

            $connection= $this	->connectionRepository
                        		->saveConnection($request->all());

            $message= ([
                'message'=>'Conexion Creada',
            ]);

            return view('Creator.processComplete.createdCube')
                                ->with('message', $message)
                                ->with('connection', $connection);

        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>true,
                'message' =>$e->getMessage()
            ]);

            return redirect()   ->back()
                                ->with('message',$message);
        }

    }

    public function cubeTable($cubeId)
    {
    	$cube =$this->cubeRepository
    				->find($cubeId); 

    	$tables = $this	->connectionRepository
            			->SelectTables($cube->connectionId);

        return view('Creator.processComplete.cubeTable')->with('tables', $tables)
                                                        ->with('cubeId', $cube->id);
    }

    public function proccessTables(Request $request)
    {
        
        $data = $request->all();

        $table = $this  ->tableRepository
                        ->createObject($data);

        $newTables=$this->runTables($data,$table);
        $cube = $this->getCubeTable($table->cubeId);
        $connection = $this->getConnectionCube($cube->connectionId);

        $tablesFields =  $this->tableRepository
                        ->selectColumTables(
                                $data['fact'][0],
                                $newTables,
                                $connection
                        );

        $cubeId = $this->storeFieldsTable($tablesFields);


        //return redirect() ->route('Creator.processComplete.validateField',['cubeId' => $cube->id]);
        return redirect() ->route('Creator.Dashboard.index',['cubeId' => $cube->id]);
                
    }


    private function storeFieldsTable($tablesFields)
    {
        $principal = false;

        foreach ($tablesFields as $key => $tableFields) {

            $fieldsAll=$this->createArray($tableFields->fields);

            if ($tableFields->principal) {
                $principal = $tableFields;

            }
        }
        if ($principal) {
            $foreignKey = $this->storeForeign($principal);
        }
        return $principal->cubeId;
    }

    private function createArray($fields)
    {
        $fieldsNew[] = null;
        $pos = 0;
        
        foreach ($fields as $key => $field) {
            $fieldsNew[$pos] = $this->fieldRepository->create(get_object_vars($field));
            $pos++;
        }

        return $fieldsNew;
    }

    private function storeForeign($table)
    {    
        //dd($table);
            if ($table->foreignKeys) {
                foreach ($table->foreignKeys as $key => $value) {
                    
                    $value->idLocalTable = $table->id;
                    $value->idLocalFiel = $this   ->fieldRepository
                                                    ->selectField(
                                                        $value->column_name,
                                                        $value->idLocalTable
                                                        );
                    $value->idReferenceTable = $this ->tableRepository
                                                    ->selectTable(
                                                            $value->table_name_reference,
                                                            $table->cubeId
                                                        );
                    $value->idReferenceFiel=$this   ->fieldRepository
                                                    ->selectField(
                                                        $value->column_name_reference,
                                                        $value->idReferenceTable
                                                        );
                    $value->nameRelationship = $value->constraint_name;
                    $value->nameLocalTable = $value->table_name;
                    $value->nameLocalField = $value->column_name;
                    $value->nameReferenceTable = $value->table_name_reference;
                    $value->nameReferenceField = $value->column_name_reference;
                    
                    $newValue = $this->relationRepository->create(get_object_vars($value));
                }

                return true;

            }else{
                return false;
            }

    }

    public function validateField($cubeId)
    {
        dd($cubeId);
    }



}
