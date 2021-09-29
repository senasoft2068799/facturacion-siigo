<template>
  <div>
    Login
    <form @submit.prevent="login">
      <input v-model="form.email" type="email" placeholder="Email" />
      <br />
      <input v-model="form.password" type="password" placeholder="Password" />
    </form>
  </div>
</template>
    <script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      }
    };
  },
  methods: {
    login() {
      console.log("Enviando", this.form);
    }
  }
};
</script>