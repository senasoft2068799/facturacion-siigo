<template>
	<div class="card">
		<div class="card-header">Modificar producto</div>
		<div class="card-body">
			<form @submit.prevent="modificarProducto" enctype="multipart/form-data">
				<div class="mb-3">
					<figure>
						<center>
							<label for="imagen" class="form-label">Imagen del producto</label>
							<br />
							<img
								class="img-fluid img-thumbnail"
								width="250"
								height="250"
								:src="producto.imagen"
								alt="Imagen del producto"
							/>
						</center>
					</figure>
					<label for="nombre" class="form-label">Nombre del producto</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="producto.nombre"
					/>
					<label for="precio_unitario" class="form-label"
						>Precio del producto</label
					>
					<input
						type="number"
						class="form-control"
						id="precio_unitario"
						v-model="producto.precio_unitario"
					/>
					<div class="mb-3">
						<label for="categoria" class="form-label">Categoria</label>
						<select
							class="form-select"
							id="categoria"
							v-model="producto.categoria_id"
						>
							<option disabled value="null">Seleccionar categoria...</option>
							<option
								v-for="(categoria, index) in categorias"
								:key="index"
								v-bind:value="categoria.id"
							>
								{{ categoria.nombre }}
							</option>
						</select>
					</div>
					<label for="imagen" class="form-label">Imagen del producto</label>
					<input
						type="file"
						name="imagen"
						class="form-control"
						id="imagen"
						@change="obtener_imagen"
						accept="image/*"
					/>
					<center>
						<figure style="margin: 15px">
							<img
								class="img-thumbnail img-responsive rounded"
								width="250"
								height="250"
								:src="imagenMini"
								alt="Imagen del producto"
							/>
						</figure>
					</center>
				</div>
				<button type="submit" class="btn btn-success">Modificar</button>
				<router-link :to="{ name: 'productos.index' }" class="btn btn-secondary"
					>Regresar</router-link
				>
			</form>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			imagenMiniatura: "",
			producto: {
				nombre: null,
				precio_unitario: null,
				imagen: null,
				categoria_id: null,
				estado: null,
				bodegas: null,
			},
			categorias: [],
		};
	},
	mounted() {
		this.axios.get("/api/categorias").then((res) => {
			this.categorias = res.data.data;
		});
		this.axios.get("/api/productos/" + this.$route.params.id).then((res) => {
			this.producto = res.data.data;
		});
	},
	methods: {
		obtener_imagen(e) {
			//Cuando se carga la imagen se dispara este método
			let file = e.target.files[0]; //Esta variable nos permite guardar la información de la imagen
			this.producto.imagen = file; //Se almacena la imagen al producto
			this.cargarImagen(file); //Llamamos al método cargarImagen
		},
		cargarImagen(file) {
			//Método para la previsualización de la imagen
			let lector = new FileReader(); //Este método permite trabajar con archivos

			lector.onload = (e) => {
				//Este método nos permite cargar la información del archivo o imagen
				this.imagenMiniatura = e.target.result; //El resultado del archivo se guarda en la variable imagenMiniatura
			};

			lector.readAsDataURL(file); //Aquí, se lee la información del archivo o imagen (en este caso)
		},
		modificarProducto() {
			let producto = new FormData();
			for (let key in this.producto) {
				producto.append(key, this.producto[key]);
				producto.append("_method", "PUT");
			}
			this.axios
				.post("/api/productos/" + this.$route.params.id, producto)
				.then((response) => {
					this.$swal("Producto modificado correctamente.");
					this.$router.push("/productos");
				})
				.catch((err) => {
					this.$swal({
						icon: "error",
						title: "Ha ocurrido un error:\n" + err,
					});
				});
		},
	},
	computed: {
		imagenMini() {
			return this.imagenMiniatura; //Esta variable se retorna en el formulario mostrando una prevista de la imagen a cargar
		},
	},
};
</script>
