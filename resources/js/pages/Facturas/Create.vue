<template>
	<div class="card mb-3">
		<div class="card-header">Registrar factura</div>
		<div class="card-body">
			<form @submit.prevent="registrarFactura()">
				<!-- Encabezado factura (Sucursal, cliente) -->
				<div class="row mb-3">
					<div class="col-md-6">
						<label for="sucursal" class="form-label">Sucursal</label>
						<select
							class="form-select"
							id="sucursal"
							v-model="factura.sucursale_id"
							@blur="guardarBorradorFactura()"
						>
							<option disabled value="null">Seleccionar sucursal...</option>
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
					<div class="col-md-6">
						<label for="cliente" class="form-label">Cliente</label>
						<select
							class="form-select"
							id="cliente"
							v-model="factura.user_id"
							@blur="guardarBorradorFactura()"
						>
							<option disabled value="null">Seleccionar cliente...</option>
							<option
								v-for="(item, index) in clientes"
								:key="index"
								v-bind:value="item.id"
							>
								{{ item.nombre }} {{ item.apellido }}
							</option>
						</select>
						<div class="text-danger" v-if="errors.has('user_id')">
							{{ errors.get("user_id") }}
						</div>
					</div>
				</div>
				<hr />
				<!-- Fin encabezado -->
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<!-- Encabezado tabla -->
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Bodega</th>
								<th>Precio</th>
								<th>Subtotal</th>
								<th>IVA <small>(19%)</small></th>
								<th>Total</th>
								<th>Funciones</th>
							</tr>
						</thead>
						<!-- Fin encabezado tabla -->
						<!-- Cuerpo tabla -->
						<tbody>
							<!-- Inputs registro detalles -->
							<tr>
								<td>
									<select
										class="form-select"
										id="producto"
										v-model="detalleFactura.producto"
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
									<input
										type="number"
										class="form-control"
										id="cantidad"
										v-model="detalleFactura.cantidad"
									/>
								</td>
								<td>
									<select
										class="form-select"
										id="bodega"
										v-model="detalleFactura.bodega"
									>
										<option disabled value="null">Seleccionar...</option>
										<option
											v-for="(item, index) in bodegas"
											:key="index"
											v-bind:value="item"
										>
											{{ item.nombre }}
										</option>
									</select>
								</td>
								<td>
									{{
										formatters.formatCurrency(
											detalleFactura.producto.precio_unitario
										)
									}}
								</td>
								<td>
									{{
										formatters.formatCurrency(
											detalleFactura.producto.precio_unitario *
												detalleFactura.cantidad
										)
									}}
								</td>
								<td>
									{{
										formatters.formatCurrency(
											detalleFactura.producto.precio_unitario *
												detalleFactura.cantidad *
												0.19
										)
									}}
								</td>
								<td>
									{{
										formatters.formatCurrency(
											detalleFactura.producto.precio_unitario *
												detalleFactura.cantidad *
												1.19
										)
									}}
								</td>
								<td v-if="editing == null">
									<button
										type="button"
										class="btn btn-success btn-sm"
										title="Agregar"
										@click="agregarDetalleFactura()"
									>
										<i class="fas fa-plus-circle"></i>
									</button>
									<button
										type="button"
										class="btn btn-secondary btn-sm"
										title="Limpiar"
										@click="limpiarDetalleFactura()"
									>
										<i class="fas fa-eraser"></i>
									</button>
								</td>
								<td v-else>
									<button
										type="button"
										class="btn btn-success btn-sm"
										title="Confirmar edición"
										@click="editarDetalleFactura()"
									>
										<i class="fas fa-check-circle"></i>
									</button>
									<button
										type="button"
										class="btn btn-danger btn-sm"
										title="Cancelar"
										@click="cancelarEdicion()"
									>
										<i class="fas fa-times-circle"></i>
									</button>
								</td>
							</tr>
							<!-- Fin inputs registro detalles -->
							<!-- Todos los detalles (items) de factura -->

							<tr v-for="(item, index) in factura.items" :key="index">
								<td>
									{{ item.producto.nombre }}
									<p
										class="text-danger"
										v-if="errors.has(`items.${index}.producto.id`)"
									>
										{{ errors.get(`items.${index}.producto.id`) }}
									</p>
								</td>
								<td>
									{{ item.cantidad }}
									<p
										class="text-danger"
										v-if="errors.has(`items.${index}.cantidad`)"
									>
										{{ errors.get(`items.${index}.cantidad`) }}
									</p>
								</td>
								<td>
									{{ item.bodega.nombre }}
									<p
										class="text-danger"
										v-if="errors.has(`items.${index}.bodega.id`)"
									>
										{{ errors.get(`items.${index}.bodega.id`) }}
									</p>
								</td>
								<td>
									{{ formatters.formatCurrency(item.producto.precio_unitario) }}
								</td>
								<td>
									{{
										formatters.formatCurrency(
											item.producto.precio_unitario * item.cantidad
										)
									}}
								</td>
								<td>
									{{
										formatters.formatCurrency(
											item.producto.precio_unitario * item.cantidad * 0.19
										)
									}}
								</td>
								<td>
									{{ formatters.formatCurrency(item.valor_total) }}
								</td>
								<td>
									<button
										type="button"
										class="btn btn-warning btn-sm text-white"
										title="Editar"
										@click="iniciarEdicion(item, index)"
									>
										<i class="fas fa-edit"></i>
									</button>
									<button
										type="button"
										class="btn btn-danger btn-sm"
										title="Eliminar"
										@click="eliminarDetalleFactura(item, index)"
									>
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>

							<!-- Fin todos los detalles de factura -->
						</tbody>
						<!-- Fin cuerpo tabla -->
						<!-- Footer tabla -->
						<tfoot v-if="factura.items.length > 0">
							<tr class="table-active">
								<td colspan="5"></td>
								<td><h6>Subtotal:</h6></td>
								<th>
									<h6>
										{{ formatters.formatCurrency(calcularTotal() / 1.19) }}
									</h6>
								</th>
								<td></td>
							</tr>
							<tr class="table-active">
								<td colspan="5"></td>
								<td>
									<h6>IVA <small>(19%)</small>:</h6>
								</td>
								<th>
									<h6>
										{{
											formatters.formatCurrency((calcularTotal() / 1.19) * 0.19)
										}}
									</h6>
								</th>
								<td></td>
							</tr>
							<tr class="table-active">
								<td colspan="5"></td>
								<td><h5>Total:</h5></td>
								<th>
									<h5>
										{{ formatters.formatCurrency(calcularTotal()) }}
									</h5>
								</th>
								<td></td>
							</tr>
						</tfoot>
						<!-- Fin footer tabla -->
					</table>
				</div>
				<p class="text-danger" v-if="errors.has('items')">
					{{ errors.get("items") }}
				</p>
				<hr />
				<!-- Descripcion factura -->
				<div class="mb-3">
					<label for="descripcion" class="form-label">Descripción</label>
					<textarea
						class="form-control"
						id="descripcion"
						rows="3"
						v-model="factura.descripcion"
						@blur="guardarBorradorFactura()"
					></textarea>
					<p class="text-danger" v-if="errors.has('descripcion')">
						{{ errors.get("descripcion") }}
					</p>
				</div>
				<!-- Fin descripcion -->
				<!-- Botones -->
				<button type="submit" class="btn btn-primary"><i class="fas fa-check me-2"></i>Registrar</button>
				<router-link
					class="btn btn-dark"
					@click.native="limpiarFactura()"
					:to="{ name: 'facturas.index' }"
					><i class="fas fa-arrow-alt-circle-left me-2"></i>Cancelar</router-link
				>
				<!-- Fin botones -->
			</form>
		</div>
	</div>
