<template>
    <Head>
        <title>Users</title>
    </Head>

    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-4xl font-bold">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">New User</Link>
        </div>
        <input v-model="search" type="text" placeholder="Search ..." class="border px-2 rounded-lg">
    </div>


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template v-if="users.data.length !== 0">
                                <tr
                                    v-for="user in users.data" 
                                    :key="user.id" 
                                    
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900" v-text="user.name"></div>
                                                <div class="text-sm text-gray-500" v-text="user.email"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link v-if="can.editUser" :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</Link>
                                        <Link v-if="can.deleteUser" :href="`/users/${user.id}`" method="delete" as="button" class="text-red-600 hover:text-red-900">Delete</Link>
                                    </td>
                                </tr>
                            </template>
                            <tr v-else>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">No Data Available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <Pagination :links="users.links" class="mt-6"/>
</template>

<script setup>
import Pagination from '../../Shared/Pagination';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import debounce from 'lodash/debounce';

let props = defineProps({ 
    users: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(search, debounce(function(value){
    Inertia.get('/users', { search: value }, {
        preserveState: true,
        replace: true,
    });
}, 500))

</script>