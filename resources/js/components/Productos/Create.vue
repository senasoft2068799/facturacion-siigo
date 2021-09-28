<template>
    <div class="card">
        <div class="card-header">Registrar Categoria</div>
        <div class="card-body">
            <form @submit.prevent="registrarCategoria">
                <div class="mb-3">
                    <label for="nombre" class="form-label"
                        >Nombre de la categoría</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        v-model="categoria.nombre"
                    />
                    <label for="descripcion" class="form-label"
                        >Descripción de la categoría</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="descripcion"
                        v-model="categoria.descripcion"
                    />
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <router-link
                    :to="{ name: 'categorias.index' }"
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
            categoria: {
                nombre: "",
                descripcion: ""
            }
        };
    },
    methods: {
        registrarCategoria() {
            const params = {
                nombre: this.categoria.nombre,
                descripcion: this.categoria.descripcion
            };
            this.axios
                .post("/api/categorias", params)
                .then(response => {
                    this.$swal("Categoría registrada correctamente.");
					this.categoria.nombre = "",
                    this.categoria.descripcion = ""
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
