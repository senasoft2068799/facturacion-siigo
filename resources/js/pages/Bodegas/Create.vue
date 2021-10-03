<template>
  <div class="card">
    <div class="card-header">Registrar bodega</div>
    <div class="card-body">
      <form @submit.prevent="registrarBodega()">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre de bodega</label>
          <input
            type="text"
            class="form-control"
            id="nombre"
            v-model="bodega.nombre"
          />
          <p class="text-danger" v-if="errors.has('nombre')">
            {{ errors.get("nombre") }}
          </p>
        </div>
        <div class="mb-3">
          <label for="nombre" class="form-label">Dirección</label>
          <input
            type="text"
            class="form-control"
            id="direccion"
            v-model="bodega.direccion"
          />
          <p class="text-danger" v-if="errors.has('direccion')">
            {{ errors.get("direccion") }}
          </p>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea
            class="form-control"
            id="descripcion"
            rows="3"
            v-model="movimiento.descripcion"
          ></textarea>
          <p class="text-danger" v-if="errors2.has('descripcion')">
            {{ errors2.get("descripcion") }}
          </p>
        </div>
        <div class="mb-3">
          <label for="sucursal" class="form-label">Sucursal encargada</label>
          <select
            class="form-select"
            id="sucursal"
            v-model="movimiento.sucursale_id"
          >
            <option disabled value="null">Seleccionar...</option>
            <option
              v-for="(sucursal, index) in sucursales"
              :key="index"
              v-bind:value="sucursal.id"
            >
              {{ sucursal.nombre }}
            </option>
          </select>
          <p class="text-danger" v-if="errors2.has('sucursale_id')">
            {{ errors2.get("sucursale_id") }}
          </p>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <router-link :to="{ name: 'bodegas.index' }" class="btn btn-secondary"
          >Regresar</router-link
        >
      </form>
    </div>
    Movimiento: {{ movimiento }}
    <hr />
    Bodega: {{ bodega }}
    <hr />
    Errors: {{ errors }}
    <hr />
    Errors2: {{ errors2 }}
    <hr />
  </div>
</template>
<script>
import Errors from "../../utilities/Errors.js";
export default {
  data() {
    return {
      errors: new Errors(),
      errors2: new Errors(),
      bodega: {},
      movimiento: {
        sucursale_id: null,
      },
      sucursales: [],
    };
  },
  mounted() {
    //Mostrar lista de sucursales
    this.axios.get("/api/sucursales").then((res) => {
      this.sucursales = res.data.data;
    });
  },
  methods: {
    registrarBodega() {
      this.axios
        .post("/api/bodegas", this.bodega)
        .then((res) => {
          this.bodega = res.data;
          this.registrarMovimiento();
        })
        .catch((err) => {
          this.$swal({
            icon: "error",
            title: "Ha ocurrido un error:\n" + err,
          });
          this.errors.record(err.response.data.errors);
        });
    },
    registrarMovimiento() {
      this.movimiento.documento_id = 3;
      this.movimiento.estado = 1;
      this.axios
        .post("/api/movimientos", this.movimiento)
        .then((res) => {
          this.movimiento = res.data;
          this.registrarDetalleMovimiento();
        })
        .catch((err) => {
          console.log("Retornando :C");
          this.errors2.record(err.response.data.errors);
          return err;
        });
    },
    registrarDetalleMovimiento() {
      let detalleMovimiento = {
        movimiento_id: this.movimiento.id,
        bodega_id: this.bodega.id,
      };
      this.axios
        .post("/api/detalle-movimientos", detalleMovimiento)
        .then((res) => {
          this.$swal("Bodega registrada correctamente.");
          this.bodega = {};
          this.movimiento = {};
        })
        .catch((err) => {
          return err;
        });
    },
  },
};
</script>