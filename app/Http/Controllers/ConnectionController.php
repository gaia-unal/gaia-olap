<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ConnectionRepository;


class ConnectionController extends Controller
{

    private $connectionRepository;


    public function __construct(ConnectionRepository $connectionRepository)
    {
        $this->connectionRepository = $connectionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $connections = $this->connectionRepository
                            ->paginateConnections(currentUser()->id);
        
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
        $user= $this->connectionRepository
                    ->saveConnection(
                        $this->connectionRepository
                             ->createObject($request->all())
                        );

        return redirect()->route('Creator.connection.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $connection = $this->connectionRepository->consultConnection($id);

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
        $connection= $this->connectionRepository
                    ->consultConnection($id);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $connection= $this->connectionRepository
                    ->delete($id);

        return redirect()->route('Creator.connection.index');

    }
}
