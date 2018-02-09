<?php

namespace EONConsulting\Messages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class MessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = auth()->user()->notifications()->paginate(10);

        $view = view('messages::index', compact('messages'))->render();

        return response()->json(['message' => $view], 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(DatabaseNotification $message)
    {
        $this->authorize('view', $message);

        $message->markAsRead();

        $view = view('messages::show', compact('message'))->render();

        return response()->json(['message' => $view], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatabaseNotification $message)
    {
        $this->authorize('delete', $message);

        if( ! $message->read())
        {
            return response()->json(['message' => 'You will have to read the message before you may remove it.'], 422);
        }

        if( ! $message->delete())
        {
            return response()->json(['message' => 'Message could not be removed!'], 422);
        }

        return response()->json(['message' => 'Message was removed.'], 200);
    }
}