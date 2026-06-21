<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const __ = (key) => {
    return props.translations?.messages?.[key] || key;
};

const form = useForm({
    title: '',
    description: '',
    budget: '',
});

const submit = () => {
    form.post(route('jobs.store'));
};
</script>

<template>
    <Head :title="__('create_job')" />

    <AuthenticatedLayout>
        <div class="py-12 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-950 min-h-screen">
            
            <div class="max-w-3xl mx-auto mb-8 flex justify-center gap-4">
                <a href="/lang/ar" class="px-5 py-2 rounded-xl bg-white/10 text-white backdrop-blur-md border border-white/20 hover:bg-white/20 transition-all shadow-xl flex items-center gap-2">
                    <span class="text-lg">🇸🇦</span> العربية
                </a>
                <a href="/lang/tr" class="px-5 py-2 rounded-xl bg-white/10 text-white backdrop-blur-md border border-white/20 hover:bg-white/20 transition-all shadow-xl flex items-center gap-2">
                    <span class="text-lg">🇹🇷</span> Türkçe
                </a>
                <a href="/lang/en" class="px-5 py-2 rounded-xl bg-white/10 text-white backdrop-blur-md border border-white/20 hover:bg-white/20 transition-all shadow-xl flex items-center gap-2">
                    <span class="text-lg">🇺🇸</span> English
                </a>
            </div>

            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white/95 backdrop-blur-sm shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-2xl overflow-hidden border border-white/20">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4 text-center">
                            {{ __('create_job') }}
                        </h2>
                        
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label class="block font-semibold text-sm text-slate-700">{{ __('job_title') }}</label>
                                <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-3 shadow-sm transition-all" required />
                            </div>

                            <div>
                                <label class="block font-semibold text-sm text-slate-700">{{ __('description') }}</label>
                                <textarea v-model="form.description" rows="5" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-3 shadow-sm transition-all" required></textarea>
                            </div>

                            <div>
                                <label class="block font-semibold text-sm text-slate-700">{{ __('budget') }}</label>
                                <input v-model="form.budget" type="number" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-3 shadow-sm transition-all" required />
                            </div>

                            <div class="mt-8">
                             <button 
                             type="submit" 
                             :disabled="form.processing"
                             class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-500/50 transition-all duration-300 transform hover:-translate-y-1"
                              >
                           <span v-if="form.processing">جاري النشر...</span>
                           <span v-else>{{ __('submit') }}</span>
                           </button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>