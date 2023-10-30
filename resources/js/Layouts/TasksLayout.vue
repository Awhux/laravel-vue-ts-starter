<script setup lang="ts">
import Navbar from '@/Components/Navbar.vue'

const props = defineProps<{
  auth?: any
}>()

const isCurrentRoute = (routeName: string) => {
  return route().current(routeName)
}
</script>

<template>
  <Navbar :user="props.auth?.user" />

  <main class="mt-12 px-2">
    <slot />
  </main>

  <footer></footer>
</template>

<style scoped lang="scss"></style>
