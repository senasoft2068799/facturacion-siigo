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
								class="
									position-absolute
									start-100
									translate-middle
									badge
									rounded-pill
									bg-danger
								"
								>22</span
							>
						</a>
						<ul
							class="dropdown-menu dropdown-menu-end"
							aria-labelledby="notificaciones"
						>
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
						</ul>
					</li>
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
							class="dropdown-menu dropdown-menu-end"
							aria-labelledby="navbarDropdown"
						>
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>
<script>
export default {
	name: "Navbar",
};
</script>