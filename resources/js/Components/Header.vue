<template>
    <header class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                To Do List Application
            </h1>
            <nav v-if="$page.props.auth.user">
                <span class="mr-6 font-medium">Hello, {{ $page.props.auth.user.name }}</span>
                <Link :href="route('logout')" method="post" as="button" class="text-indigo-200 hover:text-white transition-colors">
                    Log Out
                </Link>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
