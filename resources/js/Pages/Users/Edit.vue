<template>
    <Head title="Edit User"/>

    <h1 class="3xl">Edit User</h1>

    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
            <input v-model="formUser.name" type="text" name="name" id="name"  class="border border-gray-400 p-2 w-full">
            <div v-if="formUser.errors.name" v-text="formUser.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
            <input v-model="formUser.email" type="email" name="email" id="email"  class="border border-gray-400 p-2 w-full">
            <div v-if="formUser.errors.email" v-text="formUser.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="formUser.processing">Submit</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

let props = defineProps({
    user: Array,
})

let formUser = useForm({
    name: props.user.name,
    email: props.user.email,
});

let submit = () => {
    formUser.post(`/users/${props.user.id}`)
};
</script>