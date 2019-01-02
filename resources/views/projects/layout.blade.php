<!DOCTYPE html>
<html>
<head>
    <title>My Projects</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
    <style>
        :root {
            font-size: 14px;
            font-family: sans-serif;
        }
    </style>
    @yield('head')
</head>
<body>
    <div id="app">
        @yield('app')
    </div>
    @yield('script')
</body>
</html>
