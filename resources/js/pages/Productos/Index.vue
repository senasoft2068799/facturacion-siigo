<template>
	<div>
		<router-link class="btn btn-success mb-3" :to="{ name: 'productos.create' }"
			>Registrar producto</router-link
		>
		<router-link
			class="btn btn-secondary mb-3"
			style="float: right"
			:to="{ name: 'categorias.index' }"
			>Ver categorias</router-link
		>
		<button
			type="button"
			class="btn btn-secondary mb-3"
			data-bs-toggle="modal"
			data-bs-target="#exampleModal"
		>
			Importar
		</button>
		<div
			class="modal fade"
			id="exampleModal"
			tabindex="-1"
			aria-labelledby="exampleModalLabel"
			aria-hidden="true"
		>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<label for="file" class="form-label"
							><b>Importar productos</b></label
						>
						<button
							type="button"
							class="btn-close"
							data-bs-dismiss="modal"
							aria-label="Close"
						></button>
					</div>
					<div class="modal-body">
						<form style="margin: 15px">
							<div class="input-group">
								<input
									type="file"
									name="file"
									class="form-control"
									id="inputGroupFile04"
									aria-describedby="inputGroupFileAddon04"
									aria-label="Upload"
									ref="file"
									v-on:change="obtener_archivo()"
									required
									accept=".XLSX, .CSV"
								/>
								<input
									type="submit"
									v-on:click="eventoSubir()"
									class="btn btn-secondary"
									id="inputGroupFileAddon04"
									value="Subir"
								/>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-secondary"
							data-bs-dismiss="modal"
						>
							Cerrar
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="box" style="float: right">
			<input type="checkbox" id="check" />
			<div class="search-box">
				<form>
					<input
						type="text"
						placeholder="Escribe el nombre del producto"
						aria-label="Search"
						v-model="buscador"
						@keyup="buscarProductos"
					/>
					<label for="check" class="icon">
						<i class="fas fa-search"></i>
					</label>
				</form>
			</div>
		</div>
		<br /><br />
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="table-dark text-center">
					<tr>
						<th>Nombre</th>
						<th>Precio unitario</th>
						<th>Imagen del producto</th>
						<th>Categoria</th>
						<th>Fecha de creación</th>
						<th>Fecha de modificación</th>
						<th>Funciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(producto, index) in productos" :key="index">
						<td>{{ producto.nombre }}</td>
						<td>{{ producto.precio_unitario }}</td>
						<td>
							<a :href="producto.imagen"
								><img
									:src="producto.imagen"
									class="img-responsive rounded"
									height="130"
									width="140"
							/></a>
						</td>
						<td>{{ producto.categoria.nombre }}</td>
						<td>{{ producto.created_at }}</td>
						<td>{{ producto.updated_at }}</td>
						<td>
							<router-link
								class="btn btn-primary btn-sm"
								title="Editar"
								:to="{
									name: 'productos.edit',
									params: { id: producto.id },
								}"
								><i class="fas fa-pencil-alt"></i>
							</router-link>
							<button
								@click="eliminarproducto(producto, index)"
								class="btn btn-danger btn-sm"
								title="Eliminar"
							>
								<i class="fas fa-trash"></i>
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
			file: "",
			buscador: "",
			setTimeoutBuscador: "",
			productos: [],
		};
	},
	created() {
		if (this.buscador == "") {
			this.axios.get("/api/productos").then((response) => {
				this.productos = response.data.data;
			});
		} else {
			this.traerProductos();
		}
	},
	methods: {
		obtener_archivo() {
			this.file = this.$refs.file.files[0];
		},
		eventoSubir() {
			let formData = new FormData();
			formData.append("file", this.file);
			axios
				.post("/api/import-excel-productos/", formData, {
					headers: {
						"Content-Type": "multipart/form-data",
					},
				})
				.then((response) => {
					this.$swal({
						icon: "success",
						title: "Importación exitosa.",
					});
				})
				.catch((err) => {
					this.$swal({
						icon: "error",
						title: "Ha ocurrido un error:\n" + err,
					});
				});
		},
		eliminarproducto(producto, index) {
			this.$swal({
				title: "¿Estás seguro?",
				text: "Se eliminará el producto: '" + producto.nombre + "'",
				icon: "warning",
				showCancelButton: true,
			}).then((result) => {
				if (result.value) {
					axios
						.delete("/api/productos/" + producto.id)
						.then((response) => {
							this.productos.splice(index, 1);
							this.$swal({
								icon: "success",
								title: "Producto eliminado.",
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
		traerProductos() {
			axios
				.get("/api/producto", {
					params: {
						buscador: this.buscador,
					},
				})
				.then((response) => {
					this.productos = response.data.data;
					// console.log(response.data);
				})
				.catch((error) => {
					console.log(error.response);
				});
		},
		buscarProductos() {
			clearTimeout(this.setTimeoutBuscador);
			this.setTimeoutBuscador = setTimeout(this.traerProductos, 360);
		},
	},
};
</script>