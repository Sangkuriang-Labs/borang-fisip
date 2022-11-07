<template>
  <div class="relative mt-1 rounded-md shadow-sm">
    <input
      :type="type"
      :name="id"
      :id="id"
      class="block w-full rounded-md border-gray-300 pr-10 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
      :class="{
        'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500':
          error,
      }"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
    <div
      v-if="error"
      class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
    >
      <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
    </div>
  </div>
  <p v-if="error" class="mt-2 text-sm text-red-600" id="email-error">
    {{ error }}
  </p>
</template>

<script setup>
import { ExclamationCircleIcon } from "@heroicons/vue/solid";

defineProps(["type", "id", "modelValue", "error"]);
defineEmits(["update:modelValue"]);
</script>

<style scoped></style>
