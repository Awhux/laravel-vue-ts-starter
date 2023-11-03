<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'

import DashboardLayout from '@/Layouts/DashboardLayout.vue'

const props = defineProps<{
  isAuthenticated: boolean
  auth: any
}>()
</script>

<template>
  <DashboardLayout>
    <Head title="Bem vindo!" />
    <main class="flex flex-col items-center justify-center px-2 pt-2">
      <h1>Hello World</h1>
    </main>
  </DashboardLayout>
</template>
