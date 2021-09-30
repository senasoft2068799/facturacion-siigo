<template>
    <div>
        <div class="card mb-3">
            <div class="card-header">Registrar factura</div>
            <div class="card-body">
                <form @submit.prevent="registrarFactura()">
                    <!-- Factura -->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sucursal" class="form-label"
                                >Sucursal</label
                            >
                            <select
                                class="form-select"
                                id="sucursal"
                                v-model="sucursal"
                            >
                                <option disabled value="null"
                                    >Seleccionar sucursal...
                                </option>
                                <option
                                    v-for="(sucursal, index) in sucursales"
                                    :key="index"
                                    v-bind:value="sucursal.id"
                                >
                                    {{ sucursal.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="cliente" class="form-label"
                                >Cliente</label
                            >
                            <!-- <select
                                class="form-select"
                                id="cliente"
                                v-model="cliente"
                            >
                                <option disabled value="null">
                                    Seleccionar cliente...
                                </option>
                                <option
                                    v-for="(cliente, index) in clientes"
                                    :key="index"
                                    v-bind:value="cliente.id"
                                >
                                    {{ cliente.nombre }}
                                </option>
                            </select> -->
                        </div>
                    </div>
                    <hr />





                    
                    <div class="table-responsive">
                        <table class="table">
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
                            <tbody>
                                <!-- Registro factura -->
                                <tr>
                                    <td>
                                        <select
                                            class="form-select"
                                            id="producto"
                                            v-model="producto"
                                        >
                                            <option disabled value="null"
                                                >Seleccionar...</option
                                            >
                                            <option
                                                v-for="(producto,
                                                index) in productos"
                                                :key="index"
                                                v-bind:value="producto"
                                                >{{ producto.nombre }}</option
                                            >
                                        </select>
                                    </td>
                                    <td>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="cantidad"
                                            v-model="detalleFactura.cantidad"
                                        />
                                    </td>
                                    <td>
                                        <select
                                            class="form-select"
                                            id="bodega"
                                            v-model="bodega"
                                        >
                                            <option disabled value="null">
                                                Seleccionar...
                                            </option>
                                            <option
                                                v-for="(bodega,
                                                index) in bodegas"
                                                :key="index"
                                                v-bind:value="bodega"
                                            >
                                                {{ bodega.nombre }}
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                producto.precio_unitario != null
                                            "
                                        >
                                            ${{ producto.precio_unitario }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                producto.precio_unitario != null
                                            "
                                        >
                                            ${{
                                                producto.precio_unitario *
                                                    detalleFactura.cantidad
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                producto.precio_unitario != null
                                            "
                                        >
                                            ${{
                                                producto.precio_unitario *
                                                    detalleFactura.cantidad *
                                                    0.19
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                producto.precio_unitario != null
                                            "
                                        >
                                            ${{
                                                producto.precio_unitario *
                                                    detalleFactura.cantidad *
                                                    1.19
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <button
                                            v-if="!editMode.editing"
                                            @click="agregarDetalleFactura()"
                                            class="btn btn-success btn-sm"
                                            title="Agregar"
                                            type="button"
                                        >
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                        <button
                                            v-else
                                            @click="editarDetalleFactura()"
                                            class="btn btn-success btn-sm"
                                            title="Confirmar edición"
                                            type="button"
                                        >
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button
                                            v-if="!editMode.editing"
                                            @click="limpiar()"
                                            class="btn btn-secondary btn-sm"
                                            title="Limpiar"
                                            type="button"
                                        >
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                        <button
                                            v-else
                                            @click="cancelarEdicion()"
                                            class="btn btn-danger btn-sm"
                                            title="Cancelar"
                                            type="button"
                                        >
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Detalles de factura -->

                                <tr
                                    v-for="(detalleFac,
                                    index) in detalleFacturas"
                                    :key="index"
                                >
                                    <td>
                                        {{ detalleFac.producto.nombre }}
                                    </td>
                                    <td>{{ detalleFac.cantidad }}</td>
                                    <td>
                                        {{ detalleFac.bodega.nombre }}
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                detalleFac.producto
                                                    .precio_unitario != null
                                            "
                                        >
                                            ${{
                                                detalleFac.producto
                                                    .precio_unitario
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                detalleFac.producto
                                                    .precio_unitario != null
                                            "
                                        >
                                            ${{
                                                detalleFac.producto
                                                    .precio_unitario *
                                                    detalleFac.cantidad
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                detalleFac.producto
                                                    .precio_unitario != null
                                            "
                                        >
                                            ${{
                                                detalleFac.producto
                                                    .precio_unitario *
                                                    detalleFac.cantidad *
                                                    0.19
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <p
                                            v-if="
                                                detalleFac.producto
                                                    .precio_unitario != null
                                            "
                                        >
                                            ${{
                                                detalleFac.valor_total
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <button
                                            @click="
                                                iniciarEdicion(
                                                    detalleFac,
                                                    index
                                                )
                                            "
                                            class="btn btn-warning btn-sm text-white"
                                            title="Editar"
                                            type="button"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button
                                            @click="
                                                eliminarDetalleFactura(detalleFac, index)
                                            "
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar"
                                            type="button"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>






                    <div class="mb-3">
                        <label for="descripcion" class="form-label"
                            >Descripción</label
                        >
                        <textarea
                            class="form-control"
                            id="descripcion"
                            rows="3"
                            v-model="factura.descripcion"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Registrar
                    </button>
                    <router-link
                        :to="{ name: 'facturas.index' }"
                        class="btn btn-secondary"
                        >Cancelar</router-link
                    >
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            editMode: {
                editing: false,
                index: null
            },
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
            detalleFactura: {
                movimiento_id: 1,
                bodega_id: null,
                producto_id: null,
                cantidad: 0,
                valor_total: 0
            }
        };
    },
    mounted() {
        //Mostrar lista de sucursales
        this.axios.get("/api/sucursales").then(res => {
            this.sucursales = res.data.data;
        });
        //Mostrar lista de productos
        this.axios.get("/api/productos").then(res => {
            this.productos = res.data;
        });
        //Mostrar lista de bodegas
        this.axios.get("/api/bodegas").then(res => {
            this.bodegas = res.data;
        });
    },
    methods: {
        agregarDetalleFactura() {
            let valorDetalle;
            valorDetalle = (this.producto.precio_unitario * this.detalleFactura.cantidad) * 1.19;
            this.detalleFactura.valor_total = valorDetalle;
            this.detalleFactura.producto = this.producto;
            this.detalleFactura.bodega = this.bodega;
            this.detalleFacturas.splice(0, 0, this.detalleFactura);
            this.limpiar();
            this.factura.valor_total += valorDetalle;
        },
        eliminarDetalleFactura(detalleFac, index) {
            this.detalleFacturas.splice(index, 1);
            this.factura.valor_total -= detalleFac.valor_total;
        },
        iniciarEdicion(detalleFac, index) {
            this.editMode.editing = true;
            this.editMode.index = index;
            // this.detalleFactura.cantidad = detalleFac.cantidad;
            // this.detalleFactura.producto = detalleFac.producto;
            // this.detalleFactura.bodega = detalleFac.bodega;
            this.detalleFactura = detalleFac;
            this.producto = detalleFac.producto;
            this.bodega = detalleFac.bodega;
        },
        editarDetalleFactura() {
            this.detalleFactura.producto = this.producto;
            this.detalleFactura.bodega = this.bodega;
            this.detalleFacturas.splice(this.editMode.index, 1, this.detalleFactura);
            this.cancelarEdicion();
        },
        cancelarEdicion() {
            this.editMode.editing = false;
            this.editMode.index = null;
            this.limpiar();
        },
        limpiar() {
            this.detalleFactura = {};
            this.producto = {};
            this.bodega = {};
        },
        registrarFactura() {
            this.factura.sucursale_id = this.sucursal;
            this.axios
                .post("/api/facturas", this.factura)
                .then(response => {
                    this.$swal("Factura registrada correctamente.");
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
