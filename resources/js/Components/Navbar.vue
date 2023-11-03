<script setup lang="ts">
import NavbarItem from './NavbarItem.vue'

const props = defineProps<{
  user?: any
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
        <div class="text-xl">Dashboard</div>
      </div>

      <!-- Links -->
      <div class="flex gap-1">
        <template v-if="!user">
          <NavbarItem href="/login" :current-route="isCurrentRoute('login')"> Login </NavbarItem>
          <NavbarItem href="/register" :current-route="isCurrentRoute('register')"> Registrar </NavbarItem>
        </template>
        <template v-else>
          <NavbarItem href="/profile" :current-route="isCurrentRoute('profile')"> Perfil </NavbarItem>
          <NavbarItem href="/logout" :current-route="isCurrentRoute('logout')"> Logout </NavbarItem>
        </template>
      </div>
    </div>
  </nav>
</template>

<style scoped lang="scss"></style>
