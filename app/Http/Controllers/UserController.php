<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Departments;
use App\Employees;
use App\Projects;
use App\User_Ticket;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

  public function new()
  {
    $roles = Role::where('name', '!=', 'root')->get();
    $departments = Departments::all();
    if(Auth::user()->hasRole('root')){
      $bussines = Projects::all();
    }else{
      $bussines = Projects::where('id', Auth::user()->project)->get();
    }
    return view('users.new', compact('roles', 'departments', 'bussines'));
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){


      $credentials = $request->only('email', 'password');

      $validation = Auth::attempt($credentials);

      if($validation){
        return redirect()->route('home');
      }else{
        return redirect()->back()->withErrors([
          'errors' => 'usuario o contraseña incorrectas'
        ]);
      }
    }


    public function logout(Request $request){
      Auth::logout();
      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }


    public function index()
    {
        $users = [];
        //$users = User::all();
      $user_rol = Auth::user()->hasRole('root');

      if($user_rol){
        $users_list = User::where('id', '!=', 1)->get();
        foreach($users_list as $user){

          $department = Departments::find($user->user_data->department);
          $project = Projects::find($user->project);

          $data = array(
            'id' => $user->id,
            'nombre' => $user->user_data->names.' '.$user->user_data->last_names,
            'departamento' => $department->name,
            'proyecto' => $project->empresa,
            'roles' => $user->roles->pluck('name'),
            'email' => $user->email
          );
          array_push($users, $data);
        }

      }else{
        $project_id = Auth::user()->project;

        $users_list = User::where('project', $project_id)->get();
        
        foreach($users_list as $user){

          $department = Departments::find($user->user_data->department);
          $project = Projects::find($user->project);

          $data = array(
            'id' => $user->id,
            'nombre' => $user->user_data->names.' '.$user->user_data->last_names,
            'departamento' => $department->name,
            'proyecto' => $project->empresa,
            'roles' => $user->roles->pluck('name'),
            'email' => $user->email
          );
          array_push($users, $data);
        }
      }

      return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      try{
        $request->validate([
          'names' => ['required', 'string'],
          'last_name' => ['required', 'string'],
          'department' => ['required'],
          'username' => ['required'],
          'role' => ['required'],
          'email' => ['required', 'string', 'email', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          'empresa' => ['required']
        ]);

        //  create new user
        $user = User::create([
          'name' => $request->username,
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'email_verified_at' => Now(),
          'project' => $request->empresa
        ]);

        //  assign role and permissions
        $role = Role::find($request->role);
        $user->assignRole($role->name);

        //  save user data
        Employees::create([
          'user_id' => $user->id,
          'names' => $request->names,
          'last_name' => $request->last_name,
          'department' => $request->department
        ]);

        return redirect()->route('home')->withFlash('Usuario creado');

      }catch(ValidationException $e){
        //dd($e->errors());

        return redirect()->back()->withErrors($e->errors());
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::where('id', $id)->firstOrFail();

      return view('users.user')->with([
      'user' => $user,
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        //  delete user tickets
        User_Ticket::where('user_id', $user)->delete();
        
        //  delete user data
        Employees::where('user_id', $user)->delete();

        //  delete user credentials
        User::find($user)->delete();

        return redirect()->route('home')->withFlash('Usuario Eliminado');
    }
}
