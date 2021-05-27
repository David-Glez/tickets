<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ticket;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    //  crea un ticket 
    public function create(Request $request){
        $this->validate($request, [
            'titulo' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'description' => 'required',
        ]);
  
        $ticket = new Ticket;
        $ticket->titulo = $request->get('titulo');
        $ticket->user_id = auth()->id();
        $ticket->status_id = "1";
        $ticket->priority_id = $request->get('priority');
        $ticket->category_id = $request->get('category');
        $ticket->description = $request->get('description');
        $ticket->save();
  
        //  TODO: send email when ticket is created
  
        return redirect()->route('home')->withFlash('Tu ticket ha sido enviado');
    }

    //  modifica el ticket seleccionado
    public function update(){

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
