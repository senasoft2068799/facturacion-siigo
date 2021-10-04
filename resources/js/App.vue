<template>
	<div>
		<Navbar />
		<div class="container-fluid">
			<div class="row flex-nowrap">
				<Sidebar />
				<main class="col py-3">
					<div class="container">
						<router-view></router-view>
					</div>
				</main>
			</div>
		</div>
	</div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import Sidebar from "./components/Sidebar.vue";
import Footer from "./components/Footer.vue";

export default {
	name: "App",
	components: {
		Navbar,
		Sidebar,
		Footer,
	},
};
</script>
