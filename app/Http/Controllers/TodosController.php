<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
use App\User;

class TodosController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

        $this->middleware('can:update,todo')
                ->only(['complete', 'pending', 'destroy']);

    }

    public function complete(Todo $todo) {

        $todo->completed = \Carbon\Carbon::now();
        $todo->save();

        return redirect()->route('todos.list');
    }

    public function pending(Todo $todo) {

        $todo->completed = null;
        $todo->save();

        return redirect()->route('todos.list');
    }

    public function index(User $user) {

        return view('todos.list', ['todos' => $user->todos]);
    }

    public function store(User $user) {

        $user->todos()->create(request()->validate([
            'description' => 'required|min:3|max:128'
        ]));

        return redirect()->route('todos.list');
    }

    public function destroy(Todo $todo) {

        $todo->delete();
        
        return redirect()->route('todos.list');
    }




    // different ways of authorizing access to user

    // abort_if(! auth()->user()->owns($todo), 403);

    // abort_unless(\Gate::allows('update', $todo), 403);

    // abort_unless(\Gate::allows('update-todo', $todo), 403);

    // about_if(\Gate::denies('update-todo', $todo), 403);

    // $this->authorize('update', $todo);

}
