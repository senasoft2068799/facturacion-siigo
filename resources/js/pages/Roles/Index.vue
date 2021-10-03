<template>
    <div>
        <router-link
            class="btn btn-success mb-3"
            :to="{ name: 'roles.create' }"
            >Registrar rol</router-link
        >
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre de rol</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(rol, index) in roles" :key="index">
                        <td>{{ rol.nombre }}</td>
                        <td>{{ rol.created_at }}</td>
                        <td>{{ rol.updated_at }}</td>
                        <td>
                            <router-link
                                class="btn btn-warning btn-sm"
                                :to="{
                                    name: 'roles.edit',
                                    params: { id: rol.id }
                                }"
                                >Editar</router-link
                            >
                            <button
                                @click="eliminarRol(rol, index)"
                                class="btn btn-danger btn-sm"
                            >
                                Eliminar
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
            roles: []
        };
    },
    created() {
        this.axios.get("/api/roles").then(response => {
            this.roles = response.data;
        });
    },
    methods: {
        eliminarRol(rol, index) {
            this.$swal({
                title: "¿Estás seguro?",
                text: "Se eliminará el rol: '" + rol.nombre + "'",
                icon: "warning",
                showCancelButton: true
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/roles/" + rol.id)
                        .then(response => {
                            this.roles.splice(index, 1);
                            this.$swal({
                                icon: "success",
                                title: "Rol eliminado."
                            });
                        })
                        .catch(err => {
                            this.$swal({
                                icon: "error",
                                title: "Ha ocurrido un error:\n" + err
                            });
                        });
                }
            });
        }
    }
};
</script>
