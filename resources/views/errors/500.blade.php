@extends('layouts.material.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card animated fadeInUp animation-delay-7 color-primary withripple">
                    <div class="card-block-big color-dark">
                        <div class="text-center">
                            <h1 class="color-primary">Error 500</h1>
                            <h2>Internal Server Error</h2>
                            <p class="lead lead-sm">Something has gone wrong we are trying to fix it.
                                <br>Meanwhile you can go back to the homepage.</p>
                            <a href="/" class="btn btn-primary btn-raised">
                                <i class="zmdi zmdi-home"></i> Go Home</a>
                        </div>
                    </div>
                    <div class="ripple-container"></div></div>
                <div class="card animated fadeInUp animation-delay-9 color-primary withripple">
                    <div class="card-block-big color-dark">
                        <h2 class="color-primary">Search</h2>
                        <p class="lead">Use the search engine to browse our website and find what you want.</p>
                        <div class="form-group label-floating is-empty">
                            <label class="control-label" for="addon2">Search in page...</label>
                            <input type="text" id="addon2" class="form-control"> </div>
                        <a href="/" class="btn btn-primary btn-raised btn-block">
                            <i class="zmdi zmdi-search"></i> Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection