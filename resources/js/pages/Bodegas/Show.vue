<template>
	<div class="card">
		<div class="card-header">Información de bodega</div>
		<div class="card-body">
			<div class="mb-3">
				<p for="nombre" class="fw-bold">Nombre de bodega:</p>
				<p>{{ bodega.nombre }}</p>
			</div>
			<div class="mb-3">
				<p for="nombre" class="fw-bold">Dirección:</p>
				<p>{{ bodega.direccion }}</p>
			</div>
			<div class="mb-3">
				<p for="sucursal" class="fw-bold">Sucursal encargada:</p>
				<p>{{ bodega.sucursal.nombre }}</p>
				<div v-if="bodega.productos.length > 0">
					<hr />
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Imágen</th>
									<th>Stock</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(item, index) in bodega.productos" :key="index">
									<td>
										{{ item.nombre }}
									</td>
									<td>
										<a :href="item.imagen"
											><img
												:src="item.imagen"
												class="img-responsive"
												height="100"
												width="100"
										/></a>
									</td>
									<td>Stock</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<hr />
			</div>
			<router-link :to="{ name: 'bodegas.index' }" class="btn btn-dark"
				><i class="fas fa-arrow-alt-circle-left me-2"></i>Regresar</router-link
			>
			<router-link
				class="btn btn-primary"
				:to="{
					name: 'bodegas.edit',
					params: { id: bodega.id },
				}"
				><i class="fas fa-edit me-2"></i>Editar</router-link
			>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			bodega: {
				sucursal: {},
				productos: [],
			},
		};
	},
	mounted() {
		//Mostrar bodega
		this.axios.get("/api/bodegas/" + this.$route.params.id).then((res) => {
			this.bodega = res.data.data;
		});
	},
};
</script>