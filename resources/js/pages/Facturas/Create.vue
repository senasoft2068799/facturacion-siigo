<template>
    <div>
        <div class="card mb-3">
            <div class="card-header">Registrar factura</div>
            <div class="card-body">
                <form @submit.prevent="registrarFactura">
                    <!-- Factura -->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sucursal" class="form-label"
                                >Sucursal</label
                            >
                            <select
                                class="form-select"
                                id="sucursal"
                                v-model="detalleFactura.sucursal_id"
                            >
                                <option disabled value="null">Seleccionar sucursal...
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
                                v-model="detalleFactura.cliente_id"
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
                                            @click="agregarDetalleFactura"
                                            class="btn btn-success btn-sm"
                                            title="Agregar"
                                            type="button"
                                        >
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                        <button
                                            @click="limpiar"
                                            class="btn btn-secondary btn-sm"
                                            title="Limpiar"
                                            type="button"
                                        >
                                            <i class="fas fa-eraser"></i>
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
                                                detalleFac.producto
                                                    .precio_unitario *
                                                    detalleFac.cantidad *
                                                    1.19
                                            }}
                                        </p>
                                        <p v-else>
                                            -
                                        </p>
                                    </td>
                                    <td>
                                        <button
                                            @click="
                                                editarDetalleFactura(
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
                                                eliminarDetalleFactura(index)
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
            sucursales: [],
            productos: [],
            producto: {},
            bodegas: [],
            bodega: {},
            factura: {
                documento_id: 1,
                sucursale_id: null,
                valor_total: null,
                user_id: 1,
                estado: 1
            },
            detalleFacturas: [],
            detalleFactura: {
                movimiento_id: 1,
                sucursal_id: null,
                producto_id: null,
                cantidad: null,
                bodega_id: null
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
            this.detalleFactura.producto = this.producto;
            this.detalleFactura.bodega = this.bodega;
            this.detalleFacturas.splice(0, 0, this.detalleFactura);
            this.limpiar();
        },
        eliminarDetalleFactura(index) {
            this.detalleFacturas.splice(index, 1);
        },
        editarDetalleFactura(detalleFac, index){
            this.detalleFactura = detalleFac;
            //this.producto = this.detalleFactura.producto;
            //this.bodega = this.detalleFactura.bodega;
        },
        limpiar() {
            this.detalleFactura = {};
            this.producto = {};
            this.bodega = {};
        },
        registrarFactura() {
            console.log("Registrando...");
        }
        /*registrarFactura() {
            this.axios
                .post("/api/facturas", this.factura)
                .then(response => {
                    this.$swal("Factura registrada correctamente.");
                    this.factura.sucursale_id = null;
                    this.factura.valor_total = null;
                    this.factura.ciudade_id = null;
                })
                .catch(err => {
                    this.$swal({
                        icon: "error",
                        title: "Ha ocurrido un error:\n" + err
                    });
                });
        }*/
    }
};
</script>
