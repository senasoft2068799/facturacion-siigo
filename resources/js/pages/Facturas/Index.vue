<template>
  <!-- <<<<<<< HEAD
  <div>
    <router-link class="btn btn-success mb-3" :to="{ name: 'facturas.create' }"
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
                class="btn btn-info btn-sm text-white"
                :to="{
                  name: 'facturas.show',
                  params: { id: factura.id },
                }"
                title="Detalles"
                ><i class="fas fa-info-circle"></i
              ></router-link>
              <router-link
                class="btn btn-warning btn-sm text-white"
                :to="{
                  name: 'facturas.edit',
                  params: { id: factura.id },
                }"
                title="Editar"
                ><i class="fas fa-edit"></i
              ></router-link>
              <button
                @click="eliminarSucursal(factura, index)"
                class="btn btn-danger btn-sm"
                title="Eliminar"
              >
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
======= -->
  <div>
    <router-link class="btn btn-primary mb-3" :to="{ name: 'facturas.create' }"
      >Registrar factura</router-link
    >
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Sucursal</th>
            <th>Cliente</th>
            <th>Valor + IVA</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(factura, index) in facturas" :key="index">
            <td>{{ factura.id }}</td>
            <td v-if="factura.descripcion">
              <p v-if="factura.descripcion.length > 20">
                {{ factura.descripcion.substring(0, 20) }}...
              </p>
              <p v-else>{{ factura.descripcion }}</p>
            </td>
            <td v-else>...</td>
            <td>{{ factura.sucursal.nombre }}</td>
            <td>{{ factura.user.nombre }} {{ factura.user.apellido }}</td>
            <td>{{ formatters.formatCurrency(factura.valor_total) }}</td>
            <td v-if="factura.estado_factura == 1" class="text-success">Finalizado</td>
            <td v-else class="text-danger">Borrador</td>
            <td>{{ factura.created_at }}</td>
            <td>{{ factura.updated_at }}</td>
            <td class="d-flex">
              <router-link
                class="btn btn-sm btn-warning"
                title="Detalles"
                :to="{
                  name: 'facturas.show',
                  params: { id: factura.id },
                }"
                ><i class="fas fa-eye"></i
              ></router-link>
              <router-link
                class="btn btn-sm btn-primary mx-2"
                :to="{
                  name: 'facturas.edit',
                  params: { id: factura.id },
                }"
                title="Editar"
                ><i class="fas fa-edit"></i
              ></router-link>
              <button
                @click="eliminarSucursal(factura, index)"
                class="btn btn-sm btn-danger"
                title="Inactivar"
              >
                <i class="fas fa-ban"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import Formatters from "../../utilities/Formatters.js";
export default {
  data() {
    return {
      formatters: new Formatters(),
      facturas: [],
    };
  },
  created() {
    this.axios.get("/api/facturas").then((response) => {
      this.facturas = response.data.data;
    });
  },
  methods: {
    eliminarSucursal(factura, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se inactivará la factura con código: " + factura.id,
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("/api/facturas/" + factura.id)
            .then((response) => {
              this.facturas[index].estado_factura = 0;
              this.facturas.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Factura inactivada.",
              });
            })
            .catch((err) => {
              this.$swal({
                icon: "error",
                title: "Ha ocurrido un error:\n" + err,
              });
            });
        }
      });
    },
  },
};
</script>
