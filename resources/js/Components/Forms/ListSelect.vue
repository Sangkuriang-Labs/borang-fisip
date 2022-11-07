<template>
  <select
    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
    <option v-for="d in data" :key="d.value" :value="d.value">
      {{ d.display }}
    </option>
  </select>
</template>

<script setup>
defineProps(["data", "modelValue"]);
defineEmits(["update:modelValue"]);
</script>
