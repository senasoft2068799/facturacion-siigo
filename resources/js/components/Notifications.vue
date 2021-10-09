<template>
	<div>
		<li class="nav-item dropdown me-3">
			<a
				class="nav-link link-dark position-relative"
				id="notificaciones"
				role="button"
				data-bs-toggle="dropdown"
				aria-expanded="false"
			>
				<i class="fas fa-bell"></i
				><span
					v-show="unreadNotifications.length > 0"
					class="
						position-absolute
						start-100
						translate-middle
						badge
						rounded-pill
						bg-danger
					"
					>{{ unreadNotifications.length }}</span
				>
			</a>
			<ul
				class="dropdown-menu dropdown-menu-end"
				aria-labelledby="notificaciones"
			>
				<li><h6 class="dropdown-header">Notificaciones</h6></li>
				<li v-if="unreadNotifications.length > 0">
					<a
						v-for="(item, index) in unreadNotifications"
						:key="index"
						class="dropdown-item"
						>Nueva notificación
						<!-- Se creó el usuario {{ item.data.usuarioCreado.nombre }}
						{{ item.data.usuarioCreado.apellido }} -->
						<br />
						<small class="text-muted">
							{{ item.data.usuarioCreado.created_at }}
						</small></a
					>
				</li>
				<li v-else>
					<a class="dropdown-item">No hay notificaciones nuevas.</a>
				</li>
			</ul>
		</li>
	</div>
</template>
<script>
export default {
	name: "Notifications",
	mounted() {
		this.getNotifications();
		this.interval = setInterval(
			function () {
				this.getNotifications();
			}.bind(this),
			5000
		);
	},
	data() {
		return {
			unreadNotifications: {},
		};
	},
	methods: {
		getNotifications() {
			this.axios
				.get("/api/unread-notifications")
				.then((res) => {
					this.unreadNotifications = res.data;
				})
				.catch((err) => {
					console.log(err);
				});
		},
		markAsRead() {
			if (this.unreadNotifications.length > 0) {
				this.axios
					.get("/api/mark-as-read")
					.then((res) => {
						this.getNotifications();
					})
					.catch((err) => {
						console.log(err);
					});
			}
		},
	},
};
</script>
