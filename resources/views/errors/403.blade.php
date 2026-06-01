@extends('layouts.app')

@section('title', '403 - ¡Quieto ahí!')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/errors.css') }}">
@endpush

@section('content')
<div class="content-wrapper error-wrapper" id="error-403">
    <section class="content-header content-header-custom">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card card-error border-danger">
                        <div class="card-body text-center py-5">
                            <h1 class="display-1 text-danger error-number">403</h1>
                            <h2 class="mt-3">
                                <i class="fas fa-hand-paper text-danger icon-shake"></i> 
                                ¡Quieto ahí, socio! 
                                <i class="fas fa-user-lock text-dark icon-pulse ml-2"></i>
                            </h2>
                            <h5 class="text-muted mt-4">No tienes las llaves para entrar a este chuzo.</h5>
                            <p class="text-muted">Da media vuelta suavemente o llamamos a la seguridad del servidor 👮‍♂️.</p>
                            <a href="{{ route('home') }}" class="btn btn-danger btn-lg rounded-pill shadow-sm mt-4 px-5">
                                <i class="fas fa-running mr-2"></i> Mejor me voy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection