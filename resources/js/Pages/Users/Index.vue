<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    users: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Utilisateurs" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Utilisateurs
                </h2>
                <Link
                    :href="route('home')"
                    class="rounded-md border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 transition hover:border-slate-500"
                >
                    Accueil
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead>
                                <tr class="text-left text-xs uppercase text-slate-500">
                                    <th class="px-2 py-3">Nom</th>
                                    <th class="px-2 py-3">Email</th>
                                    <th class="px-2 py-3">Tickets</th>
                                    <th class="px-2 py-3">Paiements</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                <tr v-for="user in users" :key="user.id">
                                    <td class="px-2 py-3 font-medium text-slate-900">{{ user.name }}</td>
                                    <td class="px-2 py-3 text-slate-600">{{ user.email }}</td>
                                    <td class="px-2 py-3">{{ user.tickets_count }}</td>
                                    <td class="px-2 py-3">{{ user.payments_count }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
