<!DOCTYPE html>
<html>
<head>
    <title>kayPHP || Your Light Weight PHP Framework </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
    <style>
      body {
        color:white;
        margin-bottom:50px;
        background:#0d1d24;
        text-align: center;
      } 
      #footer {
            position: fixed;
            height: 50px;
            color: grey;
            background-color:#f8f9fa;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin-bottom: 0px;
            padding-top: 12px;
        }
    </style>
</head>
<body >
<!-- HEAD -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/public/kayphplogo.png" alt="logo" style="width:40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ml-auto">
                {% if auth  %}
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">HOMEPAGE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/docs">DOCS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">LOGOUT</a>
                </li>
                {% else %}
                <li class="nav-item">
                    <a class="nav-link" href="/login">LOGIN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">REGISTER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">HOMEPAGE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/docs">DOCS</a>
                </li>
                {% endif %}
            </ul>
        </div>
    </div>
</nav>
<div style="margin: 20px;"></div>
<!-- HEAD -->    
