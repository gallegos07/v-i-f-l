<template>
	<app-layout>
		<h2 class="text-center mb-3" v-if="$page.props.user.name">
			Welcome to your dashboard, {{ $page.props.user.name }}
		</h2>

		<v-card>
			<v-card-title>
				<v-text-field
					v-model="search"
					append-icon="mdi-magnify"
					label="Buscar..."
					single-line
					hide-details
				></v-text-field>
			</v-card-title>
			<v-data-table
				:headers="headers"
				:items="items"
				:search="search"
				:items-per-page="5"
				:loading="myLoading"
			></v-data-table>
		</v-card>
	</app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
export default {
	props: ["users"],
	created() {
		this.getUsers();
	},
	components: {
		AppLayout,
	},
	data() {
		return {
			search: "",
			myLoading: true,
			headers: [
				{ text: "ID", value: "id" },
				{ text: "NAME", value: "name" },
				{ text: "EMAIL", value: "email" },
			],
		};
	},
	methods: {
		getUsers() {
			let arrayUsers = this.$props.users;
			this.items = arrayUsers;
			this.myLoading = false;
		},
	},
};
</script>