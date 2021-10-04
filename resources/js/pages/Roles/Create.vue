<template>
  <div class="card">
    <div class="card-header">Registrar rol</div>
    <div class="card-body">
      <form @submit.prevent="registrarRol()">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre de rol</label>
          <input
            type="text"
            class="form-control"
            id="nombre"
            v-model="rol.nombre"
          />
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <router-link :to="{ name: 'roles.index' }" class="btn btn-secondary"
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
      rol: {
        nombre: null,
      },
    };
  },
  methods: {
    registrarRol() {
      this.axios
        .post("/api/roles", this.rol)
        .then((response) => {
          this.$swal("Rol registrado correctamente.");
          this.rol.nombre = null;
        })
        .catch((err) => {
          this.$swal({
            icon: "error",
            title: "Ha ocurrido un error:\n" + err,
          });
        });
    },
  },
};
</script>
