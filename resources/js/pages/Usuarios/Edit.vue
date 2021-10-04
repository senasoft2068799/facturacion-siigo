<template>
    <div class="card">
        <div class="card-header text-center fs-4">Modificar Usuario</div>
        <div class="card-body">
            <form @submit.prevent="modificarUsuario">
                <div class="mb-3">
                    <label for="nombre" class="form-label"
                        >Nombre</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        v-model="user.nombre"
                    />
                    <label for="apellido" class="form-label"
                        >Apellido</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="apellido"
                        v-model="user.apellido"
                    />
                    <label for="email" class="form-label"
                        >Email</label
                    >
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="user.email"
                    />
                    <label for="telefono" class="form-label"
                        >Teléfono</label
                    >
                    <input
                        type="number"
                        class="form-control"
                        id="telefono"
                        v-model="user.telefono"
                    />
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select
                            class="form-select"
                            id="role"
                            v-model="user.role_id"
                        >
                            <option disabled value="null"
                                >Seleccionar rol...</option
                            >
                            <option
                                v-for="(role, index) in roles"
                                :key="index"
                                v-bind:value="role.id"
                                >{{ role.nombre }}</option
                            >
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit me-2"></i>Modificar</button>
                <router-link
                    :to="{ name: 'usuarios.index' }"
                    class="btn btn-secondary"
                    ><i class="fas <fas fa-arrow-alt-circle-left me-2"></i>Regresar</router-link
                >
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: {
                nombre: null,
                apellido: null,
                email: null,
                telefono: null,
                role_id: null
            },
            roles: []
        };
    },
    created() {
        this.axios.get("/api/roles").then(res => {
            this.roles = res.data;
        });
        axios.get("/api/usuarios/" + this.$route.params.id).then(res => {
            this.user = res.data;
        });
    },
    methods: {
        modificarUsuario() {
            this.axios
                .put("/api/usuarios/" + this.$route.params.id, this.user)
                .then(response => {
                    this.$swal("Usuario modificado correctamente.");
                    this.$router.push("/usuarios");
                })
                .catch(err => {
                    this.$swal({
                        icon: "error",
                        title: "Ha ocurrido un error:\n" + err
                    });
                });
        }
    }
};
</script>
