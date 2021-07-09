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
    public function index()
    {
      return view('layouts.home');
    }

    public function list()
    {

      $ticket_info = [];

      if (request()->status) {
          $statuses = Status::all();
          $tickets = Ticket::where('status_id', request()->status)->get();
          //  search applicant
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
      } else {
          $statuses = Status::all();
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
      }

      return view('tickets.index', compact('ticket_info', 'statuses'));

    }


}
