<template>
	<app-layout>

		<template>
			<v-breadcrumbs large class="mt-6">
				<v-breadcrumbs-item >
					<inertia-link :href="route('books.index')" class="text-decoration-none">
						<p class="headline font-weight-bold">LIBROS</p>
					</inertia-link>
					<p class="ml-4 headline font-weight-bold indigo--text" >/</p>
				</v-breadcrumbs-item>
				<v-breadcrumbs-item>
					<p class="headline font-weight-bold">CREAR</p>
				</v-breadcrumbs-item>
			</v-breadcrumbs>
		</template>

		<template>
			<div class="ma-5">
			<v-card class="mx-auto pa-5" elevation="2">
				<v-form @submit.prevent="save" v-model="valid" lazy-validation ref="form"> 
					<v-text-field label="TÍTULO" v-model="form.title" :counter="40" :rules="allErrors.title"></v-text-field>
					<v-text-field label="AUTOR" v-model="form.author" :counter="35" :rules="allErrors.author"></v-text-field>
					<v-text-field label="ISBN" v-model="form.isbn" :counter="13" :rules="allErrors.isbn"> </v-text-field>
					<v-flex class="text-right">
						<v-btn class="mt-6" depressed color="primary" type="submit">Guardar</v-btn>
					</v-flex>
				</v-form>
			</v-card>
			</div>
		</template>


		<template>
			<div class="text-center ma-2">
			<v-snackbar v-model="snackbar" :timeout="timeout" color="indigo" absolute>
			{{ messageSnackbar }}
				<template v-slot:action="{ attrs }">
					<v-btn color="white" text v-bind="attrs" @click="snackbar = false">
						Cerrar
					</v-btn>
				</template>
			</v-snackbar>
			</div>
		</template>

	</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";

export default {
	props: {
    	errors: Object,
  	},
	components: {
		AppLayout,
	},
	data:() => ({
		valid: true,
		allErrors: [],
		form: {
			title: '',
			author: '',
			isbn: '',
		},
		snackbar: false,
        messageSnackbar:'',
		timeout: 2500,
	}),

	methods: {
		save: function () {
			const data = { title: this.form.title, author: this.form.author, isbn: this.form.isbn} 
			 axios.post('/books', data)
			.then(response => {
				this.snackbar = true
				this.messageSnackbar = '¡Creado exitosamente!'
				this.$refs.form.reset()
			})
			.catch(error => {
				if (error.response && error.response.status === 422) {                   
					this.allErrors = error.response.data.errors;  
					this.$refs.form.validate()             
				} else {
					console.log(error);
				}
			});
		},
		
	},
};
</script>