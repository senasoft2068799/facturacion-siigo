<template>
  <div>
    <router-link
      class="btn btn-primary mb-3"
      :to="{ name: 'sucursales.create' }"
      >Registrar sucursal</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(sucursal, index) in sucursales" :key="index">
            <td>{{ sucursal.nombre }}</td>
            <td>{{ sucursal.direccion }}</td>
            <td>{{ sucursal.telefono }}</td>
            <td>{{ sucursal.ciudad.nombre }}</td>
            <td v-if="sucursal.estado == 1" class="text-success">Activo</td>
            <td v-else class="text-danger">Inactivo</td>
            <td>{{ sucursal.created_at }}</td>
            <td>{{ sucursal.updated_at }}</td>
            <td class="text-center">
              <router-link
                class="btn btn-sm btn-primary"
                title="Editar"
                :to="{
                  name: 'sucursales.edit',
                  params: { id: sucursal.id },
                }"
                ><i class="fas fa-pencil-alt"></i
              ></router-link>
              <button
                @click="eliminarSucursal(sucursal, index)"
                class="btn btn-sm btn-danger"
                title="Inactivar"
                v-if="sucursal.estado == 1"
              >
                <i class="fas fa-ban"></i>
              </button>
              <button
                @click="activarSucursal(sucursal, index)"
                class="btn btn-sm btn-success"
                title="Activar"
                v-if="sucursal.estado == 0"
              >
                <i class="fas fa-check"></i>
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
      sucursales: [],
    };
  },
  created() {
    this.axios.get("/api/sucursales").then((response) => {
      this.sucursales = response.data.data;
    });
  },
  methods: {
    activarSucursal(sucursal, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se activará la sucursal: '" + sucursal.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/sucursales/" + sucursal.id)
            .then((response) => {
              this.sucursales[index].estado = 1;
              this.sucursales.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Sucursal activada.",
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
    eliminarSucursal(sucursal, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se inactivará la sucursal: '" + sucursal.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/sucursales/" + sucursal.id)
            .then((response) => {
              this.sucursales[index].estado = 0;
              this.sucursales.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Sucursal inactivada.",
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
