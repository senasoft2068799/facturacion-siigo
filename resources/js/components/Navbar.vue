<template>
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