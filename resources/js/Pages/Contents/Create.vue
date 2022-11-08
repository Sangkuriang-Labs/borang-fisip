<template>
  <Head>
    <title>Tambah Dokumen</title>
  </Head>
  <form class="space-y-5" method="post" @submit.prevent="submitForm">
    <div
      class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow"
    >
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
            <ListSelect
              v-model="form.subId"
              :data="subs"
              :error="form.errors.subId"
            />
            <TextError v-if="form.errors.subId"
              >{{ form.errors.subId }}
            </TextError>
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
          <TextError v-if="form.errors.description"
            >{{ form.errors.description }}
          </TextError>
        </div>
        <div>
          <Label for="content">Dokumen</Label>
          <div
            v-if="!form.content"
            :class="{ 'border-red-300': form.errors.content }"
            class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
          >
            <div class="space-y-1 text-center">
              <svg
                aria-hidden="true"
                class="mx-auto h-12 w-12 text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 48 48"
              >
                <path
                  d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                />
              </svg>
              <div class="flex text-sm text-gray-600">
                <label
                  class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500"
                  for="file-upload"
                >
                  <span>Tambahkan dokumen</span>
                  <input
                    id="file-upload"
                    class="sr-only"
                    name="file-upload"
                    type="file"
                    @input="form.content = $event.target.files[0]"
                  />
                </label>
                <p class="pl-1">atau tarik dokumen ke kolom ini</p>
              </div>
              <p class="text-xs text-gray-500">PDF, DOCX up to 2MB</p>
            </div>
          </div>

          <dd
            v-if="form.content"
            class="text-sm text-gray-900 sm:col-span-2 sm:mt-0"
          >
            <ul
              class="mt-2 divide-y divide-gray-200 rounded-md border border-gray-200"
              role="list"
            >
              <li
                class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
              >
                <div class="flex w-0 flex-1 items-center">
                  <PaperClipIcon
                    aria-hidden="true"
                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                  />
                  <span class="ml-2 w-0 flex-1 truncate">
                    {{ form.content.name }} -
                    {{
                      filesize(form.content.size, { base: 2, type: "jedec" })
                    }}
                  </span>
                </div>
                <div class="ml-4 flex flex-shrink-0 space-x-4">
                  <button
                    class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    type="button"
                    @click="form.content = null"
                  >
                    Remove
                  </button>
                </div>
              </li>
            </ul>
          </dd>

          <TextError v-if="form.errors.content">
            {{ form.errors.content }}
          </TextError>
        </div>
      </div>
      <div class="flex justify-end space-x-3 px-4 py-4 sm:px-6">
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
import TextError from "@/Components/Forms/TextError.vue";
import { PaperClipIcon } from "@heroicons/vue/solid";
import { filesize } from "filesize";

defineProps(["standards", "subs"]);

const selectedStandardId = ref("");

watch(selectedStandardId, () => {
  form.reset();
  form.clearErrors();
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
  content: null,
});

const submitForm = () => {
  form.post("/standards", {
    forceFormData: true,
  });
};

const resetForm = () => {
  form.reset();
  form.clearErrors();
  selectedStandardId.value = "";
};
</script>

<script>
import Main from "../../Layouts/Main.vue";

export default {
  layout: Main,
};
</script>
