<template>
  <div class="row mt-5">
    <pre>{{ user }}</pre>
    <div class="col-md-4"></div>
    <div class="col-md-4 shadow-sm">
      <h3 class="text-center mt-3 mb-4">Login</h3>
      <form @submit.prevent="login">
        <div class="form-floating">
          <input
            type="email"
            id="email"
            class="form-control"
            placeholder="Correo Electrónico"
            v-model="form.email"
          />
          <label for="email">Correo Electrónico:</label>
        </div>
        <div class="form-floating my-3">
          <input
            type="password"
            id="password"
            class="form-control"
            placeholder="Contraseña"
            v-model="form.password"
          />
          <label for="password">Contraseña:</label>
        </div>
        <div class="text-center">
          <button @click="login" class="btn btn-primary mt-2 mb-4 w-75 py-3">
            Iniciar Sesión
          </button>
        </div>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</template>
    <script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
        device_name: "browser",
      },
    };
  },
  methods: {
    login() {
      axios.post('api/login', this.form).then((response) => {
        
      }).catch((console.error("Error")));
    },
  },
};
</script>