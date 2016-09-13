<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ConnectionRepository;
use App\Validator\ConnectionValidator;
use Prettus\Validator\Exceptions\ValidatorException;


class ConnectionController extends Controller
{

    private $connectionRepository;

    private $validator;

    public function __construct(
        ConnectionRepository $connectionRepository,
        ConnectionValidator $validator
        ){
        
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
        //$connections = $this->connectionRepository
        //                    ->connection();

        $connections = $this->connectionRepository
                            ->paginate($limit = 10);
        
        return view('Creator.connection.index')->with('connections',$connections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Creator.connection.create');
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

            $connection= $this  ->connectionRepository
                                ->saveConnection($request->all());

            $message= ([
                'message'=>'Conexion Creada',
                'data'   =>$connection
            ]);

            return redirect()   ->route('Creator.connection.index')
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
        $connection= $this  ->connectionRepository
                            ->find($id);

        return view('Creator.connection.show')->with('connection',$connection);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $connection= $this  ->connectionRepository
                            ->find($id);

        return view('Creator.connection.edit')->with('connection', $connection);
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
        $connection= $this->connectionRepository
                    ->updateConnection(
                        $request->all(),
                        $id
                    );

        return redirect()->route('Creator.connection.index');

        try{

            $this->validator
                    ->with($request->all())
                    ->passesOrFail();

            $connection= $this  ->connectionRepository
                                ->update(
                                    $request->all(),
                                    $id
                                );

            $message= ([
                'message'=> 'Conexion Editada',
                'data'   => $connection->toArray()
            ]);

            return redirect()   ->route('Creator.connection.index')
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
        $connection= $this  ->connectionRepository
                            ->delete($id);

        return redirect()->route('Creator.connection.index');

    }
}
