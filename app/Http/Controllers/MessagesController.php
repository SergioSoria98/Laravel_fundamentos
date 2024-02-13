<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\alert;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }




    public function index()
    {
        $messages = Message::with(['user','note'])->get();

        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create($request->all());

        $message->user_id = auth()->id();
        $message->save();
        
/*
        Mail::send('emails.contact', ['msg' => $message], function($m) use ($message){
            $m->to($message->email, $message->nombre)->subject('Tu mensaje fue recibido');
        });
*/
        return redirect()->route('mensajes.create')->with('info', 'Hemos recibido tu mensaje');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::findOrFail($id);

        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::findOrFail($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Message::findOrFail($id)->update($request->all());

        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Message::findOrFail($id)->delete();

        return redirect()->route('mensajes.index');
    }
    
}
