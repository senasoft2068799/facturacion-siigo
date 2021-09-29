<template>
    <div class="card">
        <div class="card-header">Modificar categoria</div>
        <div class="card-body">
            <form @submit.prevent="modificarCategoria">
                <div class="mb-3">
                    <label for="nombre" class="form-label"
                        >Nombre de la categoria</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        v-model="categoria.nombre"
                    />
                    <label for="descripcion" class="form-label"
                        >Descripción de la categoria</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="descripcion"
                        v-model="categoria.descripcion"
                    />
                </div>
                <button type="submit" class="btn btn-success">Modificar</button>
                <router-link
                    :to="{ name: 'categorias.index' }"
                    class="btn btn-secondary"
                    >Regresar</router-link
                >
            </form>
        </div>
    </div>
</template>
<<script>
export default {
    data() {
        return {
            categoria: {
                nombre: null,
                descripcion: null
            }
        };
    },
    created() {
        this.axios.get("/api/categorias/" + this.$route.params.id).then(res => {
            this.categoria = res.data;
        });
    },
    methods: {
        modificarCategoria() {
            this.axios
                .put("/api/categorias/" + this.$route.params.id, this.categoria)
                .then(response => {
                    this.$swal("Categoria modificada correctamente.");
                    this.$router.push("/categorias");
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
