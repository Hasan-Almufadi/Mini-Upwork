<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-950">
        <div class="flex justify-center gap-4 py-4">
    <a href="/lang/ar" class="text-sm font-bold text-white/70 hover:text-white transition">العربية 🇸🇦</a>
    <a href="/lang/tr" class="text-sm font-bold text-white/70 hover:text-white transition">Türkçe 🇹🇷</a>
    <a href="/lang/en" class="text-sm font-bold text-white/70 hover:text-white transition">English 🇺🇸</a>
      </div>
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.5)]" />
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/95 backdrop-blur-sm shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-2xl border border-white/20">
            <slot />
        </div>
        
        <p class="mt-6 text-slate-400 text-xs uppercase tracking-widest">Mini-Upwork Professional Platform</p>
    </div>
</template>
