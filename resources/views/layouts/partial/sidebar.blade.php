<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="nav-link active">
		<img src="{{ asset('backend/dist/img/imagen_login.jpeg')}}" 
     alt="Logo" 
     style="opacity: .8; height:100px; width:auto; display:block; margin:auto;">
    </a>
    <div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="{{ url('/home') }}" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Panel De Control
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						<p> Compras <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						
							<li class="nav-item">
								<a href="{{ route('proveedores.index') }}" class="nav-link">
									<i class="nav-icon fas fa-truck"></i>
									<p> Proveedores </p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('productos.index') }}" class="nav-link">
									<i class="nav-icon fas fa-box-open"></i>
									<p>Productos </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('ordencompras.index') }}" class="nav-link">
									<i class="nav-icon fas fa-file-invoice"></i>
									<p>Orden de Compras </p>
								</a>
							</li>
				
							<li class="nav-item">
								<a href="{{ route('metodopagos.index') }}" class="nav-link">
									<i class="nav-icon fas fa-credit-card"></i>
									<p>Metodo de Pagos </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="{{ route('pagos.index') }}" class="nav-link">
									<i class="nav-icon fas fa-check-circle"></i>
									<p> Pagos </p>
								</a>
							</li>
						
					</ul>
				</li>
				
			</ul>
		</nav>
    </div>
</aside>