<script setup lang="ts">
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle } from '@headlessui/vue'

import TasksLayout from '../../Layouts/TasksLayout.vue'

type Task = {
  id: number
  title: string
  description: string
  belongs_to?: number
  created_at?: string
  updated_at?: string
  deleted_at?: string
}

const props = defineProps<{
  auth?: any
  errors?: any
  tasks: Task[]
}>()

const isModalOpen = ref(false)
const currentPage = ref(1)
const maxItemsPerPage = 10

const form = useForm({
  title: '',
  description: '',
})

const addTask = () => {
  form.post('tasks/save', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset('title')
      form.reset('description')

      closeModal()
    },
  })
}

const editTask = (task: Task) => {
  route.push(`/tasks/${task.id}`)
}

const removeTask = (task: Task) => {
  form.delete(`tasks/${task.id}`, {
    preserveScroll: true,
  })
}

const closeModal = () => {
  isModalOpen.value = false
}

const openModal = () => {
  isModalOpen.value = true
}

const forwardTaskList = () => {
  currentPage.value++
}

const backTaskList = () => {
  currentPage.value--
}
</script>

<template>
  <TasksLayout :auth="props.auth">
    <div class="flex flex-col">
      <Head :title="`Suas tarefas`" />
      <div
        class="mx-auto mb-5 w-full max-w-xl rounded-lg border border-gray-600/20 bg-gray-100 p-4 text-center"
        v-if="auth?.user"
      >
        <h2 class="text-black/80">Bem vindo(a) {{ auth.user.name }}!</h2>
      </div>

      <!-- form to add the tasks -->
      <div class="mx-auto mb-4 w-full max-w-sm text-center">
        <span class="text-sm" v-if="!auth.user">Apenas usuários cadastrados podem editar as tarefas</span>
        <div class="flex w-full justify-center rounded-md">
          <button
            class="rounded-md border border-gray-600/60 px-4 py-2 transition-all duration-300 hover:scale-105 disabled:cursor-not-allowed disabled:text-gray-300"
            :disabled="form.processing || !auth.user"
            @click="openModal"
            type="button"
          >
            Criar uma tarefa
          </button>
        </div>
      </div>

      <TransitionRoot appear :show="isModalOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <div class="fixed inset-0 bg-black/25" />
          </TransitionChild>

          <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
              <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100 scale-100"
                leave-to="opacity-0 scale-95"
              >
                <DialogPanel
                  class="w-full max-w-md overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                >
                  <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                    Crie uma tarefa
                  </DialogTitle>

                  <form @submit.prevent="addTask" class="mt-2 flex flex-col gap-2">
                    <span class="text-sm text-red-800/80" v-if="errors">{{ errors.title }}</span>
                    <input
                      type="text"
                      v-model="form.title"
                      class="peer w-full rounded-md border border-gray-600/60 px-2 outline-none transition-all duration-300 focus:border-transparent focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:placeholder:text-gray-300"
                      placeholder="Título"
                      maxlength="35"
                      :disabled="form.processing || !auth.user"
                    />

                    <span class="text-sm text-red-800/80" v-if="errors">{{ errors.description }}</span>
                    <input
                      type="text"
                      v-model="form.description"
                      class="peer w-full rounded-md border border-gray-600/60 px-2 outline-none transition-all duration-300 focus:border-transparent focus:ring-2 focus:ring-black disabled:cursor-not-allowed disabled:placeholder:text-gray-300"
                      placeholder="Descrição"
                      maxlength="35"
                      :disabled="form.processing || !auth.user"
                    />

                    <div class="mt-4 flex w-full justify-end">
                      <button
                        class="rounded-md border border-gray-600/60 px-4 py-2 transition-all duration-300 hover:scale-105 disabled:cursor-not-allowed disabled:text-gray-300"
                        :disabled="form.processing || !auth.user"
                        type="submit"
                      >
                        Criar
                      </button>
                    </div>
                  </form>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>

      <Transition
        enter-active-class="transition-opacity duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ul class="mx-auto mb-2 mt-3 w-full max-w-md" v-if="props.tasks.length > 0">
          <TransitionGroup
            name="list"
            tag="div"
            enter-active-class="transition-all duration-500 ease-in-out"
            enter-class="opacity-0 transform scale-75"
            enter-to-class="opacity-100 transform scale-100"
            leave-active-class="transition-all duration-500 ease-in-out"
            leave-class="opacity-100 transform scale-100"
            leave-to-class="opacity-0 transform scale-75"
          >
            <li
              v-for="task in props.tasks.slice((currentPage - 1) * maxItemsPerPage, currentPage * maxItemsPerPage)"
              :key="task.id"
              class="my-2 flex flex-row items-center justify-between rounded-md border border-gray-600/60 py-4 shadow-md"
            >
              <div class="ml-2 flex flex-col gap-1">
                <h2 class="text-lg">{{ task.title }}</h2>
                <span class="text-sm text-gray-600/80">{{ task.description }}</span>
              </div>
              <div v-if="auth.user">
                <button
                  @click="() => removeTask(task)"
                  class="mr-2 rounded-md border border-transparent p-1 transition-all duration-200 hover:border-gray-600/60 disabled:cursor-default disabled:select-none disabled:border-gray-600/20"
                  :disabled="form.processing"
                >
                  Remover
                </button>
                <button
                  @click="() => editTask(task)"
                  class="mr-4 rounded-md border border-transparent p-1 transition-all duration-200 hover:border-gray-600/60 disabled:cursor-default disabled:select-none disabled:border-gray-600/20"
                  :disabled="form.processing"
                >
                  Editar
                </button>
              </div>
            </li>
          </TransitionGroup>
          <div class="flex flex-row justify-center gap-2">
            <button
              @click="backTaskList"
              class="rounded-md border border-transparent p-1 transition-all duration-200 hover:border-gray-600/60 disabled:cursor-default disabled:select-none disabled:border-gray-600/20"
              :disabled="form.processing || currentPage === 1"
            >
              Voltar
            </button>
            <button
              @click="forwardTaskList"
              class="rounded-md border border-transparent p-1 transition-all duration-200 hover:border-gray-600/60 disabled:cursor-default disabled:select-none disabled:border-gray-600/20"
              :disabled="form.processing || currentPage === Math.ceil(props.tasks.length / maxItemsPerPage)"
            >
              Próximo
            </button>
          </div>
        </ul>

        <span v-else class="mx-auto mb-2 mt-auto text-center text-gray-600/80">Suas tarefas aparecerão aqui😁!</span>
      </Transition>
    </div>
  </TasksLayout>
</template>
