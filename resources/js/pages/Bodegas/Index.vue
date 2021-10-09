<template>
  <div>
    <router-link class="btn btn-primary mb-3" :to="{ name: 'bodegas.create' }"
      >Registrar bodega</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Sucursal</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(bodega, index) in bodegas" :key="index">
            <td>{{ bodega.nombre }}</td>
            <td>{{ bodega.direccion }}</td>
            <td>{{ bodega.sucursal.nombre }}</td>
            <td>{{ bodega.created_at }}</td>
            <td>{{ bodega.updated_at }}</td>
            <td class="d-flex">
              <router-link
                class="btn btn-sm btn-warning"
                title="Detalles"
                :to="{
                  name: 'bodegas.show',
                  params: { id: bodega.id },
                }"
                ><i class="fas fa-eye"></i
              ></router-link>
              <router-link
                class="btn btn-sm btn-primary mx-2"
                title="Editar"
                :to="{
                  name: 'bodegas.edit',
                  params: { id: bodega.id },
                }"
                ><i class="fas fa-pencil-alt"></i
              ></router-link>
              <button
                @click="eliminarBodega(bodega, index)"
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
      bodegas: [],
    };
  },
  created() {
    this.axios.get("/api/bodegas").then((response) => {
      this.bodegas = response.data.data;
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