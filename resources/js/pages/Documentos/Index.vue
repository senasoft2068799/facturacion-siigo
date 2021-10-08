<template>
  <div>
    <router-link
      class="btn btn-primary mb-3"
      :to="{ name: 'documentos.create' }"
      >Registrar documento</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nombre</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(documento, index) in documentos" :key="index">
            <td>{{ documento.nombre }}</td>
            <td>{{ documento.created_at }}</td>
            <td>{{ documento.updated_at }}</td>
            <td class="text-center">
              <router-link
                class="btn btn-sm btn-primary"
                title="Editar"
                :to="{
                  name: 'documentos.edit',
                  params: { id: documento.id },
                }"
                ><i class="fas fa-pencil-alt"></i
              ></router-link>
              <button
                @click="eliminarDocumento(documento, index)"
                class="btn btn-sm btn-danger"
                title="Inactivar"
              >
                <i class="fas fa-ban"></i>
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
      documentos: [],
    };
  },
  created() {
    this.axios.get("/api/documentos").then((response) => {
      this.documentos = response.data;
    });
  },
  methods: {
    eliminarDocumento(documento, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se eliminará el documento: '" + documento.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/documentos/" + documento.id)
            .then((response) => {
              this.documentos.splice(index, 1);
              this.$swal({
                icon: "success",
                title: "Documento eliminado.",
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
  },
};
</script>
