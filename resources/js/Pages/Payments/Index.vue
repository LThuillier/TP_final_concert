<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    payments: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Mes Paiements" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mes Paiements
                </h2>
                <div class="flex gap-2">
                    <Link
                        :href="route('payments.create')"
                        class="rounded-md bg-slate-900 px-3 py-1.5 text-sm font-semibold text-white transition hover:bg-slate-700"
                    >
                        Nouveau paiement
                    </Link>
                    <Link
                        :href="route('home')"
                        class="rounded-md border border-slate-300 px-3 py-1.5 text-sm font-semibold text-slate-700 transition hover:border-slate-500"
                    >
                        Accueil
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <ul v-if="payments.length" class="divide-y divide-gray-200">
                        <li
                            v-for="payment in payments"
                            :key="payment.id"
                            class="py-4 flex items-center justify-between"
                        >
                            <div>
                                <p class="text-sm text-slate-500">Paiement #{{ payment.id }}</p>
                                <p class="font-semibold text-slate-900">
                                    {{ Number(payment.amount).toFixed(2) }} EUR
                                </p>
                            </div>
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold uppercase text-amber-700">
                                {{ payment.status }}
                            </span>
                        </li>
                    </ul>
                    <p v-else class="text-slate-500">
                        Aucun paiement enregistre pour le moment.
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
