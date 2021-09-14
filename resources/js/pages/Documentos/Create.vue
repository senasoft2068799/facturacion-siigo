<template>
    <div class="card">
        <div class="card-header">Registrar documento</div>
        <div class="card-body">
            <form @submit.prevent="registrarDocumento">
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
                <button type="submit" class="btn btn-success">Registrar</button>
                <router-link
                    :to="{ name: 'documentos.index' }"
                    class="btn btn-secondary"
                    >Regresar</router-link
                >
            </form>
            {{ documento.nombre }}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            documento: {
                nombre: ""
            }
        };
    },
    methods: {
        registrarDocumento() {
            const params = {
                nombre: this.documento.nombre
            };
            this.axios
                .post("/api/documentos", params)
                .then(response => {
                    this.$swal("Documento registrado correctamente.");
					this.documento.nombre = ""
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
