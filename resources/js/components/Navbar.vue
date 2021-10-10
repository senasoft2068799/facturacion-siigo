<template>
<<<<<<< HEAD
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid my-1">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="fas fa-align-justify"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <Notifications />
          <li class="nav-item dropdown me-3">
            <a
              class="nav-link dropdown-toggle link-dark"
              href="#"
              id="navbarDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <i class="fas fa-user"></i>
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end py-0"
              aria-labelledby="navbarDropdown"
            >
              <p id="menu-user" class="bg-primary text-white fw-bold">
                Administrador
              </p>
              <li>
                <div class="d-flex">
                  <i id="user" class="fas fa-user mx-3"></i>
                  <small class="fw-bold">Sebastián Alarcón<br> 1291829</small>
                </div>
              </li>
              <li v-if="currentUser.nombre != null">
                <i class="fas fa-user"></i>
                <p class="fs-6 fw-bold text-primary text-center mb-2 p-0">
                  {{ currentUser.nombre }} {{ currentUser.apellido }}
                  <br />
                  {{ currentUser.id }}
                </p>
              </li>
              <li class="mt-3"><hr class="dropdown-divider"/></li>
              <button @click="logout()" id="btn-logout">
                <i class="fas fa-sign-out-alt me-2"> Cerrar sesión </i>
              </button>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
=======
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid my-1">
			<button
				class="navbar-toggler"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<span class="fas fa-align-justify"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto">
					<Notifications />
					<CurrentUser />
				</ul>
			</div>
		</div>
	</nav>
>>>>>>> 2c47b74682ef3e36ca5aacac45aaf10fefc6881f
</template>
<script>
import Notifications from "./Notifications.vue";
import CurrentUser from "./CurrentUser.vue";
export default {
	components: {
		Notifications,
		CurrentUser,
	},
	name: "Navbar",
};
</script>