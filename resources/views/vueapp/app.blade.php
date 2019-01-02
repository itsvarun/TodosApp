<!DOCTYPE html>
<html>
<head>
    <title>Vue app with axios</title>
</head>
<body>

<div id="app">
    <ul>
        <li v-for="skill in skills" v-text="skill"></li>
    </ul>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            skills: []
        },
        created() {
            axios.get('/skills').then(respone => {
                this.skills = respone.data
            });
        },

    });
</script>
</body>
</html>
