<template>
	<div class="card">
		<div class="card-header">Modificar categoría</div>
		<div class="card-body">
			<form @submit.prevent="modificarCategoria()">
				<div class="mb-3">
					<label for="nombre" class="form-label">Nombre de categoría</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="categoria.nombre"
					/>
					<p class="text-danger" v-if="errors.has('nombre')">
						{{ errors.get("nombre") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="descripcion" class="form-label">Descripción</label>
					<input
						type="text"
						class="form-control"
						id="descripcion"
						v-model="categoria.descripcion"
					/>
					<p class="text-danger" v-if="errors.has('descripcion')">
						{{ errors.get("descripcion") }}
					</p>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt me-2"></i>Modificar</button>
				<router-link
					:to="{ name: 'categorias.index' }"
					class="btn btn-secondary"
					><i class="fas fa-arrow-left me-2"></i>Regresar</router-link
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
			categoria: {
				nombre: null,
				descripcion: null,
			},
		};
	},
	created() {
		this.axios.get("/api/categorias/" + this.$route.params.id).then((res) => {
			this.categoria = res.data;
		});
	},
	methods: {
		modificarCategoria() {
			this.axios
				.put("/api/categorias/" + this.$route.params.id, this.categoria)
				.then((response) => {
					this.errors.clearAll();
					this.$swal("Categoría modificada correctamente.");
					this.$router.push("/categorias");
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
