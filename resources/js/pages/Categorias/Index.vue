<template>
    <div>
        <router-link
            class="btn btn-primary mb-3"
            :to="{ name: 'categorias.create' }"
            >Registrar categoria</router-link
        >
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(categoria, index) in categorias" :key="index">
                        <td>{{ categoria.nombre }}</td>
                        <td>{{ categoria.descripcion }}</td>
                        <td>{{ categoria.created_at }}</td>
                        <td>{{ categoria.updated_at }}</td>
                        <td>
                            <router-link
                                class="btn btn-warning btn-sm"
                                :to="{
                                    name: 'categorias.edit',
                                    params: { id: categoria.id }
                                }"
                                >Editar</router-link
                            >
                            <button
                                @click="eliminarcategoria(categoria, index)"
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
            categorias: []
        };
    },
    created() {
        this.axios.get("/api/categorias").then(response => {
            this.categorias = response.data.data;
        });
    },
    methods: {
        eliminarcategoria(categoria, index) {
            this.$swal({
                title: "¿Estás seguro?",
                text: "Se eliminará la categoria: '" + categoria.nombre + "'",
                icon: "warning",
                showCancelButton: true
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/categorias/" + categoria.id)
                        .then(response => {
                            this.categorias.splice(index, 1);
                            this.$swal({
                                icon: "success",
                                title: "categoria eliminada."
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
