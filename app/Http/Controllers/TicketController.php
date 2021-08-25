<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//  models
use App\Ticket;
use App\User;
use App\Priority;
use App\Category;
use App\Commits;
use App\Departments;
use App\Mail\NewTicketAssigned;
use App\Projects;
use App\User_Ticket;
use App\ProjectFiles;
use App\Status;
use App\activity_log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    public function show($id){
        $ticket = Ticket::find($id);
        $users = User_Ticket::where('ticket_id', $ticket->id)->get();
        $usersList = [];
        foreach($users as $user){
            
            $data = array(
                'id' => $user->id,
                'name' => $user->user->name
            );
            $usersList[] = $data;
        }

        $commits = Commits::where('ticket_id', $ticket->id)->orderByDesc('created_at')->get();
        
        $commit_details = [];

        foreach($commits as $commit){
            $user = User::find($commit->user_id);
            
            $data = array(
                'id' => $commit->id,
                'user' => $user->user_data->names.' '.$user->user_data->last_name,
                'commit' => $commit->commit,
                'date' => $commit->created_at
            );

            $commit_details[] = $data;
        }

        return view('tickets.show_ticket')->with([
            'ticket' => $ticket,
            'user_tickets' => $usersList,
            'commits' => $commit_details
            ]);
    }

    //  para ver y comentar el ticket
    public function details($id){
        $ticket = Ticket::find($id);
        $users = User_Ticket::where('ticket_id', $ticket->id)->get();
        $status = Status::all();
        $usersList = [];
        foreach($users as $user){
            
            $data = array(
                'id' => $user->id,
                'name' => $user->user->name
            );
            $usersList[] = $data;
        }

        $commits = Commits::where('ticket_id', $ticket->id)->orderByDesc('created_at')->get();
        
        $commit_details = [];

        foreach($commits as $commit){
            $user = User::find($commit->user_id);
            
            $data = array(
                'id' => $commit->id,
                'user' => $user->user_data->names.' '.$user->user_data->last_name,
                'commit' => $commit->commit,
                'date' => $commit->created_at
            );

            $commit_details[] = $data;
        }
        // }else{
        //     $data = array(
        //         'id' => 0,
        //         'user' => '0',
        //         'commit' => 'No hay comentarios',
        //         'date' => Now()
        //     );
        //     $commit_details[] = $data;
        // }

        return view('tickets.ticket')->with([
            'ticket' => $ticket,
            'user_tickets' => $usersList,
            'commits' => $commit_details,
            'status' => $status
            ]);
    }

    //  
    public function new(){
        
        $priority = Priority::all();
        $category = Category::all();
        $projects = Projects::all();
        if(Auth::user()->hasRole('root')){
            $users = User::select('id', 'name')->get();
        }else{
            $users = User::select('id', 'name')->where('project', Auth::user()->project)->get();
        }
        
        return view('tickets.new', compact('priority','category', 'users', 'projects'));
    }

    //  toma un ticket
    public function take(Ticket $ticket){
        
        if($ticket->status_id == 1){
            $ticket->status_id = 2;
            $ticket->save();
        }

        //  busca si el ticket ya es del usuario
        $userTicket = User_Ticket::where('user_id', Auth::user()->id)->where('ticket_id', $ticket->id)->count();
        
        if($userTicket == 0){
            User_Ticket::create([
                'user_id' => Auth::user()->id,
                'ticket_id' => $ticket->id
            ]);

            //  activity log
            activity_log::create([
                'user' => Auth::user()->id, 
                'action' => 4, 
                'section' => "Tickets", 
                'row_affected' => $ticket->id, 
                'description' => "Ticket con ID ".$ticket->id." tomado por ".Auth::user()->user_data->names." ".Auth::user()->user_data->last_name, 
                'date' => Now()
            ]);
            return redirect()->route('index-ticket')->withFlash('Ticket tomado...');
        }else{
            return redirect()->route('index-ticket')->withErrors('Ya has tomado este ticket...');
        }
    }

    //  crea un ticket 
    public function create(Request $request){

        
        try{
            $this->validate($request, [
                'titulo' => 'required',
                //  'category' => 'required', //    TODO: remove from database
                'project' => 'required',
                'date_expired' => 'required',
                'priority' => 'required',
                'description' => 'required',
                'usuarios' => 'required',
                'date_expired' => 'required',
            ]);

            //  create ticket
            $ticket = Ticket::create([
                'titulo' => $request->titulo,
                'solicitante' => Auth::user()->id,
                'status_id' => '1',
                'priority_id' => $request->priority,
                'project_id' => $request->project,
                'description' => $request->description,
                'due_date' => $request->date_expired,
                'due_hour' => $request->hour_expired
            ]);

            //  assign ticket for each user selected
            $listUsers = explode(',', $request->usuarios);
            
            foreach($listUsers as $usuario){
                User_Ticket::create([
                    'user_id' => $usuario,
                    'ticket_id' => $ticket->id
                ]);
            }
            
            //  en el caso de que haya un archivo 
            if($request->hasFile('evidencia')){
                $file = $request->file('evidencia');   //  archivo recibido
                $name = $file->getClientOriginalName(); //  este es el nombre original, se puede cambiar por el que sea
                //$extension = $file->getClientOriginalExtension(); //  extension del archivo en el caso de que cambie el nombre

                //$fileName = $name.'.'.$extension; //  este seria el nombre modificado

                //  la variable path es la direccion de donde se guarda el archivo, hay que guardarla en la bd
                $path = Storage::putFileAs(
                    'public/files', //  direccion en donde se guardan los archivos, en storage/public/files
                    $file,  //  el archivo que se va a guardar
                    $name   //  nombre con el que se va a guardar el archivo
                );

                ProjectFiles::create([
                    'id_ticket' => $ticket->id,
                    'path' => $path
                ]);
            }

            $details = [
                'title' => 'Asignación de nuevo ticket',
                'body' => 'Ha sido asignado al ticket '.$ticket->titulo.'. Verifique esta asignacion en la pagina principal ',
                'expired' => 'La actividad vence el '.$ticket->due_date.' a las '.$ticket->due_hour
            ];

            $employeesAssigned = User::find($listUsers);
            
            foreach($employeesAssigned as $employee){

                Mail::to($employee->email)->send(new NewTicketAssigned($details));
            }
            
            //  activity log
            activity_log::create([
                'user' => Auth::user()->id, 
                'action' => 1, 
                'section' => "Tickets", 
                'row_affected' => $ticket->id, 
                'description' => "Ticket creado por ".Auth::user()->user_data->names." ".Auth::user()->user_data->last_name , 
                'date' => Now()
            ]);
            return redirect()->route('home')->withFlash('Tu ticket ha sido enviado');

        }catch(ValidationException $e){
            return redirect()->route('new-ticket')->withErrors('Faltan datos');
        }
    }

    public function list(){
        $keys = [];
        $data_list = [];
        $usertickets = User_Ticket::where('user_id', Auth::user()->id)->get();
        foreach($usertickets as $item){
            array_push($keys, $item->ticket_id);
        }
        $tickets = Ticket::find($keys);

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

            $data_list[] = $data;
        }

        return view('tickets.solicitados', compact('data_list'));
    }

    //  modifica el ticket seleccionado
    public function update(){

    }

    //  delete ticket from user
    public function reject_ticket($ticket){
        
        //  delete data from userstickets table
        User_Ticket::where('ticket_id', $ticket)->where('user_id', Auth::user()->id)->delete();

        $contador = User_Ticket::where('ticket_id', $ticket)->count();
        
        if($contador = 0){
            $change = Ticket::find($ticket);
            $change->status_id = 1;
            $change->save();
        }
        
        //  activity log
        activity_log::create([
            'user' => Auth::user()->id, 
            'action' => 7, 
            'section' => "Ticket", 
            'row_affected' => $ticket, 
            'description' => "Ticket rechazado por ".Auth::user()->user_data->names." ".Auth::user()->user_data->last_name , 
            'date' => Now()
          ]);
        return back()->withFlash('Ticket Rechazado');
    }

    //  delete ticket from system
    public function remove($ticket){
        User_Ticket::where('ticket_id', $ticket)->delete();
        Ticket::find($ticket)->delete();

        //  activity log
        activity_log::create([
            'user' => Auth::user()->id, 
            'action' => 3, 
            'section' => "Tickets", 
            'row_affected' => $ticket, 
            'description' => "Ticket eliminado por ".Auth::user()->user_data->names." ".Auth::user()->user_data->last_name , 
            'date' => Now()
          ]);
        return redirect()->route('home')->withFlash('Ticket Eliminado');

    }

    //  comentar un ticket
    public function commit(Request $request){
        
        try{

            $request->validate([
                'id_ticket' => ['required'],
                'commit_user' => ['required'],
                'status_ticket' => ['required']
            ]);

            //  create ticket commit

            Commits::create([
                'user_id' =>  Auth::user()->id,
                'ticket_id' => $request->id_ticket,
                'commit' => $request->commit_user
            ]);

            if($request->hasFile('evidencia')){
                $file = $request->file('evidencia');   //  archivo recibido
                $name = $file->getClientOriginalName(); //  este es el nombre original, se puede cambiar por el que sea
                //$extension = $file->getClientOriginalExtension(); //  extension del archivo en el caso de que cambie el nombre

                //$fileName = $name.'.'.$extension; //  este seria el nombre modificado

                //  la variable path es la direccion de donde se guarda el archivo, hay que guardarla en la bd
                $path = Storage::putFileAs(
                    'public/files', //  direccion en donde se guardan los archivos, en storage/public/files
                    $file,  //  el archivo que se va a guardar
                    $name   //  nombre con el que se va a guardar el archivo
                );

                ProjectFiles::create([
                    'id_ticket' => $request->id_ticket,
                    'path' => $path
                ]);
            }

            $ticket = Ticket::find($request->id_ticket);

            if($ticket->status_id != $request->status_ticket){
                $beforeTicket = $ticket->status->name;
                
                $ticket->status_id = $request->status_ticket;
                $ticket->save();
               //  activity log
                activity_log::create([
                    'user' => Auth::user()->id, 
                    'action' => 6, 
                    'section' => "Tickets", 
                    'row_affected' => $ticket->id, 
                    'description' => Auth::user()->user_data->names." ".Auth::user()->user_data->last_name." cambio el estatus del ticket de ".$beforeTicket." a ".$ticket->status->name, 
                    'date' => Now()
                ]); 
            }

            $username = Auth::user()->user_data->names.' '.Auth::user()->user_data->last_name;

            //  send email to users
            $details = [
                'title' => 'Se ha comentado un ticket',
                'body' => 'El ticket '.$ticket->titulo.'. ha sido comentado por '.$username.'. Revise el ticket por favor.',
                'expired' => 'Recuerde que la actividad vence el '.$ticket->due_date.' a las '.$ticket->due_hour
            ];

            $users = [];
            $usersAssigned = User_Ticket::where('ticket_id', $request->id_ticket)->get();
            foreach($usersAssigned as $user){
                array_push($users, $user->id);
            }
            $employeesAssigned = User::find($users);
            
            foreach($employeesAssigned as $employee){

                Mail::to($employee->email)->send(new NewTicketAssigned($details));
            }

            //  activity log
            activity_log::create([
                'user' => Auth::user()->id, 
                'action' => 5, 
                'section' => "Tickets", 
                'row_affected' => $request->id_ticket, 
                'description' => "Ticket comentado por ".Auth::user()->user_data->names." ".Auth::user()->user_data->last_name , 
                'date' => Now()
            ]);
            return redirect()->route('home')->withFlash('Ticket Comentado.');

        }catch(ValidationException $e){
            return redirect()->route('home')->withFlash('Faltan datos para el comentario.');
        }
    }

}
