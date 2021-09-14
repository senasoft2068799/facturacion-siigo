<template>
    <div class="card">
        <div class="card-header">Modificar documento</div>
        <div class="card-body">
            <form @submit.prevent="modificarDocumento">
                <div class="mb-3">
                    <label for="nombre" class="form-label"
                        >Nombre de documento</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        v-model="documento.nombre"
                    />
                </div>
                <button type="submit" class="btn btn-success">Modificar</button>
                <router-link
                    :to="{ name: 'documentos.index' }"
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
            documento: {
                nombre : null
            }
        };
    },
    created() {
        axios
            .get("/api/documentos/" + this.$route.params.id + "/edit")
            .then(res => {
                this.documento = res.data;
            })
    },
    methods: {
        modificarDocumento() {
            this.axios
                .put("/api/documentos/" + this.$route.params.id, this.documento)
                .then(response => {
                    this.$swal("Documento modificado correctamente.");
                    this.$router.push("/documentos");
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
