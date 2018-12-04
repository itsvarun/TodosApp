@extends('layouts.app')

@section('head')

<style type="text/css">

	.todo.is-complete .todo__description {
		text-decoration: line-through;
	}

	.error-message {
		color: red;
	}

</style>

<script type="text/javascript" >
	
	const app = (function(){

		window.addEventListener('load', onLoad);

		var todoCheckboxes;

		function onLoad() {
			todoCheckboxes = document.querySelectorAll('.todo__checkbox');
		}

		function updateTodo(input) {

			// submit the todo update form
			input.closest('form').submit();

			disableTodoCheckboxes();
		}

		function disableTodoCheckboxes() {
			todoCheckboxes.forEach(function (element) {
				element.disabled = true;
			});
		}

		return {
			updateTodo: updateTodo
		};

	})();
</script>

@endsection

@section('content')

<div class="container">

	<h1>Your to-do list</h1>

	@if ($todos->count())

	<div class="todos" >

	@foreach ($todos as $todo)

		<div class="todo @is_set($todo->completed, "is-complete", "is-pending")" >
			<form style="display: inline-block;" method="POST" action="{{ route(is_set($todo->completed, "todos.pending", "todos.complete"), [$todo->id]) }}" >

				@csrf
				@method('patch')

				<input class="todo__checkbox" type="checkbox" @is_set($todo->completed, "checked") onchange="app.updateTodo(this)" >
				<span class="todo__description" >{{ $todo->description }}</span>
			</form>
			<form style="display: inline-block;" method="POST" action="{{ route('todos.delete', [$todo->id]) }}" onsubmit="return confirm('Do you want to delete this todo?')" >

				@csrf
				@method('delete')
				
				<input class="btn btn-danger"  type="submit" value="X">
			</form>
		</div>

	@endforeach

	</div>
	@else
	<p>No todos found.</p>
	@endif

	<div>
		<h2>Create new todo</h2>
		<form action="{{ route('todos.create') }}" method="POST" >
			@csrf
			<input type="text" name="description" placeholder="What you want to do?">
			<input type="submit" value="Add">
		</form>
		
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				<span class="error-message" >{{ $error }}</span>
			@endforeach
		@endif
	</div>

</div>

@endsection