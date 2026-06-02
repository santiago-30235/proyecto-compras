@extends('layouts.app')

@section('title', 'Editar Pago')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        <form method="POST" action="{{ route('pagos.update', $pago) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Orden de Compra <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="ordencompra_id">
                                                @foreach($ordencompras as $orden)
                                                    <option value="{{ $orden->id }}" {{ $orden->id == $pago->ordencompra_id ? 'selected' : '' }}>
                                                        Orden #{{ $orden->id }} - {{ $orden->proveedor->nombre ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ordencompra_id')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Método de Pago <strong style="color:red;">(*)</strong></label>
                                            <select class="form-control" name="metodopago_id">
                                                @foreach($metodopagos as $metodo)
                                                    <option value="{{ $metodo->id }}" {{ $metodo->id == $pago->metodopago_id ? 'selected' : '' }}>
                                                        {{ $metodo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('metodopago_id')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Fecha de Pago <strong style="color:red;">(*)</strong></label>
                                            <input type="date" class="form-control" name="fechapago" value="{{ old('fechapago', \Carbon\Carbon::parse($pago->fechapago)->format('Y-m-d')) }}">
                                            @error('fechapago')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Monto <strong style="color:red;">(*)</strong></label>
                                            <input type="number" step="0.01" class="form-control" name="monto" value="{{ old('monto', $pago->monto) }}">
                                            @error('monto')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Actualizar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('pagos.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                                    </div>
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