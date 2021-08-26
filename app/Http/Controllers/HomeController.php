<?php

namespace App\Http\Controllers;

use App\Status;
use App\Ticket;
use App\User;
use App\Priority;
use App\Category;
use App\Departments;
use App\User_Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\activity_log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     // show pending tickets in dashboard view
    public function index()
    {
      $ticket_info = [];

      if(Auth::user()->hasRole('root')){
        $tickets = Ticket::all();

        foreach($tickets as $ticket){
          $data = array(
            'id' => $ticket->id,
            'titulo' => $ticket->titulo,
            'status' => $ticket->status->name,
            'id_status' => $ticket->status->id,
            'prioridad' => $ticket->priority->name,
            'id_priority' => $ticket->priority->id,
            'descripcion' => $ticket->description,
            'proyecto' => $ticket->projects->empresa,
            'fecha' => $ticket->due_date.' '.$ticket->due_hour
          );
          $ticket_info[] = $data;
        }
        
      }else{
        $tickets = Ticket::where('project_id', Auth::user()->project)->get();
        foreach($tickets as $ticket){
          $data = array(
            'id' => $ticket->id,
            'titulo' => $ticket->titulo,
            'status' => $ticket->status->name,
            'id_status' => $ticket->status->id,
            'prioridad' => $ticket->priority->name,
            'id_priority' => $ticket->priority->id,
            'descripcion' => $ticket->description,
            'proyecto' => $ticket->projects->empresa,
            'fecha' => $ticket->due_date.' '.$ticket->due_hour
          );
          $ticket_info[] = $data;
        }
      }

      return view('dashboard.dashboard', compact('ticket_info'));
    }

    public function logs(Request $request){
      $list = [];
      $isRoot = Auth::user()->hasRole('root');
      if($isRoot){
        $activity = activity_log::all();
      }else{
        $users = User::where('project', Auth::user()->project)->get();

        foreach($users as $user){
          array_push($list, $user->id);
        }

        $activity = activity_log::whereIn('user', $list)->get();
      }
      
      return view('logs.index', compact('activity'));
    }

    public function list()
    {

      $ticket_info = [];

      if(Auth::user()->hasRole('root')){
        $tickets = Ticket::where('status_id', '1')->get();
        foreach($tickets as $ticket){
          $user = User::find($ticket->solicitante);
          $department = Departments::find($user->user_data->department);
  
          $applicant = $user->user_data->names.' '.$user->user_data->last_name;
          $department_user = $department->name;
  
          $data = array(
            'id' => $ticket->id,
            'solicitante' => $applicant,
            'departamento' => $department_user,
            'proyecto' => $ticket->projects->empresa,
            'status' => $ticket->status->name,
            'titulo' => $ticket->titulo,
            'prioridad' => $ticket->priority->name,
            'status_id' => $ticket->status_id
          );
  
          $ticket_info[] = $data;
        }
      }else{
        $tickets = Ticket::where('status_id', '1')->where('project_id', Auth::user()->project)->get();
        foreach($tickets as $ticket){
          $user = User::find($ticket->solicitante);
          $department = Departments::find($user->user_data->department);

          $applicant = $user->user_data->names.' '.$user->user_data->last_name;
          $department_user = $department->name;

          $data = array(
            'id' => $ticket->id,
            'solicitante' => $applicant,
            'departamento' => $department_user,
            'proyecto' => $ticket->projects->empresa,
            'status' => $ticket->status->name,
            'titulo' => $ticket->titulo,
            'prioridad' => $ticket->priority->name,
            'status_id' => $ticket->status_id
          );

          $ticket_info[] = $data;
        }
      }
      
      

      return view('tickets.index', compact('ticket_info'));

    }


}
