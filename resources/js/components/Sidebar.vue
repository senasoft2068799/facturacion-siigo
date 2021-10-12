<template>
	<nav id="sidebar" class="bg-light">
		<div class="sidebar-header border-bottom">
			<img
				:src="'/public/images/logo.png'"
				class="img-responsive rounded"
				height="80"
			/>
		</div>
		<ul class="list-group list-group-flush">
			<li class="nav-item">
				<router-link active-class="active" exact :to="{ name: 'dashboard' }">
					<i class="fas fa-home"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#home"></use>
					</svg>
					Home
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'facturas.index' }">
					<i class="fas fa-file-invoice"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#table"></use>
					</svg>
					Facturas
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'sucursales.index' }">
					<i class="fas fa-building"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#table"></use>
					</svg>
					Sucursales
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'bodegas.index' }">
					<i class="fas fa-folder"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#speedometer2"></use>
					</svg>
					Bodegas
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'productos.index' }">
					<i class="fas fa-tags"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#table"></use>
					</svg>
					Productos
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'roles.index' }">
					<i class="fas fa-users"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#grid"></use>
					</svg>
					Roles
				</router-link>
			</li>
			<li class="nav-item">
				<router-link active-class="active" :to="{ name: 'usuarios.index' }">
					<i class="fas fa-users"></i>
					<svg class="bi me-2" width="5" height="16">
						<use xlink:href="#grid"></use>
					</svg>
					Usuarios
				</router-link>
			</li>
		</ul>
	</nav>
</template>
<script>
export default {
	name: "Sidebar",
};
</script>