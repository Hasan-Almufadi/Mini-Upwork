<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const __ = (key) => props.translations.messages[key] || key;

// استقبال بيانات الوظيفة من السيرفر
const propsData = defineProps({
    job: Object
});

// تجهيز الفورم بالبيانات القديمة
const form = useForm({
    title: propsData.job.title,
    description: propsData.job.description,
    budget: propsData.job.budget,
});

// دالة التحديث
const submit = () => {
    form.put(route('jobs.update', propsData.job.id));
};
</script>

<template>
    <Head :title="__('edit_job')" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('edit_job') || 'تعديل الوظيفة' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">{{ __('title') }}</label>
                            <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">{{ __('description') }}</label>
                            <textarea v-model="form.description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">{{ __('budget') }} ($)</label>
                            <input v-model="form.budget" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div class="flex items-center gap-4">
                            <button :disabled="form.processing" class="bg-blue-600 text-white px-6 py-2 rounded-md font-bold hover:bg-blue-700 transition">
                                {{ __('save_changes') || 'حفظ التعديلات' }}
                            </button>
                            <button type="button" @click="window.history.back()" class="text-gray-600 hover:underline">
                                {{ __('cancel') || 'إلغاء' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>