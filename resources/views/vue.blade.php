<!DOCTYPE html>
<html>
<head>
	<title>Vue</title>

	<meta name="csrf-token" content="{{ csrf_token() }}" >

	<script src="{{ asset('js/app.js') }}" ></script>
	<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
	<script>
		Vue.use(VeeValidate);
	</script>
</head>
<body>


<div id="app">
	<input v-validate="'required|email'" name="email" type="text">
	<span>@{{ errors.first('email') }}</span>
	<p>You're name is @{{ username ? username : "'empty'" }}</p>
</div>

<script>



const app = new Vue({
    el: '#app',

    data: {
    	username: ''
    },

    methods: {

    }
});

</script>

</body>
</html>