<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\CubeRepository;
use App\Repositories\ConnectionRepository;
use App\Repositories\TableRepository;
use App\Validator\ConnectionValidator;
use App\Validator\CubeValidator;
use App\Validator\TableValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class processCompleteController extends Controller
{
    private $connectionRepository;

    private $cubeRepository;

    private $tableRepository;

    private $connectionValidator;

    private $cubeValidator;

    private $tableValidator;

    public function __construct(
    	CubeRepository $cubeRepository,
        ConnectionRepository $connectionRepository,
        TableRepository $tableRepository,
        ConnectionValidator $connectionValidator,
        TableValidator $tableValidator,
        CubeValidator $cubeValidator
        ){
        $this->tableRepository=$tableRepository;
        $this->cubeRepository = $cubeRepository;
        $this->connectionRepository = $connectionRepository;
        $this->cubeValidator = $cubeValidator;
        $this->connectionValidator = $connectionValidator;
        $this->tableValidator = $tableValidator;
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
                        		->create($request->all());

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
                        ->selectColumTables($newTables,$connection);
        
        dd($tablesFields);
    }



}
