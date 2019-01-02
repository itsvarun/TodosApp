@extends('projects/layout')
@section('head')
<style>
    span {
        color: red;
    }
</style>
@endsection
@section('app')
<div>
    <h1>Your projects</h2>
    <ul v-show="projects.length > 0" >
        <li v-for="project in projects" >
            <h3 v-text="project.name" ></h3>
            <p v-text="project.description" ></p>
        </li>
    </ul>
    <p v-show="projects.length == 0" >You don't have project yet!</p>
</div>

<div>
    <h2>Add new project</h2>
    <form @submit.prevent="onSubmit" @keydown="clearError" >
        <label for="project-name">Name</label></br>
        <input type="text" id="project-name" v-model="form.name" name="name" >
        </br>
        <span v-text="form.errors.get('name')" ></span>
        </br>
        <label for="project-description">Description</label></br>
        <textarea id="project-description" cols="30" rows="10" v-model="form.description" name="description" ></textarea>
        </br>
        <span v-text="form.errors.get('description')" ></span>
        </br>
        <input type="submit" value="Add" :disabled="form.errors.any()" >
    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}" ></script>
@endsection
