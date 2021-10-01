<template>
    <div class="card" style="width: 28rem;">
        <div class="card-header">Inicio de sesión</div>
        <div class="card-body">
            <form @submit.prevent="login()">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input
                        type="text"
                        class="form-control"
                        id="email"
                        v-model="formData.email"
                    />
                    <p class="text-danger" v-text="errors.email"></p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        v-model="formData.password"
                    />
                    <p class="text-danger" v-text="errors.password"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Iniciar sesión
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <router-link :to="{ name: 'register' }">
                            Registrar cuenta
                        </router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            formData: {
                email: null,
                password: null,
                device_name: "browser"
            },
            errors: {}
        };
    },
    methods: {
        login() {
            axios
                .post("/api/login", this.formData)
                .then(response => {
                  localStorage.setItem("token", response.data);
                  this.$router.push("/");
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    }
};
</script>
