<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans text-gray-900">
        <Header />

        <main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 py-8">
            <div class="max-w-md w-full bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
                <svg class="w-16 h-16 text-indigo-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">My ToDo List</h1>
                <p class="text-gray-500 mb-8">Organize your tasks and stay productive.</p>
                
                <div v-if="canLogin" class="flex flex-col space-y-3">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition"
                    >
                        Go to Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="w-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded transition"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </main>

        <Footer />
    </div>
</template>
