<!DOCTYPE html>
<html>
<head>
    <!-- Include Vue.js and Vue Router -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-router@3.5.1"></script>

    <!-- Include Bootstrap or any other CSS frameworks you are using -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    @stack('css')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    @stack('scripts') <!-- Include Vue app.js script here -->
</body>
</html>
