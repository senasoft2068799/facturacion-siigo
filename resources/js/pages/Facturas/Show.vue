<template>
    <div class="card mb-3">
        <div class="card-header">Información de factura</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="fw-bold">Sucursal:</p>
                    <p>{{ factura.sucursal.nombre }}</p>
                </div>
                <div class="col-md-6">
                    <p class="fw-bold">Cliente:</p>
                    <p>{{ factura.tercero }}</p>
                </div>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Bodega</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>IVA <small>(19%)</small></th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody v-if="detalleFacturas.length > 0">
                        <tr
                            v-for="(detalleFac, index) in detalleFacturas"
                            :key="index"
                        >
                            <td>
                                {{ detalleFac.producto.nombre }}
                            </td>
                            <td>{{ detalleFac.cantidad }}</td>
                            <td>
                                {{ detalleFac.bodega.nombre }}
                            </td>
                            <td>${{ detalleFac.producto.precio_unitario }}</td>
                            <td>
                                ${{
                                    detalleFac.producto.precio_unitario *
                                        detalleFac.cantidad
                                }}
                            </td>
                            <td>
                                ${{
                                    detalleFac.producto.precio_unitario *
                                        detalleFac.cantidad *
                                        0.19
                                }}
                            </td>
                            <td>${{ detalleFac.valor_total }}</td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">
                                No se encuentran registros disponibles...
                            </td>
                        </tr>
                    </tbody>
                    <tfoot v-if="detalleFacturas.length > 0">
                        <tr class="table-active">
                            <td colspan="4"></td>
                            <th><h5>$</h5></th>
                            <th><h5>$</h5></th>
                            <th>
                                <h5>${{ factura.valor_total }}</h5>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr />
            <div class="row mb-3">
                <p class="fw-bold">Descripción:</p>
                <p>{{ factura.descripcion }}</p>
            </div>
            <router-link
                :to="{ name: 'facturas.index' }"
                class="btn btn-secondary"
                >Regresar</router-link
            >
        </div>
    </div>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            factura: {},
            detalleFacturas: []
        };
    },
    mounted() {
        //Mostrar factura
        this.axios.get("/api/facturas/" + this.id).then(res => {
            this.factura = res.data.data;
        });
    }
};
</script>
