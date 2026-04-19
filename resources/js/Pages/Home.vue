<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    appName: {
        type: String,
        default: 'FestivApp',
    },
    canLogin: {
        type: Boolean,
        default: false,
    },
    canRegister: {
        type: Boolean,
        default: false,
    },
    tickets: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head :title="appName" />

    <div class="min-h-screen bg-gradient-to-b from-amber-50 via-white to-sky-50 text-slate-900">
        <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-3 px-4 py-4 sm:grid-cols-3 sm:px-6 lg:px-8">
                <p class="hidden text-sm font-semibold text-slate-500 sm:block">
                    Billets de concert
                </p>

                <h1 class="text-center text-2xl font-black tracking-wide">
                    {{ appName }}
                </h1>

                <nav class="flex items-center justify-center gap-2 sm:justify-end">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('tickets.index')"
                            class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900"
                        >
                            Mes billets
                        </Link>
                        <Link
                            :href="route('tickets.create')"
                            class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700"
                        >
                            Nouveau billet
                        </Link>
                    </template>

                    <template v-else>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900"
                        >
                            Register
                        </Link>
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700"
                        >
                            Log in
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <section class="rounded-3xl bg-slate-900 px-6 py-10 text-white shadow-xl sm:px-10">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-300">
                    Page principale
                </p>
                <h2 class="mt-3 text-3xl font-black sm:text-4xl">
                    Decouvre les differents billets de concert
                </h2>
                <p class="mt-4 max-w-2xl text-sm text-slate-200 sm:text-base">
                    Choisis ton offre, cree ton compte et gere tes billets facilement dans l'application.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('tickets.create')"
                            class="rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-100"
                        >
                            Acheter un billet
                        </Link>
                        <Link
                            :href="route('tickets.index')"
                            class="rounded-full border border-slate-400 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white"
                        >
                            Voir mes billets
                        </Link>
                    </template>

                    <template v-else>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-100"
                        >
                            Creer un compte
                        </Link>
                        <Link
                            v-if="canLogin"
                            :href="route('login')"
                            class="rounded-full border border-slate-400 px-5 py-2.5 text-sm font-semibold text-white transition hover:border-white"
                        >
                            Se connecter
                        </Link>
                    </template>
                </div>
            </section>

            <section class="mt-10">
                <div class="mb-5 flex items-center justify-between">
                    <h3 class="text-2xl font-black">Billets disponibles</h3>
                    <Link
                        :href="route('home')"
                        class="text-sm font-semibold text-slate-600 transition hover:text-slate-900"
                    >
                        Accueil
                    </Link>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <article
                        v-for="ticket in tickets"
                        :key="ticket.id"
                        class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
                    >
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="text-lg font-bold text-slate-900">
                                {{ ticket.title }}
                            </h4>
                            <span
                                class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-bold uppercase text-emerald-700"
                            >
                                {{ ticket.status }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm text-slate-600">
                            {{ ticket.description }}
                        </p>

                        <div class="mt-5">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('tickets.create')"
                                class="inline-flex items-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900"
                            >
                                Reserver ce billet
                            </Link>
                            <Link
                                v-else-if="canRegister"
                                :href="route('register')"
                                class="inline-flex items-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900"
                            >
                                S inscrire pour reserver
                            </Link>
                            <Link
                                v-else-if="canLogin"
                                :href="route('login')"
                                class="inline-flex items-center rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900"
                            >
                                Se connecter
                            </Link>
                        </div>
                    </article>
                </div>
            </section>

            <section class="mt-10 grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h4 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                        Sprint backlog
                    </h4>
                    <p class="mt-2 text-sm text-slate-700">
                        Consulter les billets et preparer l'achat.
                    </p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h4 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                        Sprint en cours
                    </h4>
                    <p class="mt-2 text-sm text-slate-700">
                        Creer un billet puis verifier son statut.
                    </p>
                </article>
                <article class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h4 class="text-sm font-bold uppercase tracking-wide text-slate-500">
                        Validation
                    </h4>
                    <p class="mt-2 text-sm text-slate-700">
                        Tester les parcours Register, Log in et billets.
                    </p>
                </article>
            </section>
        </main>
    </div>
</template>
