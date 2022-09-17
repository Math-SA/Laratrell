<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed w-1/4  top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('workspace')" class="text-sm text-gray-700 dark:text-gray-500 underline">Workspace</Link>

            <template v-else>
                <div class="flex flex-col-2 justify-between">
                    <div class="animate-ping px-16 max-w-xs">></div>
                    <div>
                        <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
                    </div>
                </div>
                
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1">
                    
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <a href="https://github.com/Math-SA/Laratrell" class="underline text-gray-900 dark:text-white">Laratrell</a>
                            </div>
                        </div>

                        <div class="ml-8">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                <p>Laratrell is a <a href="https://trello.com/" class="underline text-gray-900 dark:text-white">Trello</a> inspired project, part of <a href="https://devplay.com.br/" class="underline text-gray-900 dark:text-white">Devplay</a>'s software developer training program. </p>
                                <p>It is a kanban style task manager created using <a href="https://laravel.com/" class="underline text-gray-900 dark:text-white">Laravel</a> + <a href="https://jetstream.laravel.com/2.x/introduction.html" class="underline text-gray-900 dark:text-white">Jetstream </a>
                                  (<a href="https://inertiajs.com/" class="underline text-gray-900 dark:text-white">Inertia </a>
                                  /<a href="https://vuejs.org/" class="underline text-gray-900 dark:text-white">Vue</a>).</p>
                                
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
