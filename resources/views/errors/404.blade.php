@extends('layouts.app')

@section('title', '404 - ¡Paila, te perdiste!')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/errors.css') }}">
@endpush

@section('content')
<div class="content-wrapper error-wrapper" id="error-page">
    <section class="content-header content-header-custom">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card card-error border-warning">
                        <div class="card-body text-center py-5">
                            <h1 class="display-1 text-warning error-number">404</h1>
                            <h2 class="mt-3">
                                <i class="fas fa-ghost text-info icon-bounce"></i> 
                                ¡Paila, te perdiste! 
                                <i class="fas fa-compass text-danger icon-spin-fast ml-2"></i>
                            </h2>
                            <h5 class="text-muted mt-4">Esta página se fue de rumba y no volvió.</h5>
                            <p class="text-muted">Mejor arranca pal inicio antes de que te cobremos arriendo aquí.</p>
                            <a href="{{ route('home') }}" class="btn btn-warning btn-lg rounded-pill shadow-sm mt-4 px-5">
                                <i class="fas fa-rocket mr-2"></i> Sacarme de aquí
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection