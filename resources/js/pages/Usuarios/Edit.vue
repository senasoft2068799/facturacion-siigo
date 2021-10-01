<template>
  <div class="card">
    <div class="card-header">Modificar Usuario</div>
    <div class="card-body">
      <form @submit.prevent="modificarUsuario">
        <div class="mb-3">
          <label for="name" class="form-label">Nombre Completo</label>
          <input
            type="text"
            class="form-control"
            id="name"
            v-model="user.name"
          />
        </div>
        <div class="my-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            v-model="user.email"
          />
        </div>
        <button type="submit" class="btn btn-success">Modificar</button>
        <router-link :to="{ name: 'usuarios.index' }" class="btn btn-secondary"
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
      user: {
        name: null,
        email: null,
      },
    };
  },
  created() {
    axios.get("/api/users/" + this.$route.params.id).then((res) => {
      this.user = res.data;
    });
  },
  methods: {
    modificarUsuario() {
      this.axios
        .put("/api/users/" + this.$route.params.id, this.user)
        .then((response) => {
          this.$swal("Usuario modificado correctamente.");
          this.$router.push("/usuarios");
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
