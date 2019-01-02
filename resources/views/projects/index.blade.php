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
<script>

    class Errors {

        constructor() {
            this.errors = {}
        }

        record(errors) {
            this.errors = errors
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        get(field) {
            if (this.has(field)) {
                return this.errors[field][0];
            }
        }

        any() {
            return Object.keys(this.errors).length > 0;
        }

        clear(field) {
            if (field) delete this.errors[field]
            else this.errors = {}
        }
    }

    class Form {
        constructor(fields) {
            this.fields = Object.keys(fields)
            this.forEveryField(field => {
                this[field] = fields[field]
            })

            this.errors = new Errors()
        }

        forEveryField(callback)  {
            this.fields.forEach(field => {
                callback(field)
            })
        }

        data() {
            let data = {}
            this.forEveryField(field => {
                data[field] = this[field];
            })
            return data
        }

        submit(method, url) {
            return new Promise((reslove, reject) => {
                axios[method](url, this.data())
                .then(response => {
                    this.onSuccess()
                    reslove(response.data)
                })
                .catch(error => {
                    const errors = error.response.data.errors
                    reject(errors)
                    this.onFail(errors)
                })
            })
        }

        onSuccess() {
            this.reset()
        }

        onFail(errors) {
            this.errors.record(errors)
        }

        reset() {
            this.forEveryField(field => {
                this[field] = ''
            })
            this.errors.clear()
        }
    }

    new Vue({
        el: '#app',
        data: {
            projects: [],
            form: new Form({
                name: '',
                description: '',
            }),
        },

        created() {
            axios.get('/projects/list')
            .then(response => {
                this.projects = response.data
            })
        },

        methods: {
            onSubmit() {
                this.form.submit('post', '/projects')
                    .then(this.onProjectAdded)
                    .catch(error => {
                        console.log('failed', error)
                    })
            },
            clearError(event) {
                this.form.errors.clear(event.target.name)
            },
            onProjectAdded(response) {
                this.projects.push(response.data)
            }
        }
    });
</script>
@endsection
