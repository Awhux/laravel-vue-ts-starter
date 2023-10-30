<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps<{
  auth?: any
}>()

const isCurrentRoute = (routeName: string) => {
  return route().current(routeName)
}
</script>

<template>
  <nav class="w-full border-b border-gray-600/20 py-2">
    <div class="mx-auto flex w-full max-w-5xl flex-row justify-between">
      <!-- Title -->
      <div class="flex items-center">
        <div class="text-xl">Todos Dashboard</div>
      </div>

      <!-- Links -->
      <div class="flex gap-1">
        <div
          class="flex cursor-pointer items-center justify-between rounded-full border-gray-300 px-3 py-2 text-center underline-offset-4 transition-all hover:bg-gray-200"
          :class="{ underline: isCurrentRoute('todos') }"
        >
          <Link href="/todos" class="">Todos</Link>
        </div>
        <div
          class="flex cursor-pointer items-center justify-between rounded-full border-gray-300 px-3 py-2 text-center underline-offset-4 transition-all hover:bg-gray-200"
          :class="{ underline: isCurrentRoute('profile') }"
        >
          <Link href="/profile" class="">Profile</Link>
        </div>
        <div
          class="flex cursor-pointer items-center justify-between rounded-full border-gray-300 px-3 py-2 text-center underline-offset-4 transition-all hover:bg-gray-200"
        >
          <Link href="/logout" class="">Logout</Link>
        </div>
      </div>
    </div>
  </nav>

  <main class="mt-12 px-2">
    <slot />
  </main>

  <footer></footer>
</template>

<style scoped lang="scss"></style>
