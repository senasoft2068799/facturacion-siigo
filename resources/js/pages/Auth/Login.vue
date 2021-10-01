<template>
    <div class="card" style="width: 24rem;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true"
                        >Iniciar sesión</a
                    >
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'register' }"
                        >Registrar usuario</router-link
                    >
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form @submit.prevent="login()">
                <div class="mb-3">
                    <label for="email" class="form-label"
                        >Correo electrónico</label
                    >
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
                <button type="submit" class="btn btn-primary">
                    Iniciar sesión
                </button>
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