</template>

<script>
import Errors from "../../utilities/Errors.js";
import Storage from "../../utilities/Storage.js";
import Formatters from "../../utilities/Formatters.js";
export default {
	data() {
		return {
			formatters: new Formatters(),
			errors: new Errors(),
			editing: null,
			sucursales: [],
			clientes: [],
			productos: [],
			bodegas: [],
			factura: {
				sucursale_id: null,
				user_id: null,
				items: [],
			},
			detalleFactura: {
				bodega: null,
				producto: {},
			},
		};
	},
	mounted() {
		//Mostrar lista de sucursales
		this.axios.get("/api/sucursales").then((res) => {
			this.sucursales = res.data.data;
		});
		//Mostrar lista de clientes
		this.axios.get("/api/users").then((res) => {
			this.clientes = res.data.data;
		});
		//Mostrar lista de productos
		this.axios.get("/api/productos").then((res) => {
			this.productos = res.data.data;
		});
		//Mostrar lista de bodegas
		this.axios.get("/api/bodegas").then((res) => {
			this.bodegas = res.data.data;
		});
		//Borrador de factura
		if (Storage.has("factura")) {
			try {
				this.factura = Storage.get("factura");
			} catch (err) {
				this.limpiarFactura();
			}
		}
	},
	methods: {
		calcularTotal() {
			let valor = 0;
			this.factura.items.forEach((item) => {
				valor += item.valor_total;
			});
			return valor;
		},
		agregarDetalleFactura() {
			let valorDetalle =
				this.detalleFactura.producto.precio_unitario *
				this.detalleFactura.cantidad *
				1.19;
			this.detalleFactura.valor_total = valorDetalle;
			this.factura.items.splice(0, 0, this.detalleFactura);
			this.factura.valor_total += valorDetalle;
			this.limpiarDetalleFactura();
			this.guardarBorradorFactura();
		},
		eliminarDetalleFactura(item, index) {
			this.factura.items.splice(index, 1);
			this.factura.valor_total -= item.valor_total;
			this.guardarBorradorFactura();
		},
		iniciarEdicion(item, index) {
			this.editing = index;
			this.detalleFactura = item;
		},
		editarDetalleFactura() {
			this.factura.items.splice(this.editing, 1, this.detalleFactura);
			this.guardarBorradorFactura();
			this.cancelarEdicion();
		},
		cancelarEdicion() {
			this.editing = null;
			this.limpiarDetalleFactura();
		},
		registrarFactura() {
			this.factura.documento_id = 1;
			this.factura.valor_total = this.calcularTotal();
			this.factura.estado = 1;

			this.axios
				.post("/api/facturas", this.factura)
				.then((res) => {
					this.errors.clearAll();
					this.$swal("Factura registrada correctamente.");
					this.limpiarFactura();
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
		guardarBorradorFactura() {
			Storage.record("factura", this.factura);
		},
		limpiarDetalleFactura() {
			this.detalleFactura = {
				bodega: {},
				producto: {},
			};
		},
		limpiarFactura() {
			this.limpiarDetalleFactura();
			this.factura = {
				sucursale_id: null,
				user_id: null,
				items: [],
			};
			Storage.remove("factura");
		},
	},
};
</script>