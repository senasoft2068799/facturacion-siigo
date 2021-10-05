<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid my-1">
      <button type="button" id="sidebarCollapse" class="btn btn-primary ml-2">
        <i class="fas fa-align-justify me-2"></i>Menú
      </button>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="pi pi-align-justify"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="navbar-nav text-center"></div>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  name: "Navbar",
};
</script>
