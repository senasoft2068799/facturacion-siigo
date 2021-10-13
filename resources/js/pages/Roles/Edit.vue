<template>
	<div class="card">
		<div class="card-header">Modificar rol</div>
		<div class="card-body">
			<form @submit.prevent="modificarRol()">
				<div class="mb-3">
					<label for="nombre" class="form-label">Nombre de rol</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="rol.nombre"
					/>
					<p class="text-danger" v-if="errors.has('nombre')">
						{{ errors.get("nombre") }}
					</p>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-edit me-2"></i>Modificar</button>
				<router-link :to="{ name: 'roles.index' }" class="btn btn-dark"
					><i class="fas fa-arrow-alt-circle-left me-2"></i>Regresar</router-link
				>
			</form>
		</div>
	</div>
</template>
<script>
import Errors from "../../utilities/Errors.js";
export default {
	data() {
		return {
			errors: new Errors(),
			rol: {
				nombre: null,
			},
		};
	},
	created() {
		axios.get("/api/roles/" + this.$route.params.id).then((res) => {
			this.rol = res.data;
		});
	},
	methods: {
		modificarRol() {
			this.axios
				.put("/api/roles/" + this.$route.params.id, this.rol)
				.then((response) => {
					this.errors.clearAll();
					this.$swal("Rol modificado correctamente.");
					this.$router.push("/roles");
				})
				.catch((err) => {
					if (err.response.status === 422) {
						this.errors.record(err.response.data.errors);
						this.$swal({
							icon: "error",
							title: "Los campos ingresados no son válidos.",
						});
					} else {
						this.$swal({
							icon: "error",
							title: "Ha ocurrido un error:\n" + err,
						});
					}
				});
		},
	},
};
</script>
