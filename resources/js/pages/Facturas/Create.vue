<template>
    <div class="card mb-3">
        <div class="card-header">Registrar factura</div>
        <div class="card-body">
            <form @submit.prevent="registrarFactura()">
                <!-- Encabezado factura (Sucursal, cliente) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="sucursal" class="form-label">Sucursal</label>
                        <select class="form-select" id="sucursal" v-model="sucursal">
                            <option disabled value="null">Seleccionar sucursal...</option>
                            <option v-for="(sucursal, index) in sucursales" :key="index" v-bind:value="sucursal.id">
                                {{ sucursal.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="cliente" class="form-label">Cliente</label>
                            <!-- <select class="form-select" id="cliente" v-model="cliente">
                                <option disabled value="null">Seleccionar cliente...</option>
                                <option v-for="(cliente, index) in clientes" :key="index" v-bind:value="cliente.id">
                                    {{ cliente.nombre }}
                                </option>
                            </select> -->
                    </div>
                </div>
                <hr/>
                <!-- Fin encabezado -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <!-- Encabezado tabla -->
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Bodega</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>IVA <small>(19%)</small></th>
                                <th>Total</th>
                                <th>Funciones</th>
                            </tr>
                        </thead>
                        <!-- Fin encabezado tabla -->
                        <!-- Cuerpo tabla -->
                        <tbody>
                            <!-- Inputs registro detalles -->
                            <tr>
                                <td>
                                    <select class="form-select" id="producto" v-model="producto">
                                        <option disabled value="null">Seleccionar...</option>
                                        <option v-for="(producto, index) in productos" :key="index" v-bind:value="producto">
                                            {{ producto.nombre }}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" id="cantidad" v-model="detalleFactura.cantidad"/>
                                </td>
                                <td>
                                    <select class="form-select" id="bodega" v-model="bodega">
                                        <option disabled value="null">Seleccionar...</option>
                                        <option v-for="(bodega, index) in bodegas" :key="index" v-bind:value="bodega">
                                            {{ bodega.nombre }}
                                        </option>
                                    </select>
                                </td>
                                <td>{{ formatCurrency(producto.precio_unitario) }}</td>
                                <td>{{ formatCurrency(producto.precio_unitario * detalleFactura.cantidad) }}</td>
                                <td>{{ formatCurrency((producto.precio_unitario * detalleFactura.cantidad) * 0.19) }}</td>
                                <td>{{ formatCurrency((producto.precio_unitario * detalleFactura.cantidad) * 1.19) }}</td>
                                <td v-if="editing == null">
                                    <button type="button" class="btn btn-success btn-sm" title="Agregar"
                                            @click="agregarDetalleFactura()">
                                            <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm" title="Limpiar"
                                            @click="limpiarCampos()">
                                            <i class="fas fa-eraser"></i>
                                    </button>
                                </td>
                                <td v-else>
                                    <button type="button" class="btn btn-success btn-sm" title="Confirmar edición"
                                            @click="editarDetalleFactura()">
                                            <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" title="Cancelar"
                                            @click="cancelarEdicion()">
                                            <i class="fas fa-times-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Fin inputs registro detalles -->
                            <!-- Todos los detalles (items) de factura -->
                            <tr v-for="(item, index) in detalleFacturas" :key="index">
                                <td>{{ item.producto.nombre }}</td>
                                <td>{{ item.cantidad }}</td>
                                <td>{{ item.bodega.nombre }}</td>
                                <td>{{ formatCurrency(item.producto.precio_unitario) }}</td>
                                <td>{{ formatCurrency(item.producto.precio_unitario * item.cantidad) }}</td>
                                <td>{{ formatCurrency((item.producto.precio_unitario * item.cantidad) * 0.19) }}</td>
                                <td>{{ formatCurrency(item.valor_total) }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm text-white" title="Editar"
                                            @click="iniciarEdicion(item, index)">
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" title="Eliminar"
                                            @click="eliminarDetalleFactura(item, index)">
                                            <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Fin todos los detalles de factura -->
                        </tbody>
                        <!-- Fin cuerpo tabla -->
                        <!-- Footer tabla -->
                        <tfoot v-if="detalleFacturas.length > 0">
                            <tr class="table-active">
                                <td colspan="4"></td>
                                <th><h5></h5></th>
                                <th><h5></h5></th>
                                <th><h5>{{ formatCurrency(factura.valor_total) }}</h5></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <!-- Fin footer tabla -->
                    </table>
                </div>
                <hr/>
                <!-- Descripcion factura -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" rows="3" v-model="factura.descripcion"></textarea>
                </div>
                <!-- Fin descripcion -->
                <!-- Botones -->
                <button type="submit" class="btn btn-success">Registrar</button>
                <router-link class="btn btn-secondary" :to="{ name: 'facturas.index' }">Cancelar</router-link>
                <!-- Fin botones -->
            </form>
        </div>
        {{factura}}
    </div>
</template>

<script>
export default {
    data() {
        return {
            editing: null,
            sucursales: [],
            sucursal: {},
            clientes: [],
            cliente: {},
            productos: [],
            producto: {},
            bodegas: [],
            bodega: {},
            factura: {
                descripcion: null,
                documento_id: 1,
                sucursale_id: null,
                user_id: 1,
                valor_total: null,
                estado: 1
            },
            detalleFacturas: [],
            detalleFactura: {},
        };
    },
    mounted() {
        //Mostrar lista de sucursales
        this.axios.get("/api/sucursales").then(res => {
            this.sucursales = res.data.data;
        });
        //Mostrar lista de productos
        this.axios.get("/api/productos").then(res => {
            this.productos = res.data.data;
        });
        //Mostrar lista de bodegas
        this.axios.get("/api/bodegas").then(res => {
            this.bodegas = res.data;
        });
    },
    methods: {
        formatCurrency(number){
            var formatted = 0;
            if (!isNaN(number)){
                formatted = new Intl.NumberFormat('es-CO', {
                    style: 'currency',
                    currency: 'COP'
                }).format(number);
            }
            return formatted;
        },
        agregarDetalleFactura() {
            let valorDetalle;
            valorDetalle = (this.producto.precio_unitario * this.detalleFactura.cantidad) * 1.19;
            this.detalleFactura.valor_total = valorDetalle;
            this.detalleFactura.producto = this.producto;
            this.detalleFactura.bodega = this.bodega;
            this.detalleFacturas.splice(0, 0, this.detalleFactura);
            this.limpiarCampos();
            this.factura.valor_total += valorDetalle;
        },
        eliminarDetalleFactura(item, index) {
            this.detalleFacturas.splice(index, 1);
            this.factura.valor_total -= item.valor_total;
        },
        iniciarEdicion(item, index) {
            this.editing = index;
            // this.detalleFactura.cantidad = detalleFac.cantidad;
            // this.detalleFactura.producto = detalleFac.producto;
            // this.detalleFactura.bodega = detalleFac.bodega;
            this.detalleFactura = item;
            this.producto = item.producto;
            this.bodega = item.bodega;
        },
        editarDetalleFactura() {
            this.detalleFactura.producto = this.producto;
            this.detalleFactura.bodega = this.bodega;
            this.detalleFacturas.splice(this.editing, 1, this.detalleFactura);
            this.cancelarEdicion();
        },
        cancelarEdicion() {
            this.editing = null;
            this.limpiarCampos();
        },
        limpiarCampos() {
            this.detalleFactura = {};
            this.producto = {};
            this.bodega = {};
        },
        registrarFactura() {
            this.factura.sucursale_id = this.sucursal;
            this.axios
                .get("/api/facturas", this.factura)
                .then(response => {
                    this.detalleFacturas.forEach((item) => {
                        this.registrarDetalleFactura(item);
                    });
                    this.$swal("Factura registrada correctamente.");
                })
                .catch(err => {
                    this.$swal({
                        icon: "error",
                        title: "Ha ocurrido un error:\n" + err
                    });
                });
        },
        registrarDetalleFactura(item) {
            var detalleMovimiento = {
                cantidad: item.cantidad,
                valor_total: item.valor_total,
                movimiento_id: item.cantidad,
                bodega_id: item.bodega.id,
                producto_id: item.producto.id
            }
            console.log(detalleMovimiento);
            // console.log(detalleMovimiento);
            //this.axios.post("/api/detalle-movimientos", item);
        }
    }
};
</script>
