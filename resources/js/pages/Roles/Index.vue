<template>
	<div>
		<router-link class="btn btn-primary mb-3" :to="{ name: 'roles.create' }"
			>Registrar rol</router-link
		>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="table-dark text-center">
					<tr>
						<th>Nombre de rol</th>
						<th>Estado</th>
						<th>Fecha de creación</th>
						<th>Fecha de modificación</th>
						<th>Funciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(rol, index) in roles" :key="index">
						<td>{{ rol.nombre }}</td>
						<td v-if="rol.estado == 1" class="text-success">Activo</td>
						<td v-else class="text-danger">Inactivo</td>
						<td>{{ rol.created_at }}</td>
						<td>{{ rol.updated_at }}</td>
						<td class="text-center">
							<router-link
								class="btn btn-sm btn-primary"
								title="Editar"
								:to="{
									name: 'roles.edit',
									params: { id: rol.id },
								}"
								><i class="fas fa-pencil-alt"></i
							></router-link>
							<button
								@click="eliminarRol(rol, index)"
								class="btn btn-sm btn-danger"
								title="Inactivar"
								v-if="rol.estado == 1"
							>
								<i class="fas fa-ban"></i>
							</button>
							<button
								@click="activarRol(rol, index)"
								class="btn btn-sm btn-success"
								title="Activar"
								v-if="rol.estado == 0"
							>
								<i class="fas fa-check"></i>
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
			roles: [],
		};
	},
	created() {
		this.axios.get("/api/roles").then((response) => {
			this.roles = response.data.data;
		});
	},
	methods: {
		activarRol(rol, index) {
			this.$swal({
				title: "¿Estás seguro?",
				text: "Se activará el rol: '" + rol.nombre + "'",
				icon: "warning",
				showCancelButton: true,
			}).then((result) => {
				if (result.value) {
					axios
						.delete("/api/roles/" + rol.id)
						.then((response) => {
							this.roles[index].estado = 1;
							this.roles.indexOf(index, 1);
							this.$swal({
								icon: "success",
								title: "Rol activado.",
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
		eliminarRol(rol, index) {
			this.$swal({
				title: "¿Estás seguro?",
				text: "Se inactivará el rol: '" + rol.nombre + "'",
				icon: "warning",
				showCancelButton: true,
			}).then((result) => {
				if (result.value) {
					axios
						.delete("/api/roles/" + rol.id)
						.then((response) => {
							this.roles[index].estado = 0;
							this.roles.indexOf(index, 0);
							this.$swal({
								icon: "success",
								title: "Rol inactivado.",
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
