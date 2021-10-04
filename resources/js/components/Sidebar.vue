<template>
	<div class="sidebar">
		<div class="d-flex flex-column flex-shrink-0 p-3 min-vh-100">
			<a
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
			<ul class="nav flex-column mb-auto">
				<li v-if="currentUser.nombre != null">
					<p class="text-center">
						{{ currentUser.nombre }} {{ currentUser.apellido }}
					</p>
				</li>
				<li class="nav-item">
					<router-link
						active-class="active"
						exact
						:to="{ name: 'dashboard' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-home"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#home"></use>
						</svg>
						Home
					</router-link>
				</li>
				<li>
					<router-link
						active-class="active"
						:to="{ name: 'facturas.index' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-file-invoice"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#table"></use>
						</svg>
						Facturas
					</router-link>
				</li>
				<li>
					<router-link
						active-class="active"
						:to="{ name: 'sucursales.index' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-building"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#table"></use>
						</svg>
						Sucursales
					</router-link>
				</li>
				<li>
					<router-link
						active-class="active"
						:to="{ name: 'bodegas.index' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-folder"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#speedometer2"></use>
						</svg>
						Bodegas
					</router-link>
				</li>
				<li>
					<router-link
						active-class="active"
						:to="{ name: 'productos.index' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-tags"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#table"></use>
						</svg>
						Productos
					</router-link>
				</li>
				<li>
					<router-link
						active-class="active"
						:to="{ name: 'roles.index' }"
						class="nav-link link-dark"
					>
						<i class="fas fa-users"></i>
						<svg class="bi me-2" width="5" height="16">
							<use xlink:href="#grid"></use>
						</svg>
						Roles
					</router-link>
				</li>
				<button @click="logout()" class="btn text-danger my-2">
					<i class="fas fa-sign-out-alt me-2"> Cerrar sesión </i>
				</button>
			</ul>
		</div>
	</div>
</template>
<script>
import Storage from "../utilities/Storage.js";
export default {
	name: "Sidebar",
	data() {
		return {
			currentUser: {},
			token: null,
		};
	},
	mounted() {
		if (Storage.has("token")) {
			this.token = Storage.get("token", false);
			window.axios.defaults.headers.common[
				"Authorization"
			] = `Bearer ${this.token}`;
			axios
				.get("/api/user")
				.then((res) => {
					this.currentUser = res.data;
				})
				.catch((err) => {
					console.log(err);
				});
		}
	},
	methods: {
		logout() {
			axios
				.post("/api/logout")
				.then((res) => {
					Storage.remove("token");
					this.$router.push("/login");
				})
				.catch((err) => {
					console.log(err);
				});
		},
	},
};
</script>