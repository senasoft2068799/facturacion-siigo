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
						v-model="movimiento.bodega.nombre"
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
						v-model="movimiento.bodega.direccion"
					/>
					<p class="text-danger" v-if="errors.has('direccion')">
						{{ errors.get("direccion") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="descripcion" class="form-label">Descripción</label>
					<textarea
						class="form-control"
						id="descripcion"
						rows="3"
						v-model="movimiento.descripcion"
					></textarea>
					<p class="text-danger" v-if="errors.has('descripcion')">
						{{ errors.get("descripcion") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="sucursal" class="form-label">Sucursal encargada</label>
					<select
						class="form-select"
						id="sucursal"
						v-model="movimiento.sucursale_id"
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
			movimiento: {
				sucursale_id: null,
				detalle_movimiento: {},
				bodega: {},
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
				.post("/api/bodegas", this.movimiento)
				.then((res) => {
					this.errors.clearAll();
					this.$swal("Bodega registrada correctamente.");
					this.movimiento = {
						sucursale_id: null,
						detalle_movimiento: {},
						bodega: {},
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
		// registrarMovimiento() {
		// 	this.movimiento.documento_id = 3;
		// 	this.movimiento.estado = 1;
		// 	this.axios
		// 		.post("/api/movimientos", this.movimiento)
		// 		.then((res) => {
		// 			this.movimiento = res.data;
		// 			// this.registrarDetalleMovimiento();
		// 		})
		// 		.catch((err) => {
		// 			this.errors.record(err.response.data.errors);
		// 		});
		// },
		/*    registrarDetalleMovimiento() {
      let detalleMovimiento = {
        movimiento_id: this.movimiento.id,
        bodega_id: this.bodega.id,
      };
      this.axios
        .post("/api/detalle-movimientos", detalleMovimiento)
        .then((res) => {
          this.$swal("Bodega registrada correctamente.");
          this.bodega = {};
          this.movimiento = {};
        })
        .catch((err) => {
          return err;
        });
    }, */
	},
};
</script>
