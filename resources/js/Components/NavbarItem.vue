<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

const props = withDefaults(
  defineProps<{
    currentRoute: boolean
    href: string
  }>(),
  {
    currentRoute: false,
    href: '',
  },
)
</script>

<template>
  <div
    class="flex cursor-pointer items-center justify-between rounded-full border-gray-300 px-3 py-2 text-center underline-offset-4 transition-all hover:bg-gray-200"
    :class="{ underline: props.currentRoute }"
  >
    <Link :href="props.href">
      <slot />
    </Link>
  </div>
</template>

<style scoped lang="scss"></style>
