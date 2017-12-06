<?php

namespace EONConsulting\StudentNotes\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\StudentNotes\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = $request->validate([
            'storyline_item_id' => 'required',
        ]);

        $notes = Note::byStudent()->forStoryLineItem($data['storyline_item_id'])->get();

        $notes_view = view('student-notes::view_note', compact('notes'))->render();

        return response()->json(['status' => 200, 'html' => $notes_view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'storyline_item_id' => 'required',
            'body' => 'required',
        ]);

        $user_id = '1'; // auth()->user()->id @TODO

        $note = Note::create([
            'user_id' => $user_id,
            'storyline_item_id' => $data['storyline_item_id'],
            'body' => $data['body']
        ]);

        return response()->json(['status' => 200, 'note_id' => $note->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::where('id', $id)->delete();

        return response()->json(['status' => 200]);
    }
}