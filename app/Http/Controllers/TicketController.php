<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {        
        $tickets = Ticket::with('proparty')->where('owner', auth()->id())->get();


        return view('tickets.index', compact('tickets'));
    // }
    //     return view('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()//: Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $ticket = new Ticket();
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket->owner = auth()->id();

        $ticket->save();

        return redirect()->route('tickets.index');
    }

    public function assign(Ticket $ticket, Request $request)
    {
        $this->authorize('assign', $ticket);

        $user = User::find($request->input('user_id'));

        $ticket->assigned = $user;

        return redirect()->back()->with('success', 'Ticket attribué avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)//: Response
    {
        $supports = User::where('role', 'support')->get();


        return view('tickets.show', compact('ticket', 'supports'));
    }

    public function list()
    {

        $tickets = Ticket::get();

        // dd($tickets);
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)//: Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)//: RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)//: RedirectResponse
    {
        //
    }
}
