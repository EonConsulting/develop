<!DOCTYPE html>
<html>
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="/vendor/storyline/core/css/economics.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>UNISA - eLearning | Department of Economics</title>
</head>

<body>
<nav class="grey">
    <div class="nav-wrapper">
    </div>
</nav>

<div class="container">
    @yield('content')

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/vendor/storyline/core/js/materialize.min.js"></script>
    <script type="text/javascript" src="/vendor/storyline/core/js/economics.js"></script>
</body>
</html>