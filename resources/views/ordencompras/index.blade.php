@extends('layouts.app')

@section('title', 'Órdenes de Compra')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            @yield('title')
                            <a href="{{ route('ordencompras.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover datatable">
                                <thead class="text-primary">
                                    <th width="10px">ID</th>
                                    <th>Proveedor</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo de Pago</th>
                                    <th>Saldo Pendiente</th>
                                    <th width="80px">Estado</th>
                                    <th>Registrado por</th>
                                    <th width="90px">Acción</th>
                                </thead>
                                <tbody>
                                    @foreach($ordencompras as $orden)
                                    <tr>
                                        <td>{{ $orden->id }}</td>
                                        <td>{{ $orden->proveedor->nombre ?? '—' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($orden->fecha)->format('d/m/Y') }}</td>
                                        <td>${{ number_format($orden->total, 2) }}</td>
                                        <td>{{ $orden->tipopago }}</td>
                                        <td>
                                            @if($orden->saldopendiente > 0)
                                                ${{ number_format($orden->saldopendiente, 2) }}
                                            @else
                                                <span class="badge badge-success">Pagado</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <input data-type="ordencompra" data-id="{{ $orden->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $orden->estado == '1' ? 'checked' : '' }}>
                                        </td>
                                        <td>{{ $orden->registradopor }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('ordencompras.show', $orden->id) }}" class="btn btn-info" title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('ordencompras.edit', $orden->id) }}" class="btn btn-primary" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form class="d-inline delete-form" action="{{ route('ordencompras.destroy', $orden->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $ordencompras->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection