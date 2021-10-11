<template>
  <li class="nav-item dropdown me-3">
    <a
      class="nav-link dropdown-toggle link-dark"
      href="#"
      id="navbarDropdown"
      role="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
      @click="checkCurrentUser()"
    >
      <i class="fas fa-user"></i>
    </a>
    <ul
      class="dropdown-menu dropdown-menu-end py-0"
      aria-labelledby="navbarDropdown"
    >
      <p id="menu-user" class="bg-primary text-white fw-bold">
        {{ currentUser.rol }}
      </p>
      <li v-if="currentUser.nombre != null">
        <div class="d-flex">
          <i id="user" class="fas fa-user mx-3"></i>
          <small class="fw-bold"
            >{{ currentUser.nombre }} {{ currentUser.apellido }}<br />
            {{ currentUser.id }}</small
          >
        </div>
      </li>
      <li class="mt-3"><hr class="dropdown-divider" /></li>
      <button @click="logout()" id="btn-logout">
        <i class="fas fa-sign-out-alt me-2"> Cerrar sesión </i>
      </button>
    </ul>
  </li>
</template>
<script>
import Storage from "../utilities/Storage.js";
export default {
  name: "CurrentUser",
  data() {
    return {
      currentUser: {},
      token: null,
    };
  },
  mounted() {
    this.checkCurrentUser();
  },
  methods: {
    checkCurrentUser() {
      if (Storage.has("token")) {
        this.token = Storage.get("token", false);
        window.axios.defaults.headers.common[
          "Authorization"
        ] = `Bearer ${this.token}`;
        this.axios
          .get("/api/user")
          .then((res) => {
            this.currentUser = res.data;
          })
          .catch((err) => {
            console.log("Error autenticación: " + err);
          });
      } else {
        this.currentUser = {};
        this.token = null;
      }
    },
    logout() {
      this.axios
        .post("/api/logout")
        .then((res) => {
          Storage.remove("token");
          this.$router.push("/login");
        })
        .catch((err) => {
          console.log("Error logout: " + err);
        });
    },
  },
};
</script>