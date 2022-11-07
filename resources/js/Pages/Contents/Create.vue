<template>
  <Head>
    <title>Tambah Dokumen</title>
  </Head>
  <form @submit.prevent="form.post()" method="post" class="space-y-5">
    <div
      class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow"
    >
      <!-- Content goes here -->
      <!-- We use less vertical padding on card headers on desktop than on body sections -->
      <div class="bg-white px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
          Tambah Dokumen
        </h3>
        <p class="mt-1 text-sm text-gray-500">
          Menambahkan dokumen baru kepada standard dan sub standard yang telah
          tersedia.
        </p>
      </div>

      <div class="space-y-5 px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <Label for="standard">Standard</Label>
            <ListSelect :data="standards" v-model="selectedStandardId" />
          </div>
          <div>
            <Label for="sub">Sub Standard</Label>
            <ListSelect :data="subs" v-model="form.subId" />
          </div>
        </div>
        <div>
          <Label for="description">Keterangan Dokumen</Label>
          <TextInput
            type="text"
            id="description"
            :error="form.errors.description"
            v-model="form.description"
          />
        </div>
      </div>
      <div class="flex justify-end space-x-3 px-4 py-4 sm:px-6">
        <!-- Content goes here -->
        <!-- We use less vertical padding on card footers at all sizes than on headers or body sections -->
        <Button variant="secondary" @click="resetForm">Clear</Button>
        <Button type="submit" variant="primary">Simpan</Button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Label from "../../Components/Forms/Label.vue";
import ListSelect from "../../Components/Forms/ListSelect.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import { ref, watch } from "vue";
import Button from "@/Components/Forms/Button.vue";

defineProps(["standards", "subs"]);

const selectedStandardId = ref("");

watch(selectedStandardId, () => {
  form.reset("subId");
  Inertia.get(
    "/standards/create",
    {
      standard: selectedStandardId.value,
    },
    { preserveState: true }
  );
});

const form = useForm({
  subId: "",
  description: "",
});

const resetForm = () => {
  form.reset();
  selectedStandardId.value = "";
};
</script>

<script>
import Main from "../../Layouts/Main.vue";

export default {
  layout: Main,
};
</script>
