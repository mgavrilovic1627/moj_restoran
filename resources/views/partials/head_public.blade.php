<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restoran')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: "Amatic SC", sans-serif;
            margin-top: 70px;
        }
        .tabela-kontejner {
            margin-top: 50px;
        }
        .tabela-kartica {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            background: #fff;
        }
        .tabela-kartica img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .rezervisano {
            color: red;
            font-weight: bold;
        }
        .slobodno {
            color: green;
            font-weight: bold;
        }
        .tab-sadrzaj {
            display: none;
            padding: 20px;
            background: white;
            margin-top: 20px;
            border-radius: 5px;
        }
        .tab-sadrzaj.aktivan {
            display: block;
        }
        .tab-link {
            text-decoration: none;
            color: inherit;
        }
        .w3-tag {
            padding: 5px 10px;
            margin: 5px;
        }
        .w3-red {
            background-color: #f44336 !important;
            color: white !important;
        }
        .w3-green {
            background-color: #4CAF50 !important;
            color: white !important;
        }
        .w3-round {
            border-radius: 4px;
        }
        .w3-padding-small {
            padding: 5px 10px !important;
        }
    </style>
    @yield('styles')
</head>
