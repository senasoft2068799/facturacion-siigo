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
					<hr />
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Imágen</th>
									<th>Funciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<select
											class="form-select"
											id="producto"
											v-model="producto"
										>
											<option disabled value="null">Seleccionar...</option>
											<option
												v-for="(item, index) in productos"
												:key="index"
												v-bind:value="item"
											>
												{{ item.nombre }}
											</option>
										</select>
									</td>
									<td>
										<a :href="producto.imagen"
											><img
												:src="producto.imagen"
												class="img-responsive"
												height="100"
												width="100"
										/></a>
									</td>
									<td>
										<button
											type="button"
											class="btn btn-success btn-sm"
											title="Agregar"
											@click="agregarProducto()"
										>
											<i class="fas fa-plus-circle"></i>
										</button>
									</td>
								</tr>
								<tr v-for="(item, index) in bodega.productos" :key="index">
									<td>
										{{ item.nombre }}
										<p
											class="text-danger"
											v-if="errors.has(`productos.${index}.id`)"
										>
											{{ errors.get(`productos.${index}.id`) }}
										</p>
									</td>
									<td>
										<a :href="item.imagen"
											><img
												:src="item.imagen"
												class="img-responsive"
												height="100"
												width="100"
										/></a>
									</td>
									<td>
										<button
											type="button"
											class="btn btn-danger btn-sm"
											title="Eliminar"
											@click="eliminarProducto(index)"
										>
											<i class="fas fa-times-circle"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<hr />
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-edit me-2"></i>Modificar</button>
				<router-link :to="{ name: 'bodegas.index' }" class="btn btn-dark"
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
			sucursales: [],
			productos: [],
			producto: {
				imagen: null,
			},
			bodega: {
				sucursale_id: null,
				productos: [],
			},
		};
	},
	mounted() {
		//Mostrar datos de bodega según su id
		this.axios.get("/api/bodegas/" + this.$route.params.id).then((res) => {
			this.bodega = res.data.data;
			this.bodega.sucursale_id = this.bodega.sucursal.id;
		});
		//Mostrar lista de sucursales
		this.axios.get("/api/sucursales").then((res) => {
			this.sucursales = res.data.data;
		});
		//Mostrar lista de productos
		this.axios.get("/api/productos").then((res) => {
			this.productos = res.data.data;
		});
	},
	methods: {
		modificarBodega() {
			this.axios
				.put("/api/bodegas/" + this.$route.params.id, this.bodega)
				.then((res) => {
					this.errors.clearAll();
					this.$swal("Bodega modificada correctamente.");
					this.$router.push("/bodegas/" + this.$route.params.id);
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
		agregarProducto() {
			this.bodega.productos.splice(0, 0, this.producto);
			this.producto = {
				imagen: null,
			};
		},
		eliminarProducto(index) {
			this.bodega.productos.splice(index, 1);
		},
	},
};
</script>