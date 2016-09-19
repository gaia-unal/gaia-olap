<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CubeRepository;
use App\Repositories\ConnectionRepository;
use App\Validator\CubeValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class CubeController extends Controller
{

    private $cubeRepository;

    private $connectionRepository;

    private $validator;

    public function __construct(
        CubeRepository $cubeRepository,
        ConnectionRepository $connectionRepository,
        CubeValidator $validator
        ){
        
        $this->cubeRepository = $cubeRepository;
        $this->connectionRepository = $connectionRepository;
        $this->validator = $validator;
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cubes = $this  ->cubeRepository
                        ->paginate($limit = 10);
        
        return view('Creator.cube.index')->with('cubes',$cubes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $connections = $this    ->connectionRepository
                                ->orderBy('name','ASC')
                                ->lists('name', 'id');

        return view('Creator.cube.create')->with('connections',$connections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $this->validator
                    ->with($request->all())
                    ->passesOrFail();

            $cube= $this  ->cubeRepository
                                ->create($request->all());

            $message= ([
                'message'=>'Conexion Creada',
                'data'   =>$cube
            ]);

            return redirect()   ->route('Creator.cube.index')
                                ->with('message',$message);

        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>true,
                'message' =>$e->getMessage()
            ]);

            return redirect()   ->back()
                                ->with('message',$message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cube= $this->cubeRepository
                    ->find($id);

        return view('Creator.cube.show')->with('cube',$cube);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $connections=   $this   ->connectionRepository
                                ->orderBy('name','ASC')
                                ->lists('name', 'id');

        $cube=$this  ->cubeRepository
                    ->find($id);

        return view('Creator.cube.edit')->with('cube', $cube)
                                        ->with('connections', $connections);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $this->validator
                    ->with($request->all())
                    ->passesOrFail();

            $cube= $this  ->cubeRepository
                                ->update(
                                    $request->all(),
                                    $id
                                );

            $message= ([
                'message'=> 'Conexion Editada',
                'data'   => $cube->toArray()
            ]);

            return redirect()   ->route('Creator.cube.index')
                                ->with('message',$message);

        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>    true,
                'message' =>    $e->getMessage()
            ]);

            return redirect()   ->back()
                                ->with('message',$message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cube= $this  ->cubeRepository
                            ->delete($id);

        return redirect()->route('Creator.cube.index');
    }
}
