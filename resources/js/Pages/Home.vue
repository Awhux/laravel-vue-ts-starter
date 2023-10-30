<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps<{
  isAuthenticated: boolean
  auth: any
}>()
</script>

<template>
  <div class="flex flex-col">
    <Head title="Welcome" />

    <h1>{{ props.isAuthenticated ? `Welcome back ${auth.user.name}` : 'Login to continue!' }}</h1>

    <div v-if="isAuthenticated">
      <Link href="/todos" class="underline">Todos</Link>
    </div>

    <div v-else>
      <Link href="/login" class="underline">Login</Link>
      <Link href="/register" class="underline">Register</Link>
    </div>
  </div>
</template>
