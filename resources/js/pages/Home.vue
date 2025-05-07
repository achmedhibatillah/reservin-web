<script setup>
import NavMain from '../components/NavMain.vue';
import NavFooter from '../components/NavFooter.vue';

import Button from '../components/ui/button/Button.vue'

const items = [
  { title: 'Dashboard', href: '/', icon: 'HomeIcon' },
  { title: 'Settings', href: '/settings', icon: 'SettingsIcon' }
];
</script>

<template>

    <Button />
    <div class="p-6">
        <h1 class="text-2xl font-bold">Halo dari Halaman Home vue!</h1>
    </div>
    <NavFooter />
</template>
