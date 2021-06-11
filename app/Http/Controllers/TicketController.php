<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//  models
use App\Ticket;
use App\User;
use App\Priority;
use App\Category;
use App\Mail\NewTicketAssigned;
use App\Projects;
use App\User_Ticket;
use App\ProjectFiles;
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

        return view('tickets.ticket')->with([
            'ticket' => $ticket,
            'user_tickets' => $usersList,
            ]);
    }

    //  
    public function new(){
        
        $priority = Priority::all();
        $category = Category::all();
        $projects = Projects::all();
        $users = User::select('id', 'name')->get();
        
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
                'hour_expired' => 'required'
            ]);

            //  create ticket
            $ticket = Ticket::create([
                'titulo' => $request->titulo,
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
            
            return redirect()->route('home')->withFlash('Tu ticket ha sido enviado');

        }catch(ValidationException $e){
            return redirect()->route('new-ticket')->withErrors('Faltan datos');
        }
    }

    public function list(){
        $keys = [];
        $usertickets = User_Ticket::where('user_id', Auth::user()->id)->get();
        foreach($usertickets as $item){
            array_push($keys, $item->ticket_id);
        }
        $tickets = Ticket::find($keys);

        return view('tickets.solicitados', compact('tickets'));
    }

    //  modifica el ticket seleccionado
    public function update(){

    }

    public function delete(Ticket $ticket){
        
        $toDelete = User_Ticket::where('ticket_id', $ticket->id)->where('user_id', Auth::user()->id)->delete();
        return back()->withFlash('Ticket eliminado');
    }

    //  carga un archivo
    public function uploadFile(Request $request){
        //  dd($request);

        try{
            //  es necesario que se seleccione el archivo, sino habra un error
            $request->validate([
                'id_ticket' => ['required'],
                'id_usuario' => ['required'],
                'archivo_cargar' => ['required']
            ]);

            //  mueve el archvo a storage
            $file = $request->file('archivo_cargar');   //  archivo recibido
            $name = $file->getClientOriginalName(); //  este es el nombre original, se puede cambiar por el que sea
            //$extension = $file->getClientOriginalExtension(); //  extension del archivo en el caso de que cambie el nombre

            //$fileName = $name.'.'.$extension; //  este seria el nombre modificado

            //  la variable path es la direccion de donde se guarda el archivo, hay que guardarla en la bd
            $path = Storage::putFileAs(
                'public/files', //  direccion en donde se guardan los archivos, en storage/public/files
                $file,  //  el archivo que se va a guardar
                $name   //  nombre con el que se va a guardar el archivo
            );
            //  dd($path);
            return redirect()->route('home')->withFlash('Archivo guardado!');

        }catch(ValidationException $e){
            //  aqui va el error a mostrar
            //  dd($e);
            return redirect()->route('home')->withFlash('Es necesario añadir un archivo');
        }
    }
}
