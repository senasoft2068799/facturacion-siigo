<template>
	<div class="card">
		<div class="card-header">Modificar bodega</div>
		<div class="card-body">
			<form @submit.prevent="modificarBodega()">
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
				<button type="submit" class="btn btn-success">Modificar</button>
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
		//Mostrar datos de bodega según su id
		this.axios.get("/api/bodegas/" + this.$route.params.id).then((res) => {
			this.bodega = res.data;
		});
	},
	methods: {
		modificarBodega() {
			this.axios
				.put("/api/bodegas/" + this.$route.params.id, this.bodega)
				.then((res) => {
					this.$swal("Bodega modificada correctamente.");
					this.$router.push("/bodegas/" + this.$route.params.id);
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