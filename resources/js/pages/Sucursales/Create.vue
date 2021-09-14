<template>
    <div>
        <form @submit.prevent="registrarSucursal">
            <div class="mb-3">
                <label for="nombre" class="form-label"
                    >Nombre de sucursal</label
                >
                <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    v-model="sucursal.nombre"
                />
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input
                    type="text"
                    class="form-control"
                    id="direccion"
                    v-model="sucursal.direccion"
                />
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input
                    type="tel"
                    class="form-control"
                    id="telefono"
                    v-model="sucursal.telefono"
                />
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <select class="form-select" id="ciudad" v-model="sucursal.ciudade_id">
                    <option disabled value="null">Seleccionar ciudad...</option>
                    <option v-for="(ciudad, index) in ciudades" :key="index" v-bind:value="ciudad.id">{{ciudad.nombre}}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
            <router-link
                :to="{ name: 'sucursales.index' }"
                class="btn btn-secondary"
                >Regresar</router-link
            >
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            sucursal: {
                nombre: null,
                direccion: null,
                telefono: null,
                ciudade_id: null
            },
            ciudades: []
        };
    },
    mounted() {
        this.axios.get("/api/ciudades").then(response => {
            this.ciudades = response.data;
        });
    },
    methods: {
        registrarSucursal() {
            this.axios
                .post("/api/sucursales", this.sucursal)
                .then(response => {
                    this.$swal("Sucursal registrada correctamente.");
                    this.sucursal.nombre = null;
                    this.sucursal.direccion = null;
                    this.sucursal.telefono = null;
                    this.sucursal.ciudade_id = null;
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
