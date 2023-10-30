<script setup lang="ts">
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const register = () => {
  form.post('register')
}
</script>

<template>
  <div class="flex flex-col">
    <Head title="Create an account!" />

    <!-- form -->
    <form @submit.prevent="register">
      <input type="text" v-model="form.name" placeholder="Nome" />
      <input type="text" v-model="form.email" placeholder="Email" />
      <input type="password" v-model="form.password" placeholder="Senha" />
      <input type="password" v-model="form.password_confirmation" placeholder="Confirmar a senha" />

      <button :disabled="form.processing">{{ form.processing ? 'Carregando...' : 'Registrar' }}</button>
    </form>
  </div>
</template>
