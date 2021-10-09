<template>
	<li>
		<router-link
			:to="{
				name: item.data.route,
				params: { id: item.data.id },
			}"
			class="dropdown-item"
			><h5>{{ item.data.titulo }}</h5>
			{{ item.data.descripcion }}
			<small class="text-success">({{ item.data.informacion }})</small>
			<br />
			<small class="text-muted">
				{{ item.created_at }}
			</small>
		</router-link>
	</li>
</template>
<script>
export default {
	name: "NotificationItem",
	props: {
		item: {
			type: Object,
			required: true,
		},
	},
};
</script>