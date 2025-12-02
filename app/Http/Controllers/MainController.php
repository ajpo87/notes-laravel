<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Services\Operations;

class MainController extends Controller
{
    /*public function index($value)
    {
      return view('main',['value' => $value, 'name' => 'John']);
    }

    public function page2($value)
    {
      return view('page2',['value' => $value, 'name' => 'page2']);
    }

    public function page3($value)
    {
      return view('page3',['value' => $value, 'name' => 'page3']);
    }*/
    public function index()
    {
        //load users notes
        $id = session('user.id');

        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        //return home view
       // var_dump($notes);die;
        return view('home', ['notes' => $notes]);
    }

    public function newNote(){
        //show new note view
        return view('newNote');
    }

    public function newNoteSubmit(Request $request){
        //handle new note submission
        // validate request
            $request->validate(
            // Rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            //Messages
            [
                'text_title.required' => 'O titulo é obrigatorio',
                'text_title.min'=> 'O titulo deve ter pelo menos  :min caracters',
                'text_title.max'=> 'O titulo deve ter no máximo  :max caracters',
                'text_note.required'=> 'A nota é obrigatoria',
                'text_note.min'=> 'A nota deve ter pelo menos  :min caracters',
                'text_note.max'=> 'A nota deve ter no máximo  :max caracters'
            ]
        );

        echo 'ok';


        // get user id

        $id = session('user.id');

        //create new note
        $note = new Note();
        $note->title = $request->input('text_title');
        $note->text = $request->input('text_note');
        $note->user_id = $id;
        $note->save();

        //redirect to home
        return redirect()->route('home');
    }

    /*private function decryptId($id){
        try {
            $id = Crypt::decrypt($id);
            return $id;
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }*/

    public function editNote($id){
      /* $id = $this->decryptId($id);*/
        $id = Operations::decrytpId($id);
        echo "Edit note with ID: ".$id;
    }

    public function deleteNote($id){
        /*$id = $this->decryptId($id);*/
        $id = Operations::decrytpId($id);
        echo "DEleting note with ID: ".$id;
    }
}

