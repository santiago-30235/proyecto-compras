@extends('layouts.app')

@section('title','Crear Proveedor')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="page-title">
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Proveedor
                    </h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card modern-card">
                        <div class="card-header modern-card-header">
                            <h3 class="card-title">
                                <i class="fas fa-building mr-2"></i>
                                Información del proveedor
                            </h3>
                        </div>

                        <form method="POST" action="{{ route('proveedores.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Nombre Completo
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="nombre" class="form-control modern-input" placeholder="Ingrese el nombre" autocomplete="off" value="{{ old('nombre') }}" required>
                                            </div>
                                            @error('nombre')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Documento
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-id-card"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="documento" class="form-control modern-input" placeholder="Ingrese el documento" autocomplete="off" value="{{ old('documento') }}" required>
                                            </div>
                                            @error('documento')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Teléfono
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="telefono" class="form-control modern-input" placeholder="Ingrese el teléfono" autocomplete="off" value="{{ old('telefono') }}" required>
                                            </div>
                                            @error('telefono')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Correo Electrónico
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" name="email" class="form-control modern-input" placeholder="Ingrese el correo" autocomplete="off" value="{{ old('email') }}" required>
                                            </div>
                                            @error('email')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Dirección</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="direccion" class="form-control modern-input" placeholder="Ingrese la dirección" autocomplete="off" value="{{ old('direccion') }}">
                                            </div>
                                            @error('direccion')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="estado" value="1">
                                <input type="hidden" name="registradopor" value="{{ Auth::user()->name }}">
                            </div>

                            <div class="card-footer modern-footer">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary btn-modern">
                                        <i class="fas fa-times mr-1"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-success btn-modern shadow-sm">
                                        <i class="fas fa-save mr-1"></i>
                                        Guardar Proveedor
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection