<template>
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
			<li>
				<div>
					<h6 class="dropdown-header text-left">
						Notificaciones<a @click="markAsRead()" class="text-right"
							>Marcar todo como leído</a
						>
					</h6>
				</div>
			</li>
			<div v-if="unreadNotifications.length > 0">
				<NotificationItem
					v-for="item in unreadNotifications"
					:key="item.id"
					:item="item"
				/>
			</div>
			<div v-else>
				<li>
					<a class="dropdown-item">No hay notificaciones nuevas.</a>
				</li>
			</div>
		</ul>
	</li>
</template>
<script>
import NotificationItem from "./NotificationItem.vue";
export default {
	name: "Notifications",
	components: {
		NotificationItem,
	},
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
		formatCurrency(number) {
			var formatted = 0;
			if (!isNaN(number)) {
				formatted = new Intl.NumberFormat("es-CO", {
					style: "currency",
					currency: "COP",
				}).format(number);
			}
			return formatted;
		},
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
