@extends('layouts.app')

@section('title','Panel De Control')

@section('content')

	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">@yield('title')</h1>
					</div>
				</div>
			</div>
		</div>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-6">
						<div class="small-box bg-info">
							<div class="inner">
								<h3>10<sup style="font-size: 20px"></sup></h3>
								<p>Total Proveedores</p>
							</div>
							<div class="icon">
								<i class="fas fa-people-carry"></i>
							</div>
							<a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3>10<sup style="font-size: 20px"></sup></h3>
								<p>Productos Registrados</p>
							</div>
							<div class="icon">
								<i class="fas fa-box"></i>
							</div>
							<a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3>10</h3>
								<p>Órdenes de Compra</p>
							</div>
							<div class="icon">
								<i class="fas fa-file-invoice"></i>
							</div>
							<a href="{{ route('ordencompras.index') }}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>10</h3>
								<p>Pagos Registrados</p>
							</div>
							<div class="icon">
								<i class="fas fa-credit-card"></i>
							</div>
							<a href="#" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
		  </div>
		</section>
	</div>
@endsection
