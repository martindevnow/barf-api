<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BARF API</title>
    <meta name="description" content="BARF Bento raw dog food is a Toronto based company specializing in high-quality catered, portioned and delivered meals for your dog. Our nutritional raw dog food meals focus on the BARF diet and biologically appropriate raw food guidelines.">
    <meta property="og:description" content="BARF Bento - Raw dog food delivery service">
    <meta property="og:description" content="BARF Bento raw dog food is a Toronto based company specializing in high-quality catered, portioned and delivered meals for your dog. Our nutritional raw dog food meals focus on the BARF diet and biologically appropriate raw food guidelines.">

    <meta property="og:url" content="http://barfbento.com/">
    <meta property="og:site_name" content="BARFBento - Raw Dog Food Delivery Service">

    <!-- <link rel="shortcut icon" href="/material/img/favicon.png?v=3"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/material/css/preload.min.css" />
    <link rel="stylesheet" href="/material/css/plugins.min.css" />
    <link rel="stylesheet" href="/material/css/style.red-600.min.css" />
    <link rel="stylesheet" href="/barfbento/css/app.css" />
    <link rel="stylesheet" href="/barfbento/css/barf.css" />

    <!--[if lt IE 9]>
    <script src="/material/js/html5shiv.min.js"></script>
    <script src="/material/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="sb-site-container" id="client-app">

    @yield('content')

    <div class="btn-back-top">
        <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised ">
            <i class="zmdi zmdi-long-arrow-up"></i>
        </a>
    </div>
</div>

</body>
</html>