<template>
  <div>
    <router-link class="btn btn-primary mb-3" :to="{ name: 'usuarios.create' }"
      ><i class="fas fa-user me-2"></i>Registrar Usuario</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th>Número de Teléfono</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Funciones</th>
          </tr>
        </thead> 
        <tbody>
          <tr v-for="(user, index) in users" :key="index">
            <td>{{ user.nombre }} {{ user.apellido }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.telefono }}</td>
            <td>{{ user.rol.nombre }}</td>
            <td v-if="user.estado == 1" class="text-success">Activo</td>
            <td v-else class="text-danger">Inactivo</td>
            <td class="text-center">
              <router-link
                class="btn btn-sm btn-primary"
                title="Editar"
                :to="{
                  name: 'usuarios.edit',
                  params: { id: user.id },
                }"
                ><i class="fas fa-pencil-alt"></i
              ></router-link>
              <button
                @click="eliminarUsuario(user, index)"
                class="btn btn-sm btn-danger"
                title="Inactivar"
                v-if="user.estado == 1"
              >
                <i class="fas fa-ban"></i>
              </button>
              <button
                @click="activarUsuario(user, index)"
                class="btn btn-sm btn-success"
                title="Activar"
                v-if="user.estado == 0"
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
      users: [],
    };
  },
  created() {
    this.axios.get("/api/users").then((response) => {
      this.users = response.data.data;
    });
  },
  methods: {
    activarUsuario(user, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se activará el usuario: '" + user.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/users/" + user.id)
            .then((response) => {
              this.users[index].estado = 1;
              this.users.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Usuario activado.",
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
    eliminarUsuario(user, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se inactivará el usuario: '" + user.nombre + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/users/" + user.id)
            .then((response) => {
              this.users[index].estado = 0;
              this.users.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Usuario inactivado.",
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