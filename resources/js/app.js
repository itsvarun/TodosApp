import Form from './core/Form'
import Vue from 'vue'
import axios from 'axios'
import Coupon from './components/Coupon'

window.axios = axios
window.Vue = Vue
window.Form = Form

new Vue({
    el: '#app',
    components: { Coupon },
    data: {
        projects: [],
        form: new Form({
            name: '',
            description: '',
        }),
        coupon: ''
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
