<template>
	<div class="card">
		<div class="card-header">Registrar producto</div>
		<div class="card-body">
			<form @submit.prevent="registrarProducto" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="nombre" class="form-label">Nombre del producto</label>
					<input
						type="text"
						class="form-control"
						id="nombre"
						v-model="producto.nombre"
					/>
					<p class="text-danger" v-if="errors.has('nombre')">
						{{ errors.get("nombre") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="precio" class="form-label">Precio unitario</label>
					<input
						type="number"
						class="form-control"
						id="precio"
						v-model="producto.precio_unitario"
					/>
					<p class="text-danger" v-if="errors.has('precio_unitario')">
						{{ errors.get("precio_unitario") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="categoria" class="form-label">Categoría</label>
					<select
						class="form-select"
						id="categoria"
						v-model="producto.categoria_id"
					>
						<option disabled value="">Seleccionar categoria...</option>
						<option
							v-for="(categoria, index) in categorias"
							:key="index"
							v-bind:value="categoria.id"
						>
							{{ categoria.nombre }}
						</option>
					</select>
					<p class="text-danger" v-if="errors.has('categoria_id')">
						{{ errors.get("categoria_id") }}
					</p>
				</div>
				<div class="mb-3">
					<label for="imagen" class="form-label">Imágen del producto</label>
					<input
						type="file"
						name="imagen"
						class="form-control"
						id="imagen"
						@change="obtener_imagen"
						accept="image/*"
					/>
					<p class="text-danger" v-if="errors.has('imagen')">
						{{ errors.get("imagen") }}
					</p>
					<center v-if="this.producto.imagen">
						<figure style="margin: 15px">
							<img
								class="img-thumbnail img-responsive rounded"
								width="250"
								height="250"
								:src="imagenMini"
								alt="Imágen del producto"
							/>
						</figure>
					</center>
				</div>
				<button type="submit" class="btn btn-success">Registrar</button>
				<router-link :to="{ name: 'productos.index' }" class="btn btn-secondary"
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
			imagenMiniatura: "",
			producto: {
				nombre: "",
				precio_unitario: "",
				imagen: "",
				categoria_id: "",
			},
			categorias: [],
		};
	},
	mounted() {
		this.axios.get("/api/categorias").then((res) => {
			this.categorias = res.data.data;
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
		registrarProducto() {
			let producto = new FormData();
			for (let key in this.producto) {
				producto.append(key, this.producto[key]);
			}
			this.axios
				.post("/api/productos", producto)
				.then((response) => {
					this.errors.clearAll();
					this.$swal("Producto registrado correctamente.");
					this.producto.nombre = null;
					this.producto.precio_unitario = null;
					this.producto.imagen = null;
					this.producto.categoria_id = null;
					this.imagenMiniatura = null;
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
	computed: {
		imagenMini() {
			return this.imagenMiniatura; //Esta variable se retorna en el formulario mostrando una prevista de la imagen a cargar
		},
	},
};
</script>
