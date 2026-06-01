@extends('layouts.app')

@section('title', 'Productos')

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
							<a href="{{ route('productos.create') }}" class="btn btn-primary float-right" title="Nuevo"><i class="fas fa-plus nav-icon"></i></a>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-hover datatable">
								<thead class="text-primary">
									<th width="10px">ID</th>
									<th>Imagen</th>
									<th>Nombre</th>
									<th>Precio Compra</th>
									<th>Stock Máximo</th>
									<th>Descripción</th>
									<th width="80px">Estado</th>
									<th>Registrado por</th>
									<th width="90px">Acción</th>
                                </thead>
                                <tbody>
									@foreach($productos as $producto)
									<tr>
										<td>{{ $producto->id }}</td>
										<td>
												@if($producto->imagen && $producto->imagen !== 'sin-imagen.png')
													<img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" style="width:44px; height:44px; object-fit:cover; border-radius:8px;">
												@else
													<i class="fas fa-box-open" style="font-size:24px; color:#cbd5e0;"></i>
												@endif
											</td>
										<td>{{ $producto->nombre }}</td>
										<td>${{ number_format($producto->preciocompra, 2) }}</td>
										<td>{{ $producto->stockmaximo }} uds.</td>
										<td>{{ $producto->descripcion ?? '—' }}</td>
										<td>
												<input data-type="producto" data-id="{{ $producto->id }}" class="toggle-class" type="checkbox" 
												       data-onstyle="success" data-offstyle="danger" 
												       data-toggle="toggle" data-on="Activo" data-off="Inactivo" 
												       {{ $producto->estado == '1' ? 'checked' : '' }}>
											</td>
											<td>{{ $producto->registradopor }}</td>
											<td class="text-center">
												<div class="btn-group btn-group-sm">
													<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info" title="Ver">
														<i class="fas fa-eye"></i>
													</a>
													<a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary" title="Editar">
														<i class="fas fa-pencil-alt"></i>
													</a>
													<form class="d-inline delete-form" action="{{ route('productos.destroy', $producto->id) }}" method="POST">
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
								{{ $productos->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
 </div>
@endsection