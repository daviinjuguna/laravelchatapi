<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use App\Message;
use Illuminate\Http\Request;

class  MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        //
        $messages = new Message();
        $messages->body = $request['body'];
        $messages->read = 0;
        $messages->user_id = auth()->user()->id;
        $messages->conversation_id = $request['conversation_id'];

        $messages->save();
        new MessageResource($messages);
        return response()->json(
            $messages
        );

//        $conversations = Conversation::where('user_id',auth()->user()->id)
//            ->orWhere('second_user_id',auth()->user()->id)
//            ->orderBy('updated_at', 'desc')
//            ->get();
//        $count = count($conversations);
//
//        for ($i = 0; $i < $count; $i++){
//            for ($j = $i+1; $j < $count; $j++){
//                if ($conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id){
//                    $temp = $conversations[$i];
//                    $conversations[$i] = $conversations[$j];
//                    $conversations[$j] = $temp;
//                }
//            }
//        }
//        return ConversationResource::collection($conversations)->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
