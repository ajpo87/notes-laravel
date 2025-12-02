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
        echo 'Create a new note';
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

