<template>
	<div class="card">
		<div class="card-header">Información de producto:</div>
		<div class="card-body">
			<div class="mb-3">
				<figure>
					<center>
						<p class="fw-bold">Imágen del producto:</p>
						<br />
						<img
							class="img-fluid img-thumbnail"
							width="250"
							height="250"
							:src="producto.imagen"
							alt="Imagen del producto"
						/>
					</center>
				</figure>
			</div>
			<div class="mb-3">
				<p class="fw-bold">Nombre del producto:</p>
				<p>{{ producto.nombre }}</p>
			</div>
			<div class="mb-3">
				<p class="fw-bold">Precio unitario</p>
				<p>{{ producto.precio_unitario }}</p>
			</div>

			<div class="mb-3">
				<p for="categoria" class="fw-bold">Categoría:</p>
				<p>{{ producto.categoria.nombre }}</p>
			</div>
			<div class="row mb-3">
				<div class="col-md-6">
					<p class="fw-bold">Fecha de creación:</p>
					<p>{{ producto.created_at }}</p>
				</div>
				<div class="col-md-6">
					<p class="fw-bold">Fecha de modificación:</p>
					<p>{{ producto.updated_at }}</p>
				</div>
			</div>
			<div v-if="producto.bodegas.length > 0">
				<hr />
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Bodega</th>
								<th>Dirección</th>
								<th>Stock</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, index) in producto.bodegas" :key="index">
								<td>
									{{ item.nombre }}
								</td>
								<td>
									{{ item.direccion }}
								</td>
								<td>Stock</td>
							</tr>
						</tbody>
					</table>
				</div>
				<hr />
			</div>
			<router-link :to="{ name: 'productos.index' }" class="btn btn-dark"
				><i class="fas fa-arrow-alt-circle-left ms-2"></i>Regresar</router-link
			>
			<router-link
				class="btn btn-primary"
				:to="{
					name: 'productos.edit',
					params: { id: producto.id },
				}"
				><i class="fas fa-edit ms-2"></i>Editar</router-link
			>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			producto: {
				imagen: null,
				categoria: {},
				bodegas: [],
			},
		};
	},
	mounted() {
		//Mostrar producto
		this.axios.get("/api/productos/" + this.$route.params.id).then((res) => {
			this.producto = res.data.data;
		});
	},
};
</script>