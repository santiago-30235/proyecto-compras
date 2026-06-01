@extends('layouts.app')

@section('title', '500 - ¡Se totió esto!')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/errors.css') }}">
@endpush

@section('content')
<div class="content-wrapper error-wrapper" id="error-500">
    <section class="content-header content-header-custom">
        <div class="container-fluid"></div>
    </section>
    @include('layouts.partial.msg')
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card card-error border-dark">
                        <div class="card-body text-center py-5">
                            <h1 class="display-1 error-number">500</h1>
                            <h2 class="mt-3">
                                <i class="fas fa-bomb icon-pulse-danger"></i> 
                                ¡Se totió esta joda! 
                                <i class="fas fa-cogs icon-spin-fast ml-2"></i>
                            </h2>
                            <h5 class="text-muted mt-4">El servidor tiró la toalla.</h5>
                            <p class="text-muted">Échale la culpa al practicante. Ya lo pusimos a arreglar el daño con cinta y café.</p>
                            <a href="{{ route('home') }}" class="btn btn-dark btn-lg rounded-pill shadow-sm mt-4 px-5">
                                <i class="fas fa-tools mr-2"></i> Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection