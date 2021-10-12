<template>
  <div>
    <div class="table-responsive">
      <table id="table" class="table table-bordered table-hover">
        <thead class="table-dark text-center">
          <tr>
            <th>Bodega</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Entradas</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(stock, index) in stocks" :key="index">
            <td>{{ stock.bodega.nombre }}</td>
            <td>{{ stock.producto.nombre }}</td>
            <td>{{ stock.cantidad }}</td>
            <td class="text-center">
              <input
                type="number"
                id="entradas"
                class="w-50 me-3"
                v-model.number="entrada"
              />
              <button
                @click="agregar(stock, entrada, index)"
                class="btn btn-sm btn-success"
                title="Añadir"
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
      entrada: null,
      stocks: [],
    };
  },
  created() {
    this.axios.get("/api/stocks").then((response) => {
      this.stocks = response.data.data;
    });
  },
  methods: {
    agregar(stock, entrada, index) {
      let resultado = this.stocks[index].cantidad + entrada;
      this.$swal({
        title: "¿Estás seguro?",
        text: "Se agregará: '" + stock.cantidad + "'" + "' + " + entrada + "'",
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .put("/api/stocks/" + stock.id)
            .then((response) => {
              this.stocks[index].cantidad++;
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