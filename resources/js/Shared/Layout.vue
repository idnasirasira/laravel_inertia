<template>
    <head>
        <title>App</title>
        <meta name="description" content="Description of my app" head-key="description">
    </head>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
                <p class="text-sm ml-4">Welcome Back, {{ username }}</p>
            </div>
            <Nav />
        </header>
    </section>
    
    <section>
        <div class="max-w-3xl mx-auto py-6">
            <slot />
        </div>
    </section>
</template>

<script>
import Nav from './Nav';
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: { Nav, Head },   
    
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}
</script>