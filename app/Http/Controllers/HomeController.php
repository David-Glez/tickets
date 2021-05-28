<?php

namespace App\Http\Controllers;

use App\Status;
use App\Ticket;
use App\Priority;
use App\Category;
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

      if (request()->status) {
          $statuses = Status::all();
          $tickets = Ticket::where('status_id', request()->status)->get();
      } else {
          $statuses = Status::all();
          $tickets = Ticket::where('status_id', '1')->get();
      }

      return view('tickets.index', compact('tickets', 'statuses'));

    }

    public function my_list()
    {

      $tickets = Ticket::where('user_id', auth()->id())->get();
      return view('tickets.solicitados', compact('tickets'));

    }


    public function show($id)
    {

      $ticket = Ticket::where('id', $id)->firstOrFail();

      $user_tickets = User_Ticket::where('ticket_id', $id)->get();

      return view('tickets.ticket')->with([
      'ticket' => $ticket,
      'user_tickets' => $user_tickets,
      ]);

    }

    public function take(Ticket $ticket)
    {
      if($ticket->status_id = '1')
      {
        $ticket->status_id = "2";
        $ticket->save();
      }

      $user__ticket = User_Ticket::where('user_id', '=', auth()->id())->where('ticket_id', '=', $ticket->id)->first();

      if($user__ticket == null)
      {
        $user_ticket = new User_Ticket;
        $user_ticket->user_id = auth()->id();
        $user_ticket->ticket_id = $ticket->id;
        $user_ticket->save();

        return redirect()->route('index-ticket')->withFlash('Ticket tomado...');
      } else
      {
        return redirect()->route('index-ticket')->withFlash('Ya has tomado este ticket...');
      }

    }

    public function new()
    {
      $priority = Priority::all();
      $category= Category::all();
      return view('tickets.new', compact('priority','category'));
    }

    public function create(Request $request)
    {

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

    public function delet(Ticket $ticket)
   {

     $ticket->delete();

     return back()->withFlash('Ticket eliminado');
   }

}
