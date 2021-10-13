<template>
  <div class="card my-3">
    <div class="card-header text-center fs-4">Modificar Usuario</div>
    <div class="card-body">
      <form @submit.prevent="modificarUsuario">
        <label for="tipo_documento" class="form-label">Tipo de documento</label>
        <select
          class="form-select"
          id="tipo_documento"
          v-model="user.tipo_documento"
        >
          <option disabled value="null">Seleccionar...</option>
          <option value="CC">Cédula ciudadanía (CC)</option>
          <option value="TI">Tarjeta de identidad (TI)</option>
          <option value="TP">Tarjeta de pasaporte (TP)</option>
          <option value="RC">Registro civil (RC)</option>
          <option value="CE">Cédula de extranjería (CE)</option>
          <option value="DNI">Documento nacional de identidad (DNI)</option>
        </select>
        <div class="my-3">
          <label for="nombre" class="form-label">Nombres</label>
          <input
            type="text"
            class="form-control"
            id="nombre"
            v-model="user.nombre"
          />
        </div>
        <label for="apellido" class="form-label">Apellidos</label>
        <input
          type="text"
          class="form-control"
          id="apellido"
          v-model="user.apellido"
        />
        <div class="my-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            v-model="user.email"
          />
        </div>
        <label for="telefono" class="form-label">Teléfono</label>
        <input
          type="number"
          class="form-control"
          id="telefono"
          v-model="user.telefono"
        />
        <div class="my-3">
          <label for="role" class="form-label">Rol</label>
          <select class="form-select" id="role" v-model="user.role_id">
            <option disabled value="null">Seleccionar rol...</option>
            <option
              v-for="(role, index) in roles"
              :key="index"
              v-bind:value="role.id"
            >
              {{ role.nombre }}
            </option>
          </select>
        </div>
        <label for="estado_usuario" class="form-label">Estado Usuario</label>
        <select
          class="form-select"
          id="estado_usuario"
          v-model="user.estado_usuario"
        >
          <option disabled value="null">Seleccionar...</option>
          <option value=1>Activo</option>
          <option value=0>Inactivo</option>
        </select>
        <div class="mt-4 mb-2">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Modificar
          </button>
          <router-link
            :to="{ name: 'usuarios.index' }"
            class="btn btn-dark"
            ><i class="fas fa-arrow-alt-circle-left me-2"></i
            >Regresar</router-link
          >
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user: {
        tipo_documento: null,
        nombre: null,
        apellido: null,
        email: null,
        telefono: null,
        estado_usuario: null,
        role_id: null,
      },
      roles: [],
    };
  },
  created() {
    this.axios.get("/api/roles").then((res) => {
      this.roles = res.data;
    });
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
