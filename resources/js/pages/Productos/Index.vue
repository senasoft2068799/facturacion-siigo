<template>
    <div>
        <router-link
            class="btn btn-success mb-3"
            :to="{ name: 'productos.create' }"
            >Registrar producto</router-link
        >
        <router-link
            class="btn btn-info mb-3"
            style="float: right;"
            :to="{ name: 'categorias.index' }"
            >Ver categorias</router-link
        >   
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
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
                        <td> <a :href="producto.imagen"><img :src="producto.imagen" class="img-responsive" height="100" width="100"></a></td>
                        <td>{{ producto.categoria.nombre }}</td>
                        <td>{{ producto.created_at }}</td>
                        <td>{{ producto.updated_at }}</td>
                        <td>
                            <router-link
                                class="btn btn-warning btn-sm"
                                :to="{
                                    name: 'productos.edit',
                                    params: { id: producto.id }
                                }"
                                >Editar</router-link
                            >
                            <button
                                @click="eliminarproducto(producto, index)"
                                class="btn btn-danger btn-sm"
                            >
                                Eliminar
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
            productos: []
        };
    },
    created() {
        this.axios.get("/api/productos").then(response => {
            this.productos = response.data.data;
        });
    },
    methods: {
        eliminarproducto(producto, index) {
            this.$swal({
                title: "¿Estás seguro?",
                text: "Se eliminará el producto: '" + producto.nombre + "'",
                icon: "warning",
                showCancelButton: true
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/productos/" + producto.id)
                        .then(response => {
                            this.productos.splice(index, 1);
                            this.$swal({
                                icon: "success",
                                title: "Producto eliminado."
                            });
                        })
                        .catch(err => {
                            this.$swal({
                                icon: "error",
                                title: "Ha ocurrido un error:\n" + err
                            });
                        });
                }
            });
        }
    }
};
</script>
