<template>
	<div>
		<router-link class="btn btn-success mb-3" :to="{ name: 'bodegas.create' }"
			>Registrar bodega</router-link
		>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Dirección</th>
						<th>Sucursal</th>
						<th>Fecha de creación</th>
						<th>Fecha de modificación</th>
						<th>Funciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(bodega, index) in bodegas" :key="index">
						<td>{{ bodega.nombre }}</td>
						<td>{{ bodega.direccion }}</td>
						<td>{{ bodega.sucursal.nombre }}</td>
						<td>{{ bodega.created_at }}</td>
						<td>{{ bodega.updated_at }}</td>
						<td>
							<router-link
								class="btn btn-info btn-sm text-white"
								:to="{
									name: 'bodegas.show',
									params: { id: bodega.id },
								}"
								title="Detalles"
								><i class="fas fa-info-circle"></i
							></router-link>
							<router-link
								class="btn btn-warning btn-sm text-white"
								:to="{
									name: 'bodegas.edit',
									params: { id: bodega.id },
								}"
								title="Editar"
								><i class="fas fa-edit"></i
							></router-link>
							<button
								@click="eliminarBodega(bodega, index)"
								class="btn btn-danger btn-sm"
								title="Eliminar"
							>
								<i class="fas fa-trash"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			bodegas: [],
		};
	},
	created() {
		this.axios.get("/api/bodegas").then((response) => {
			this.bodegas = response.data.data;
		});
	},
	methods: {
		eliminarBodega(bodega, index) {
			this.$swal({
				title: "¿Estás seguro?",
				text: "Se eliminará la bodega: '" + bodega.nombre + "'",
				icon: "warning",
				showCancelButton: true,
			}).then((result) => {
				if (result.value) {
					axios
						.delete("/api/bodegas/" + bodega.id)
						.then((response) => {
							this.bodegas.splice(index, 1);
							this.$swal({
								icon: "success",
								title: "Bodega eliminada.",
							});
						})
						.catch((err) => {
							this.$swal({
								icon: "error",
								title: "Ha ocurrido un error:\n" + err,
							});
						});
				}
			});
		},
	},
};
</script>