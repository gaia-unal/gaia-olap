<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use App\Validator\UserValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{

    private $userRepository;

    protected $validator;

    public function __construct(
            UserRepository $userRepository, 
            UserValidator $validator
        ){
        
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    { 
        $users= $this->userRepository
                        ->paginate($limit = 10);
       
        return view('Admin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.user.create');
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

            $user= $this->userRepository
                        ->saveUser($request->all());

            $message= ([
                'message'=>'Usuario Creado',
                'data'   =>$user
            ]);

            return redirect()->route('Admin.user.index')->with('message',$message);

        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>true,
                'message' =>$e->getMessage()
            ]);

            return redirect()->back()->with('message',$message);
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
        $user= $this->userRepository
                    ->find($id);

        return view('Admin.user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= $this->userRepository
                    ->find($id);
        
        return view('Admin.user.edit')->with('user', $user);

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

            $user= $this->userRepository
                        ->update(
                            $request->all(),
                            $id
                        );

            $message= ([
                'message'=>'Usuario Editado',
                'data'   =>$user->toArray()
            ]);

            return redirect()->route('Admin.user.index')->with('message',$message);

        }catch (ValidatorException $e){
            
            $message= ([
                'error'   =>true,
                'message' =>$e->getMessage()
            ]);

            return redirect()->back()->with('message',$message);
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
        $user= $this->userRepository
                    ->delete($id);

        return redirect()->route('Admin.user.index');
    }
}
