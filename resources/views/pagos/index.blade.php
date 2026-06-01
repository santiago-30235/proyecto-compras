@extends('layouts.app')

@section('title', 'Pagos')

@section('content')

<div class="content-wrapper">
    <section class="content-header" style="text-align: right;">
		<div class="container-fluid">
		</div>
    </section>
	@include('layouts.partial.msg')
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
							@yield('title')
							<a href="{{ route('pagos.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover datatable">
								<thead class="text-primary">
									<th width="10px">ID</th>
									<th>Orden de Compra</th>
									<th>Método de Pago</th>
									<th>Fecha de Pago</th>
									<th>Monto</th>
									{{-- <th width="60px">Estado</th> --}}
									<th>Registrado por</th>
									<th width="90px">Acción</th>
                                </thead>
                                <tbody>
									@foreach($pagos as $pago)
									<tr>
										<td>{{ $pago->id }}</td>
										<td><div>Orden #{{ $pago->ordencompra_id }}</div> <div style="font-size: 11px; color: #718096;">({{ $pago->ordencompra?->proveedor?->nombre ?? 'Proveedor no encontrado' }})</div></td>
										<td>{{ $pago->metodopago->nombre ?? '—' }}</td>
										<td>{{ \Carbon\Carbon::parse($pago->fechapago)->format('d/m/Y') }}</td>
										<td>${{ number_format($pago->monto, 2) }}</td>
										{{--<td>
												@if($pago->estado == '1')
													<span class="badge badge-success">Activo</span>
												@else
													<span class="badge badge-danger">Inactivo</span>
												@endif
											</td>--}}
											<td>{{ $pago->registradopor }}</td>
											<td class="text-center">
												<div class="btn-group btn-group-sm">
													<a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info" title="Ver">
														<i class="fas fa-eye"></i>
													</a>
													<a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-primary" title="Editar">
														<i class="fas fa-pencil-alt"></i>
													</a>
													<form class="d-inline delete-form" action="{{ route('pagos.destroy', $pago->id) }}" method="POST">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
															<i class="fas fa-trash-alt"></i>
														</button>
													</form>
												</div>
											</div>
											</div>
											</div>
											</td>
											</tr>
									@endforeach
								</tbody>
							</table>
							<div class="mt-3">
								{{ $pagos->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
 </div>
@endsection