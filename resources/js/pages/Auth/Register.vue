<template>
    <div class="card" style="width: 30rem;">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'login' }"
                        >Iniciar sesión</router-link
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true"
                        >Registrar usuario</a
                    >
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form @submit.prevent="register()">
                <div class="mb-3">
                    <label for="tipo_documento" class="form-label"
                        >Tipo de documento</label>
                    <select
                        class="form-select"
                        id="tipo_documento"
                        v-model="formData.tipo_documento">
                        <option disabled value="null">Seleccionar...</option>
                        <option value="CC">Cédula ciudadanía (CC)</option>
                        <option value="TI">Tarjeta de identidad (TI)</option>
                        <option value="TP">Tarjeta de pasaporte (TP)</option>
                        <option value="RC">Registro civil (RC)</option>
                        <option value="CE">Cédula de extranjería (CE)</option>
                        <option value="DNI">Documento nacional de identidad (DNI)</option>
                    </select>
                    <p class="text-danger" v-text="errors.tipo_documento"></p>
                </div>
                <div class="mb-3">
                    <label for="id" class="form-label">Número de documento</label>
                    <input
                        type="text"
                        class="form-control"
                        id="id"
                        v-model="formData.id"/>
                    <p class="text-danger" v-text="errors.id"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            v-model="formData.nombre"
                        />
                        <p class="text-danger" v-text="errors.nombre"></p>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label"
                            >Apellido</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="apellido"
                            v-model="formData.apellido"
                        />
                        <p class="text-danger" v-text="errors.apellido"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input
                        type="tel"
                        class="form-control"
                        id="telefono"
                        v-model="formData.telefono"
                    />
                    <p class="text-danger" v-text="errors.telefono"></p>
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
                <button type="submit" class="btn btn-success">
                    Registrar
                </button>
                {{formData}}
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
                tipo_documento: null,
                nombre: null,
                apellido: null,
                email: null,
                telefono: null,
                password: null,
                password_confirmation: null
                // role_id: null
            },
            errors: {}
        };
    },
    methods: {
        register() {
            axios
                .post("/api/register", this.formData)
                .then(response => {
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
