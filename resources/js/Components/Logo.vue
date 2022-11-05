<template>
  <Link href="/dashboard">
    <img :src="Logo" alt="Logo Widyatama" />
  </Link>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Logo from "../../assets/logo.png";
</script>

<style scoped></style>
