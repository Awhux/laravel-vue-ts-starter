<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps<{
  isAuthenticated: boolean
  auth: any
}>()
</script>

<template>
  <main class="flex h-screen flex-col items-center justify-center px-2 pt-2">
    <Head title="Bem vindo!" />

    <div
      class="mb-5 flex h-40 w-full max-w-md flex-col rounded-lg border border-gray-600/20 bg-gray-100 p-4 text-center"
    >
      <h1 class="text-2xl text-black/80">Seu melhor gestor de tarefas!</h1>
      <h3 class="mb-auto mt-2 text-black/80">Entre no dashboard usando o link abaixo!</h3>

      <div class="flex w-full flex-row justify-center">
        <Link href="/tasks" class="p-2 transition-all duration-300 hover:font-bold">Dashboard</Link>
      </div>
    </div>
  </main>
</template>
