<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Http\Resources\ConversationResource;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {
       $conversations = Conversation::all();
       /* $conversations = DB::table('conversations')->where('user_id',Auth::user()->id)
            ->orWhere('second_user_id',Auth::user()->id)
            ->orderBy('updated_at','desc')
            ->get();
        $count = count($conversations);

        for ($i = 0; $i < $count; $i++){
            for ($j = $i+1; $j < $count; $j++){
                if ($conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id){
                    $temp = $conversations[$i];
                    $conversations[$i] = $conversations[$j];
                    $conversations[$j] = $temp;
                }
            }
        }*/

        return ConversationResource::collection($conversations);
        //return ConversationResource($conversations);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function readConversation(Request $request)
    {
       $request->validate([
           'conversation_id'=>'required',

       ]);

       $conversation = Conversation::findOrFail($request['conversation_id']);

        foreach ( $conversation->messages as $message) {
            $message->update(['read'=>true]);
       }
        return response()->json('success',200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ConversationResource
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id'=>'required',
            'message'=>'required'
        ]);
        $conversation = Conversation::create([
            'user_id'=>Auth::user()->id,
            'second_user_id'=>$request['user_id'],

        ]);
        Message::create([
            'body'=>$request['message'],
            'user_id'=>Auth::user()->id,
            'conversation_id'=>$conversation->id,
            'read'=>false,

        ]);

        return new ConversationResource($conversation);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
