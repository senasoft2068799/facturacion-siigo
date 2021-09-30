<template>
    <div class="card">
        <div class="card-header">Registrar Usuario</div>
        <div class="card-body">
            <form @submit.prevent="registrar">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="tercero.name"
                    />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"
                        >Correo electrónico</label
                    >
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="tercero.email"
                    />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        v-model="tercero.password"
                    />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"
                        >Confirmar contraseña</label
                    >
                    <input
                        type="password"
                        class="form-control"
                        id="password_confirm"
                        v-model="tercero.password_confirm"
                    />
                </div>
                <button type="submit" class="btn btn-success">Registrar</button>
                <router-link
                    :to="{ name: 'documentos.index' }"
                    class="btn btn-secondary"
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
            tercero: {
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
                password_confirm: null
            }
        };
    },
    methods: {
        registrar() {}
    }
};
</script>
