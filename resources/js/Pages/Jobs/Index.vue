<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';

const { props } = usePage();
const __ = (key) => props.translations.messages[key] || key;

defineProps({
    jobs: Array
});

const deleteJob = (id) => {
    if (confirm(__('are_you_sure'))) {
        router.delete(route('jobs.destroy', id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head :title="__('all_jobs')" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('all_jobs') || 'الوظائف المتاحة' }}
                </h2>
                <Link :href="route('jobs.create')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    + {{ __('create_job') }}
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-100 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                
                <div v-for="job in jobs" :key="job.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-blue-900 mb-2">{{ job.title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ job.description }}</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <span>👤 {{ job.user?.name }}</span>
                                <span>💰 {{ job.budget }}$</span>
                                <span>📅 {{ new Date(job.created_at).toLocaleDateString() }}</span>
                            </div>

                            <div v-if="job.user_id === $page.props.auth.user.id" class="mt-4 flex gap-4 border-t pt-3">
                                <Link :href="route('jobs.edit', job.id)" class="text-blue-600 hover:text-blue-800 text-sm font-bold flex items-center gap-1">
                                    📝 {{ __('edit') }}
                                </Link>
                                <button @click="deleteJob(job.id)" class="text-red-600 hover:text-red-800 text-sm font-bold flex items-center gap-1">
                                    🗑️ {{ __('delete') }}
                                </button>
                            </div>
                        </div>

                        <div class="ml-4">
                            <button class="bg-green-100 text-green-700 px-4 py-2 rounded-md font-bold hover:bg-green-200 transition">
                                {{ __('apply_now') || 'قدم الآن' }}
                            </button>
                        </div>
                    </div>
                </div>

                <div v-if="jobs.length === 0" class="text-center py-20 bg-white rounded-lg shadow">
                    <p class="text-gray-500">{{ __('no_jobs') }}</p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>