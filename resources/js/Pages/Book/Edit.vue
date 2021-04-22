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
					<p class="headline font-weight-bold">EDITAR</p>	
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
							<v-btn class="mr-4 mt-6" depressed @click="dialog = true" :disabled="isDeleted">Eliminar</v-btn>
							<v-btn class="mt-6" depressed color="primary" type="submit" :disabled="isDeleted">Guardar</v-btn>
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
				<v-btn color="white" text v-bind="attrs" @click="snackbar = false">Cerrar</v-btn>
			</template>
			</v-snackbar>
		</div>
	</template>

	<template>
	<v-row justify="center">
		<v-dialog v-model="dialog" persistent max-width="380">
		<div class="text-center">
			<v-card>
				<v-card-text class="text-body-1 font-weight-bold mb-4">
				¿Está seguro de querer eliminar este libro?
				</v-card-text>
				<v-btn class="ma-1" color="grey" text @click="dialog = false">Cancelar</v-btn>
				<v-btn class="ma-1" color="error" text @click="deleteConfirm">Elimínalo</v-btn>
			</v-card>
		</div>
		</v-dialog>
	</v-row>
	</template>
		
	</app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";

export default {
    props: ["book"],
	components: {
		AppLayout,
	},
    data () {
        return {
           valid: true,
		    allErrors: [],
		    form: this.$props.book ,
			snackbar: false,
            messageSnackbar:'',
			timeout: 2500,
			isDeleted: false,
			dialog: false
        }
    },
    methods : {
        save: function () {
            let id =  this.$props.book.id//id del response en database
            let url = "http://v_i_f_l.test/books" + '/' + id
			const data = { id:this.$props.book.id, title: this.form.title, author: this.form.author, isbn: this.form.isbn} 
			 axios.put(url, data)
			.then(response => {
				// this.$inertia.get(route('books.index'));
				this.snackbar = true
				this.messageSnackbar = '¡Actualizado exitosamente!'
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
		deleteConfirm: function() {
			let id =  this.$props.book.id//id del response en database
            let url = "http://v_i_f_l.test/books" + '/' + id
			axios.delete(url)
			.then(response => {
				this.dialog = false
				this.isDeleted = true
				this.snackbar = true
				this.messageSnackbar = '¡Eliminado exitosamente!'
				setTimeout(() => {
				this.$inertia.get(route('books.index'));
				}, 2500);
			})
			.catch(error => {
				console.log(error)
			});
		}
        
    }
};
</script>