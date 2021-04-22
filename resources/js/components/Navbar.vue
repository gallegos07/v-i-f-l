<template>
<div>
<v-navigation-drawer v-model="drawer" app><!-- no borrar --></v-navigation-drawer>
            <v-app-bar  color="indigo accent-3" dense dark app  fixed>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
                <v-toolbar-title>Page title</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon>
                    <v-icon>mdi-heart</v-icon>
                </v-btn>
                <v-btn icon>
                    <v-icon>mdi-magnify</v-icon>
                </v-btn>
            </v-app-bar>

            <v-navigation-drawer v-model="drawer" temporary app>
                <v-list-item class="px-2">
                    <v-list-item-avatar>      
                        <v-icon x-large>mdi-shield-account-outline</v-icon>
                    </v-list-item-avatar>
                    <v-list-item-title v-if="$page.props.user.name">
                        {{ $page.props.user.name }}
                    </v-list-item-title>     
                </v-list-item>
                <v-divider></v-divider>

                <v-list nav dense>
                    <v-list-item-group>

                       <inertia-link :href="route('dashboard')" class="text-decoration-none">
                        <v-list-item :class="route().current('dashboard') ? 'v-list-item--active indigo--text text--accent-4' : '' "> 
                            <v-list-item-icon>
                                <v-icon>mdi-speedometer</v-icon>
                            </v-list-item-icon>
                        Inicio
                        </v-list-item>
                        </inertia-link>    
                        
                       
                        <inertia-link :href="route('test')" class="text-decoration-none">
                        <v-list-item :class="route().current('test') ? 'v-list-item--active indigo--text text--accent-4' : '' "> 
                            <v-list-item-icon>
                                <v-icon>mdi-home-outline</v-icon>
                            </v-list-item-icon>
                            Test
                        </v-list-item>
                        </inertia-link>

                        <inertia-link :href="route('books.index')" class="text-decoration-none">
                        <v-list-item :class="route().current('books.*') ? 'v-list-item--active indigo--text text--accent-4' : '' "> 
                            <v-list-item-icon>
                                <v-icon>mdi-book-outline</v-icon>
                            </v-list-item-icon>
                            LIBROS
                        </v-list-item>
                        </inertia-link>

                        <!-- <inertia-link href="/users" :only="['users']">Show active</inertia-link> -->

                    </v-list-item-group>
                </v-list>

                <template v-slot:append>
                <div class="pa-2">
                    <v-btn class="mb-1" color="indigo lighten-5" block elevation="4" @click="logout">Cerrar sesión</v-btn>
                </div>
                </template>
</v-navigation-drawer> 
  
</div>

</template>

<script>
let user = document.head.querySelector('meta[name = "user"]');
export default {
    data: () => ({
        drawer: false,
        group: null ,
   }),
   methods: {
        logout() {
            this.$inertia.post(route('logout'));
        }
   },
//    computed:{
//       user() {
//          return JSON.parse(user.content);
//       }
//    },
}
</script>

<style>
.bg-active {
  background-color: black;
  color : white !important;
}
</style>