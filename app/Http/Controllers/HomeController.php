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


}
