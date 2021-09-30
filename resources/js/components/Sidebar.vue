<template>
  <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
    <div class="d-flex flex-column flex-shrink-0 p-3 min-vh-100">
      <a
        href="/"
        class="
          d-flex
          align-items-center
          mb-3 mb-md-0
          me-md-auto
          link-dark
          text-decoration-none
        "
      >
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Logo</span>
      </a>
      <hr />
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <router-link
            active-class="active"
            exact
            :to="{ name: 'dashboard' }"
            class="nav-link link-dark"
          >
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#home"></use>
            </svg>
            Home
          </router-link>
        </li>
        <li>
          <router-link
            active-class="active"
            exact
            :to="{ name: 'facturas.index' }"
            class="nav-link link-dark"
          >
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#table"></use>
            </svg>
            Facturas
          </router-link>
        </li>
        <li>
          <router-link
            active-class="active"
            exact
            :to="{ name: 'documentos.index' }"
            class="nav-link link-dark"
          >
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#speedometer2"></use>
            </svg>
            Documentos
          </router-link>
        </li>
        <li>
          <router-link
            active-class="active"
            exact
            :to="{ name: 'sucursales.index' }"
            class="nav-link link-dark"
          >
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#table"></use>
            </svg>
            Sucursales
          </router-link>
        </li>
        <li>
          <router-link
            active-class="active"
            exact
            :to="{ name: 'roles.index' }"
            class="nav-link link-dark"
          >
            <svg class="bi me-2" width="16" height="16">
              <use xlink:href="#grid"></use>
            </svg>
            Roles
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "Sidebar",
};
</script>
