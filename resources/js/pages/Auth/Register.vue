<template>
    <div class="card" style="width: 28rem;">
        <div class="card-header">Registro de usuario</div>
        <div class="card-body">
            <form @submit.prevent="register()">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="formData.name"
                    />
                    <p class="text-danger" v-text="errors.name"></p>
                </div>
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
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label"
                        >Confirmar contraseña</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="password_confirmation"
                        v-model="formData.password_confirmation"
                    />
                    <p
                        class="text-danger"
                        v-text="errors.password_confirmation"
                    ></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">
                            Registrar
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <router-link :to="{ name: 'login' }">
                            Iniciar sesión
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
                // id: null,
                // tipo_documento: null,
                // nombre: null,
                // apellido: null,
                // email: null,
                // telefono: null,
                // password: null,
                // role_id: null
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errors: {}
        };
    },
    methods: {
        register() {
            axios
                .post("/api/register", this.formData)
                .then(response => {
                    console.log("Bien");
                    console.log(response.data);
                    this.errors = {};
                    this.$router.push("/login");
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    }
};
</script>
