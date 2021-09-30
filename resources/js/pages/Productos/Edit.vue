<template>
    <div class="card">
        <div class="card-header">Modificar producto</div>
        <div class="card-body">
            <form @submit.prevent="modificarProducto">
                <div class="mb-3">
                    <label for="nombre" class="form-label"
                        >Nombre del producto</label
                    >
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
                        type="double"
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
                            <option disabled value="null"
                                >Seleccionar categoria...</option
                            >
                            <option
                                v-for="(categoria, index) in categorias"
                                :key="index"
                                v-bind:value="categoria.id"
                                >{{ categoria.nombre }}</option
                            >
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Modificar</button>
                <router-link
                    :to="{ name: 'productos.index' }"
                    class="btn btn-secondary"
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
            producto: {
                nombre: null,
                precio_unitario: null,
                categoria_id: null
            },
            categorias: []
        };
    },
    created() {
        this.axios.get("/api/categorias").then(res => {
            this.categorias = res.data;
        });
        axios.get("/api/productos/" + this.$route.params.id).then(res => {
            this.producto = res.data;
        });
    },
    methods: {
        modificarProducto() {
            this.axios
                .put("/api/productos/" + this.$route.params.id, this.producto)
                .then(response => {
                    this.$swal("Producto modificado correctamente.");
                    this.$router.push("/productos");
                })
                .catch(err => {
                    this.$swal({
                        icon: "error",
                        title: "Ha ocurrido un error:\n" + err
                    });
                });
        }
    }
};
</script>
