<template>
    <Head title="Login"/>

    <main class="flex items-center justify-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border border-gray-200">
            <h1 class="text-3xl mb-4">Login</h1>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                    <input v-model="loginForm.email" type="email" name="email" id="email"  class="border border-gray-400 p-2 w-full">
                    <div v-if="loginForm.errors.email" v-text="loginForm.errors.email" class="text-red-500 text-xs mt-1"></div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                    <input v-model="loginForm.password" type="password" name="password" id="password"  class="border border-gray-400 p-2 w-full">
                    <div v-if="loginForm.errors.password" v-text="loginForm.errors.password" class="text-red-500 text-xs mt-1"></div>
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="loginForm.processing">Login</button>
                </div>
            </form>
        </section>
    </main>
</template>

<script>
export default {
    layout: null,
}
</script>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3';

let loginForm = useForm({
    email: '',
    password: '',
});

let submit = () => {
    loginForm.post('/login');
}

</script>