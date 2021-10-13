<template>
	<div class="card">
		<div class="card-header">Registrar categoría</div>
		<div class="card-body">
			<form @submit.prevent="registrarCategoria()">
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
				<button type="submit" class="btn btn-primary"><i class="fas fa-check me-2"></i>Registrar</button>
				<router-link
					:to="{ name: 'categorias.index' }"
					class="btn btn-dark"
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
			categoria: {
				nombre: null,
				descripcion: null,
			},
		};
	},
	methods: {
		registrarCategoria() {
			const params = {
				nombre: this.categoria.nombre,
				descripcion: this.categoria.descripcion,
			};
			this.axios
				.post("/api/categorias", params)
				.then((response) => {
					this.errors.clearAll();
					this.$swal("Categoría registrada correctamente.");
					this.categoria = {
						nombre: null,
						descripcion: null,
					};
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
