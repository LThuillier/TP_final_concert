<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ tickets: Array });
</script>

<template>
    <Head title="Mes Billets" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mes Billets de Concert</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Liste de vos billets</h3>
                        <Link :href="route('tickets.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Acheter un billet
                        </Link>
                    </div>
                    <ul v-if="tickets.length > 0" class="divide-y divide-gray-200">
                        <li v-for="ticket in tickets" :key="ticket.id" class="py-4">
                            <div class="font-bold text-lg">{{ ticket.title }}</div>
                            <div class="text-gray-500">{{ ticket.description }}</div>
                            <div class="text-sm mt-2">
                                Statut: <span class="bg-green-100 text-green-800 px-2 py-1 rounded">{{ ticket.status }}</span>
                            </div>
                        </li>
                    </ul>
                    <p v-else class="text-gray-500">Vous n'avez pas encore de billets.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>