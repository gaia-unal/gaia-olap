<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\CubeRepository;
use App\Repositories\ConnectionRepository;
use App\Validator\ConnectionValidator;
use App\Validator\CubeValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class processCompleteController extends Controller
{
    private $connectionRepository;

    private $cubeRepository;

    private $connectionValidator;

    private $cubeValidator;

    public function __construct(
    	CubeRepository $cubeRepository,
        ConnectionRepository $connectionRepository,
        ConnectionValidator $connectionValidator,
        CubeValidator $cubeValidator
        ){
        $this->cubeRepository = $cubeRepository;
        $this->connectionRepository = $connectionRepository;
        $this->cubeValidator = $cubeValidator;
        $this->connectionValidator = $connectionValidator;
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
        $connections = $this->connectionRepository
        					->findWhere([
        						'userId' => currentUser()->id, 
        						'id' => $request->connectionId
        						]);

        $connection = $this	->connectionRepository
        					->deletlevel($connections);

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

            $tables = $this	->connectionRepository
            				->SelectTables($cube->connectionId);

            $message= ([
                'message'=>'Cubo Creado',
            ]);

            return view('Creator.processComplete.cubeTable')->with('tables', $tables);

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

    public function cubeTable(Request $request)
    {
    	dd($request->all());
    }
}
