<template>
  <Head>
    <title>List Dokumen</title>
  </Head>
  <div
    class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow"
  >
    <div class="px-4 py-5 sm:px-6">
      <!-- Content goes here -->
      <!-- We use less vertical padding on card headers on desktop than on body sections -->
      <div class="bg-white">
        <div
          class="mx-auto max-w-7xl py-16 px-4 sm:py-24 sm:px-6 lg:flex lg:justify-between lg:px-8"
        >
          <div class="max-w-xl">
            <h2
              class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl"
            >
              Seluruh Dokumen
            </h2>
            <p class="mt-5 text-xl text-gray-500">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias at
              omnis sed similique. Asperiores consectetur consequuntur dolore
              eligendi quod sint temporibus. Culpa dicta illum impedit
              laboriosam neque nobis optio sit!
            </p>
          </div>
          <div class="mt-10 w-full max-w-xs">
            <label
              class="block text-base font-medium text-gray-500"
              for="currency"
              >Standard</label
            >
            <div class="relative mt-1.5">
              <ListSelect
                v-model="selectedStandard"
                :data="standards"
                :error="false"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Content goes here -->
    <div class="overflow-hidden bg-white shadow sm:rounded-md">
      <ul class="divide-y divide-gray-200" role="list">
        <li v-for="sub in subs" :key="sub.id">
          <Link :href="`/standards/${sub.id}`" class="block hover:bg-gray-50">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="truncate text-sm font-medium text-indigo-600">
                  {{ sub.name }}
                </p>
                <div class="ml-2 flex flex-shrink-0">
                  <p
                    class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800"
                  >
                    {{ sub.number }}
                  </p>
                </div>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                  <p class="flex items-center text-sm text-gray-500">
                    <DocumentTextIcon
                      aria-hidden="true"
                      class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                    />
                    {{ sub.contents.length }} Dokumen
                  </p>
                </div>
                <div
                  class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0"
                >
                  <ClockIcon
                    aria-hidden="true"
                    class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                  />
                  <p>
                    {{ sub.contents[sub.contents.length - 1].created_at }}
                  </p>
                </div>
              </div>
            </div>
          </Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import ListSelect from "@/Components/Forms/ListSelect.vue";
import { ref, watch } from "vue";
import { ClockIcon, DocumentTextIcon } from "@heroicons/vue/outline";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps(["standards", "subs"]);

const selectedStandard = ref(props.standards[0].value);

watch(selectedStandard, () => {
  Inertia.get(
    "/standards",
    {
      standard: selectedStandard.value,
    },
    { preserveState: true }
  );
});
</script>

<script>
import Main from "../../Layouts/Main.vue";

export default {
  layout: Main,
};
</script>
