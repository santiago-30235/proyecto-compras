@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="page-title">
                        <i class="fas fa-box-open mr-2"></i>
                        Crear Producto
                    </h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary shadow-sm">
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
                                <i class="fas fa-box mr-2"></i>
                                Información del producto
                            </h3>
                        </div>

                        <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Nombre del producto
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-tag"></i>
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
                                                Precio de compra
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                </div>
                                                <input type="number" step="0.01" name="precio_compra" class="form-control modern-input" placeholder="Ingrese el precio" value="{{ old('precio_compra') }}" required>
                                            </div>
                                            @error('precio_compra')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Stock Máximo
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-layer-group"></i>
                                                    </span>
                                                </div>
                                                <input type="number" name="stockmaximo" class="form-control modern-input" placeholder="Ingrese el stock" value="{{ old('stockmaximo') }}" required>
                                            </div>
                                            @error('stockmaximo')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Imagen</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-image"></i>
                                                    </span>
                                                </div>
                                                <input type="file" name="imagen" class="form-control modern-input">
                                            </div>
                                            @error('imagen')
                                                <span class="text-danger small">
                                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Descripción</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-align-left"></i>
                                                    </span>
                                                </div>
                                                <textarea name="descripcion" rows="4" class="form-control modern-input" placeholder="Ingrese una descripción">{{ old('descripcion') }}</textarea>
                                            </div>
                                            @error('descripcion')
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
                                    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-modern">
                                        <i class="fas fa-times mr-1"></i>
                                        Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-success btn-modern shadow-sm">
                                        <i class="fas fa-save mr-1"></i>
                                        Guardar Producto
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