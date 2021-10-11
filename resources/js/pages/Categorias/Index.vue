<template>
  <div>
    <router-link
      class="btn btn-primary mb-3"
      :to="{ name: 'categorias.create' }"
      >Registrar categoría</router-link
    >
    <router-link
      class="btn btn-secondary mb-3"
      style="float: right"
      :to="{ name: 'productos.index' }"
      >Ver productos</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado Categoría</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(categoria, index) in categorias" :key="index">
            <td>{{ categoria.nombre }}</td>
            <td>{{ categoria.descripcion }}</td>
            <td v-if="categoria.estado_categoria == 1" class="text-success">Activo</td>
            <td v-else class="text-danger">Inactivo</td>
            <td>{{ categoria.created_at }}</td>
            <td>{{ categoria.updated_at }}</td>
            <td class="text-center">
              <router-link
                class="btn btn-sm btn-primary"
                title="Editar"
                :to="{
                  name: 'categorias.edit',
                  params: { id: categoria.id },
                }"
                ><i class="fas fa-pencil-alt"></i
              ></router-link>
              <button
                @click="eliminarCategoria(categoria, index)"
                class="btn btn-sm btn-danger"
                title="Inactivar"
                v-if="categoria.estado_categoria == 1"
              >
                <i class="fas fa-ban"></i>
              </button>
              <button
                @click="activarCategoria(categoria, index)"
                class="btn btn-sm btn-success"
                title="Activar"
                v-if="categoria.estado_categoria == 0"
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
      categorias: [],
    };
  },
  created() {
    this.axios.get("/api/categorias").then((response) => {
      this.categorias = response.data.data;
    });
  },
  methods: {
    activarCategoria(categoria, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se activará la categoría: '" + categoria.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .put("/api/categorias/" + categoria.id)
            .then((response) => {
              this.categorias[index].estado_categoria = 1;
              this.categorias.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Categoría activada.",
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
    eliminarCategoria(categoria, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se inactivará la categoría: '" + categoria.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/categorias/" + categoria.id)
            .then((response) => {
              this.categorias[index].estado_categoria = 0;
              this.categorias.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Categoría inactivada.",
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
