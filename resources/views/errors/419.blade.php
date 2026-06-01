@extends('layouts.app')

@section('title', '419 - ¡Te dormiste!')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/errors.css') }}">
@endpush

@section('content')
<div class="content-wrapper error-wrapper" id="error-419">
    <section class="content-header content-header-custom">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card card-error border-info">
                        <div class="card-body text-center py-5">
                            <h1 class="display-1 text-info error-number">419</h1>
                            <h2 class="mt-3">
                                <i class="fas fa-hourglass-half text-info icon-hourglass"></i> 
                                ¡Te dormiste, socio! 
                                <i class="fas fa-bed text-secondary icon-bounce ml-2"></i>
                            </h2>
                            <h5 class="text-muted mt-4">La sesión se venció por inactividad.</h5>
                            <p class="text-muted">Fuiste a preparar un tinto y se nos acabó el tiempo por aquí. Toca volver a empezar.</p>
                            <a href="{{ url()->previous() }}" class="btn btn-info btn-lg rounded-pill shadow-sm mt-4 px-5 text-white">
                                <i class="fas fa-sync-alt mr-2"></i> Recargar la página
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection