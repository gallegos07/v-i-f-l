<template>
	<app-layout>
		<template>
			<v-breadcrumbs large class="mt-6">
				<v-breadcrumbs-item disabled>
					<inertia-link :href="route('books.index')" class="text-decoration-none">
						<h2>LIBROS</h2>
					</inertia-link>
				</v-breadcrumbs-item>
			</v-breadcrumbs>
		</template>
        <div class="ma-md-5 ma-sm-5">
			<v-card  elevation="4">
			<v-card-title>

				<v-text-field
					v-model="search"
					append-icon="mdi-magnify"
					label="Buscar..."
					single-line
					hide-details
				></v-text-field>

				<v-spacer></v-spacer>
				<v-btn color="primary" class="mt-5" depressed  @click="newBook">nuevo libro</v-btn>
			</v-card-title>
			

			<template>
				<v-data-table
					:headers="headers"
					:items="items"
					:search="search"
					:items-per-page="5"
					:loading="myLoading"
					
				>
					<!-- <template v-slot:item.actions="{ item }"> -->
						<template v-slot:[`item.actions`]="{ item }">
						<v-icon  @click="editTutorial(item.id)">
						mdi-file-document-edit-outline
						</v-icon>
					</template>
			
			
			</v-data-table>
			</template>


		</v-card>
		</div>
		
	</app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
export default {
	props: ["books"],
	components: {
		AppLayout,
	},
	created() {
		this.getBooks();
	},
	data() {
		return {
			search: "",
			myLoading: true,
			headers: [
				{ text: "ID", value: "id" },
				{ text: "TÍTULO", value: "title" },
				{ text: "AUTOR", value: "author" },
                { text: "ISBN", value: "isbn" },
				{ text: '', value: 'actions', sortable: false , align: 'end'},
			],
			// editedItem: {} 
		};
	},
	methods: {
		getBooks() {
			let arrayBooks = this.$props.books;
			this.items = arrayBooks;
			this.myLoading = false;
		},
        newBook() {
            this.$inertia.get(route('books.create'));
        },

		editTutorial(id) {
			let book = id
		  	this.$inertia.get(route('books.edit', book));
    	},
	},
};
</script>