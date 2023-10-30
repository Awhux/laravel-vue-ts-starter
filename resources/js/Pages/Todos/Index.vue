<script setup lang="ts">
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'

import TodosLayout from '../../Layouts/TodosLayout.vue'

type Todo = {
  id: number
  title: string
  completed: boolean
  created_at?: string
  updated_at?: string
}

const props = defineProps<{
  auth?: any
  todos: Todo[]
}>()
const localTodos = ref<Todo[]>(props.todos)

const form = useForm({
  title: '',
  completed: false,
})

const addTodo = () => {
  form.post('todos/save', {
    preserveScroll: true,
    onSuccess: () => {
      localTodos.value.push({
        id: localTodos.value.length + 1,
        title: form.data().title,
        completed: false,
      })

      form.reset('title')
    },
  })
}

const toggleTodo = (todo: Todo) => {
  todo.completed = !todo.completed
}

const editTodo = (todo: Todo) => {
  form.completed = todo.completed

  form.put(`todos/${todo.id}`, {
    preserveScroll: true,
  })
}

const removeTodo = (todo: Todo) => {
  form.delete(`todos/${todo.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      localTodos.value = localTodos.value.filter((t) => t.id !== todo.id)
    },
  })
}
</script>

<template>
  <TodosLayout>
    <div class="flex flex-col">
      <Head title="Your todos" />
      <div class="mx-auto mb-5 w-full max-w-xl rounded-lg border border-gray-600/20 bg-gray-100 p-4 text-center">
        <h2 class="text-black/80">Welcome back {{ auth.user.name }}!</h2>
      </div>

      <!-- form to add the todo's -->
      <form @submit.prevent="addTodo" class="mx-auto mb-12 w-full max-w-sm">
        <div class="flex w-full justify-center shadow-md">
          <input
            type="text"
            v-model="form.title"
            class="w-full rounded-l-md border border-gray-600/60 px-2 outline-none transition-all duration-300 focus:border-transparent focus:ring-2 focus:ring-black"
            placeholder="Insert your wonderful task!"
            maxlength="35"
          />
          <button class="rounded-r-md border border-l-0 border-gray-600/60 px-2">Insert</button>
        </div>
      </form>

      <Transition
        enter-active-class="transition-opacity duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <ul class="mx-auto mb-2 mt-3 w-full max-w-md" v-if="localTodos.length > 0">
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
              v-for="todo in localTodos"
              :key="todo.id"
              class="my-2 flex flex-row items-center justify-between rounded-md border border-gray-600/60 py-4 shadow-md"
            >
              <!-- <input
                type="checkbox"
                :checked="todo.completed"
                @change="
                  (e) => {
                    toggleTodo(todo)
                    editTodo(todo)
                  }
                "
              /> -->
              <span :class="{ 'font-bold text-gray-600/60 line-through': todo.completed }" class="ml-2">{{
                todo.title
              }}</span>
              <button
                @click="() => removeTodo(todo)"
                class="mx-4 rounded-md border border-transparent p-1 transition-all duration-200 hover:border-gray-600/60 disabled:cursor-default disabled:select-none disabled:border-gray-600/20"
                :disabled="form.processing"
              >
                Remove
              </button>
            </li>
          </TransitionGroup>
        </ul>
        <!-- list for todo's -->

        <span v-else class="mx-auto mb-2 mt-auto text-center">Your todo's will appear here once you add them😁!</span>
      </Transition>
    </div>
  </TodosLayout>
</template>
