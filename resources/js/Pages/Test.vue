<template>
    <app-layout>
        <h2 class="text-center mb-3" v-if="$page.props.user.name">
			Welcome to your other page, {{ $page.props.user.name }}
		</h2>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
export default {
    components: {
        AppLayout,
    }
}
</script>