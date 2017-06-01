@extends('layouts.material.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card animated fadeInUp animation-delay-7 color-primary withripple">
                <div class="card-block-big color-dark">
                    <div class="text-center">
                        <h1 class="color-primary">Error 404</h1>
                        <h2>Page Not Found</h2>
                        <p class="lead lead-sm">We have not found what you are looking for.
                            <br>We have put our robots to search.</p>
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