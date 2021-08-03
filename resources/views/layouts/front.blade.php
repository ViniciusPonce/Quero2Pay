<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="https://www.quero2pay.com.br/wp-content/uploads/2021/04/cropped-q2pay_favicon-32x32.png" sizes="32x32" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
        rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <title>Quero 2 Pay</title>
    <style>
        body {
            background:url("http://cdn30.us1.fansshare.com/image/backgroundgradient/blue-gradient-background-457011522.jpg") center center/cover no-repeat local ;
            background-attachment: fixed;
        }

    </style>
</head>
<body>

<!-- JQUERY / AJAX -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<div class="container py-5" >
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar navbar-default">
        <div class="container ">
            <div class="row">
                <div class="col">
                    <!-- Brand -->
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="https://www.quero2pay.com.br/wp-content/uploads/2021/03/Quero2Pay_logo.svg" width="150" height="60" style="margin-left: 20px" class="d-inline-block align-top" alt="">
                    </a>

                    <!-- Collapse -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <!-- Links -->
                <div class="col d-flex align-items-center">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent" >
                        <!-- Center -->
                        <ul class="navbar-nav mr-auto" >
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('companies')}}">Empresas
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('employees')}}">Funcionários</a>
                            </li>
        {{--                    <li class="nav-item">--}}
        {{--                        <a class="nav-link" href="https://mdbootstrap.com/getting-started/" target="_blank">Free download</a>--}}
        {{--                    </li>--}}
        {{--                    <li class="nav-item">--}}
        {{--                        <a class="nav-link" href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank">Free tutorials</a>--}}
        {{--                    </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Render Pages -->
    @yield('content')
</div>
</body>
<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
<!-- Sweet Alert 2  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
