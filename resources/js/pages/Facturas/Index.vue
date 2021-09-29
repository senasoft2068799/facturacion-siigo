<template>
    <div>
        <router-link
            class="btn btn-success mb-3"
            :to="{ name: 'facturas.create' }"
            >Registrar factura</router-link
        >
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Sucursal</th>
                        <th>Tercero</th>
                        <th>Valor + IVA</th>
                        <th>Fecha de creación</th>
                        <th>Fecha de modificación</th>
                        <th>Funciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(factura, index) in facturas" :key="index">
                        <td>{{ factura.id }}</td>
                        <td>{{ factura.descripcion.substring(0, 20) }}...</td>
                        <td>{{ factura.sucursal.nombre }}</td>
                        <td>{{ factura.tercero }}</td>
                        <td>${{ factura.valor_total }}</td>
                        <td>{{ factura.created_at }}</td>
                        <td>{{ factura.updated_at }}</td>
                        <td>
                            <router-link
                                class="btn btn-info btn-sm"
                                :to="{
                                    name: 'facturas.show',
                                    params: { id: factura.id }
                                }"
                                >Detalles</router-link
                            >
                            <router-link
                                class="btn btn-warning btn-sm"
                                :to="{
                                    name: 'facturas.edit',
                                    params: { id: factura.id }
                                }"
                                >Editar</router-link
                            >
                            <button
                                @click="eliminarSucursal(factura, index)"
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
            facturas: []
        };
    },
    created() {
        this.axios.get("/api/facturas").then(response => {
            this.facturas = response.data.data;
        });
    },
    methods: {
        eliminarSucursal(factura, index) {
            this.$swal({
                title: "¿Estás seguro?",
                text: "Se eliminará la factura: '" + factura.id + "'",
                icon: "warning",
                showCancelButton: true
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/api/facturas/" + factura.id)
                        .then(response => {
                            this.facturas.splice(index, 1);
                            this.$swal({
                                icon: "success",
                                title: "Factura eliminada."
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
