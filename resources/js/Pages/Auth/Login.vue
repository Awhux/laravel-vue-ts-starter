<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const login = () => {
  form.post('login')
}
</script>

<template>
  <div class="flex flex-col">
    <Head title="Log me in!" />

    <!-- errors -->
    <div v-if="form.errors" role="alert">
      <div v-for="error in form.errors.email" :key="error">{{ error }}</div>
    </div>

    <form @submit.prevent="login">
      <input type="text" v-model="form.email" />
      <input type="password" v-model="form.password" />

      <input type="checkbox" v-model="form.remember" id="remember" name="remember" />
      <label for="remember">Remember me</label>

      <button :disabled="form.processing">{{ form.processing ? 'Carregando...' : 'Login' }}</button>
    </form>
  </div>
</template>
