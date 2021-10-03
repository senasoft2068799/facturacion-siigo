<template>
  <div>
    <router-link class="btn btn-success mb-3" :to="{ name: 'bodegas.create' }"
      >Registrar bodega</router-link
    >
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(bodega, index) in bodegas" :key="index">
            <td>{{ bodega.nombre }}</td>
            <td>{{ bodega.direccion }}</td>
            <td>{{ bodega.created_at }}</td>
            <td>{{ bodega.updated_at }}</td>
            <td>
              <button
                @click="eliminarBodega(bodega, index)"
                class="btn btn-danger btn-sm"
                title="Eliminar"
              >
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- =======
    <div>
        <router-link
            class="btn btn-success mb-3"
            :to="{ name: 'bodegas.create' }"
            >Registrar bodega</router-link
        >
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(bodega, index) in bodegas" :key="index">
                        <td>{{ bodega.nombre }}</td>
                        <td>{{ bodega.direccion }}</td>
                        <td>{{ bodega.created_at }}</td>
                        <td>{{ bodega.updated_at }}</td>
                        <td>
                            <button
                                @click="eliminarBodega(bodega, index)"
                                class="btn btn-danger btn-small"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
>>>>>>> f66647da554dcdc5cb67c66b40c6f408f7bf1dcd -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      bodegas: [],
    };
  },
  created() {
    /*
this.axios.get("/api/documentos").then(response => {
            this.documentos = response.data;
        });*/

    this.axios.get("/api/bodegas").then((response) => {
      this.bodegas = response.data;
    });
  },
  methods: {
    eliminarBodega(bodega, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se eliminará la bodega: '" + bodega.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/bodegas/" + bodega.id)
            .then((response) => {
              this.bodegas.splice(index, 1);
              this.$swal({
                icon: "success",
                title: "Bodega eliminada.",
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