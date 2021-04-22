<template>
    <v-app app>
        <Navbar/>

        <v-main>
            <v-row>
                <v-col>
                    <slot></slot>
                </v-col>
            </v-row>
        </v-main>

    </v-app>




    <!-- <v-app id="inspire" app dark>
        <v-container class="my-auto">
            <Nav/>
            <v-main>
                <v-row>
                    <v-col>
                        <slot></slot>
                    </v-col>
                </v-row>
            </v-main>
        </v-container>
    </v-app> -->
    
</template>

<script>
import Navbar from '../components/Navbar'
export default {
	components: { 
        Navbar, 
    },
    data: () => ({
       
   }),
    
}
</script>

<style>
    html {overflow-y: auto}
</style>