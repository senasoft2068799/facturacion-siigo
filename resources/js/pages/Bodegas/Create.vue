<template>
	<div class="card">
		<div class="card-header">Registrar bodega</div>
		<div class="card-body">
			<form @submit.prevent="registrarBodega()">
				<div class="mb-3">
					<label for="nombre" class="form-label">Nombre de bodega</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="bodega.nombre"
					/>
					<p class="text-danger" v-if="errors.has('nombre')">
						{{ errors.get("nombre") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="nombre" class="form-label">Dirección</label>
					<input
						type="text"
						class="form-control"
						id="direccion"
						v-model="bodega.direccion"
					/>
					<p class="text-danger" v-if="errors.has('direccion')">
						{{ errors.get("direccion") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="sucursal" class="form-label">Sucursal encargada</label>
					<select
						class="form-select"
						id="sucursal"
						v-model="bodega.sucursale_id"
					>
						<option disabled value="null">Seleccionar...</option>
						<option
							v-for="(item, index) in sucursales"
							:key="index"
							v-bind:value="item.id"
						>
							{{ item.nombre }}
						</option>
					</select>
					<p class="text-danger" v-if="errors.has('sucursale_id')">
						{{ errors.get("sucursale_id") }}
					</p>
				</div>
				<button type="submit" class="btn btn-success">Registrar</button>
				<router-link :to="{ name: 'bodegas.index' }" class="btn btn-secondary"
					>Regresar</router-link
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
			sucursales: [],
			bodega: {
				sucursale_id: null,
			},
		};
	},
	mounted() {
		//Mostrar lista de sucursales
		this.axios.get("/api/sucursales").then((res) => {
			this.sucursales = res.data.data;
		});
	},
	methods: {
		registrarBodega() {
			this.axios
				.post("/api/bodegas", this.bodega)
				.then((res) => {
					this.$swal("Bodega registrada correctamente.");
					this.errors.clearAll();
					this.bodega = {
						sucursale_id: null,
					};
				})
				.catch((err) => {
					this.$swal({
						icon: "error",
						title: "Ha ocurrido un error:\n" + err,
					});
					this.errors.record(err.response.data.errors);
				});
		},
	},
};
</script>
