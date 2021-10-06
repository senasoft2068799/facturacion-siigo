<template>
	<div>
		<router-link class="btn btn-primary mb-3" :to="{ name: 'usuarios.create' }"
			><i class="fas fa-user me-2"></i>Registrar Usuario</router-link
		>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="table-dark text-center">
					<tr>
						<th>Nombre Completo</th>
						<th>Email</th>
						<th>Número de Teléfono</th>
						<th>Rol</th>
						<th>Funciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(user, index) in users" :key="index">
						<td>{{ user.nombre }} {{ user.apellido }}</td>
						<td>{{ user.email }}</td>
						<td>{{ user.telefono }}</td>
						<td>{{ user.rol.nombre }}</td>
						<td class="text-center">
							<router-link
								class="btn btn-warning btn-sm"
								:to="{
									name: 'usuarios.edit',
									params: { id: user.id },
								}"
								>Editar</router-link
							>
							<button
								@click="eliminarUsuario(user, index)"
								class="btn btn-danger btn-sm"
							>
								Eliminar
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
			users: [],
		};
	},
	created() {
		this.axios.get("/api/users").then((response) => {
			this.users = response.data.data;
		});
	},
	methods: {
		eliminarUsuario(user, index) {
			this.$swal({
				title: "¿Estás seguro?",
				text: "Se eliminará el usuario: '" + user.name + "'",
				icon: "warning",
				showCancelButton: true,
			}).then((result) => {
				if (result.value) {
					axios
						.delete("/api/users/" + user.id)
						.then((response) => {
							this.users.splice(index, 1);
							this.$swal({
								icon: "success",
								title: "Usuario eliminado.",
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