<template>
  <div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Cantidad</th>
            <th>Bodega</th>
            <th>Producto</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(stock, index) in stocks" :key="index">
            <td>{{ stock.cantidad }}</td>
            <td>{{ stock.bodega.id }}</td>
            <td>{{ stock.producto.id }}</td>
            <td>
              <button
                @click="agregar(stock, index)"
                class="btn btn-sm btn-success"
                title="Activar"
              >
                <i class="fas fa-check"></i>
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
      stocks: [],
    };
  },
  created() {
    this.axios.get("/api/stocks").then((response) => {
      this.stocks = response.data.data;
    });
  },
  methods: {
    agregar(stock, index) {
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se agregará: '" + stock.cantidad + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .put("/api/stocks/" + stock.id)
            .then((response) => {
              this.stocks[index].cantidad ++;
              this.stocks.indexOf(index, 1);
              this.$swal({
                icon: "success",
                title: "Usuario activado.",
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