<template>
	<div class="card">
		<div class="card-header">Modificar sucursal</div>
		<div class="card-body">
			<form @submit.prevent="modificarSucursal()">
				<div class="mb-3">
					<label for="nombre" class="form-label">Nombre de sucursal</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="sucursal.nombre"
					/>
					<p class="text-danger" v-if="errors.has('nombre')">
						{{ errors.get("nombre") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="direccion" class="form-label">Dirección</label>
					<input
						type="text"
						class="form-control"
						id="direccion"
						v-model="sucursal.direccion"
					/>
					<p class="text-danger" v-if="errors.has('direccion')">
						{{ errors.get("direccion") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="telefono" class="form-label">Teléfono</label>
					<input
						type="tel"
						class="form-control"
						id="telefono"
						v-model="sucursal.telefono"
					/>
					<p class="text-danger" v-if="errors.has('telefono')">
						{{ errors.get("telefono") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="ciudad" class="form-label">Ciudad</label>
					<select class="form-select" id="ciudad" v-model="sucursal.ciudade_id">
						<option disabled value="null">Seleccionar ciudad...</option>
						<option
							v-for="(item, index) in ciudades"
							:key="index"
							v-bind:value="item.id"
						>
							{{ item.nombre }}
						</option>
					</select>
					<p class="text-danger" v-if="errors.has('ciudade_id')">
						{{ errors.get("ciudade_id") }}
					</p>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-edit me-2"></i>Modificar</button>
				<router-link
					:to="{ name: 'sucursales.index' }"
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
			sucursal: {
				nombre: null,
				direccion: null,
				telefono: null,
				ciudade_id: null,
			},
			ciudades: [],
		};
	},
	mounted() {
		this.axios.get("/api/ciudades").then((res) => {
			this.ciudades = res.data;
		});
		this.axios.get("/api/sucursales/" + this.$route.params.id).then((res) => {
			this.sucursal = res.data;
		});
	},
	methods: {
		modificarSucursal() {
			this.axios
				.put("/api/sucursales/" + this.$route.params.id, this.sucursal)
				.then((response) => {
					this.errors.clearAll();
					this.$swal("Sucursal modificada correctamente.");
					this.$router.push("/sucursales");
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
