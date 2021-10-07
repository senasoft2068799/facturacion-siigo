<template>
  <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-white bg-dark rounded">
          <div class="d-flex">
            <i class="fas fa-building fs-3 pt-3 ps-2"></i>
            <div class="ms-4">
              <h4 class="card-title">Bodegas</h4>
              <p class="card-text">
                Cantidad de Bodegas: <strong class="fs-5">12000</strong>
              </p>
            </div>
          </div>
          <div class="card-footer">
            <router-link exact :to="{ name: 'bodegas.index' }">
              <svg class="bi me-2" width="5" height="16">
                <use xlink:href="#table"></use>
              </svg>
              Bodegas
            </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body bg-light rounded">
          <div class="d-flex">
            <i class="fas fa-file fs-3 pt-3 ps-2"></i>
            <div class="ms-4">
              <h4 class="card-title">Facturas</h4>
              <p class="card-text">
                Cantidad de facturas: <strong class="fs-5">120000</strong>
              </p>
            </div>
          </div>
          <div class="card-footer">
            <router-link exact :to="{ name: 'facturas.index' }">
              <svg class="bi me-2" width="5" height="16">
                <use xlink:href="#table"></use>
              </svg>
              Proveedores
            </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body rounded">
          <div class="d-flex">
            <i class="fas fa-user fs-3 pt-3 ps-2"></i>
            <div class="ms-4">
              <h4 class="card-title">Clientes</h4>
              <p class="card-text">
                Cantidad de clientes: <strong class="fs-5">1000</strong>
              </p>
            </div>
          </div>
          <div class="card-footer">
            <router-link exact :to="{ name: 'usuarios.index' }">
              <svg class="bi me-2" width="5" height="16">
                <use xlink:href="#table"></use>
              </svg>
              Clientes
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>