<template>
  <select
    :class="{
      'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500':
        error,
    }"
    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
    <option
      v-for="d in data"
      :key="d.value"
      :selected="d.value === modelValue"
      :value="d.value"
    >
      {{ d.display }}
    </option>
  </select>
</template>

<script setup>
defineProps(["data", "modelValue", "error"]);
defineEmits(["update:modelValue"]);
</script>
