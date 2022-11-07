<template>
  <div class="min-h-full">
    <Disclosure v-slot="{ open }" as="nav" class="z-10 bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <Logo />
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <Link
                  v-for="item in navigation"
                  :key="item.name"
                  :class="[
                    $page.url.includes(item.href)
                      ? 'bg-gray-900 text-white'
                      : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                    'rounded-md px-3 py-2 text-sm font-medium',
                  ]"
                  :href="item.href"
                  >{{ item.name }}
                </Link>
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <Link
                v-if="!$page.url.includes('/contents/create')"
                href="/contents/create"
              >
                <ButtonIcon class="mr-3">
                  <PlusIcon class="h-5 w-5" />
                  Tambahkan Dokumen
                </ButtonIcon>
              </Link>
              <!-- Profile dropdown -->
              <Menu as="div" class="relative ml-3">
                <div>
                  <MenuButton
                    class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                  >
                    <span class="sr-only">Open user menu</span>
                    <img
                      :src="user.imageUrl"
                      alt=""
                      class="h-8 w-8 rounded-full"
                    />
                  </MenuButton>
                </div>
                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  >
                    <MenuItem
                      v-for="item in userNavigation"
                      :key="item.name"
                      v-slot="{ active }"
                    >
                      <a
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm text-gray-700',
                        ]"
                        :href="item.href"
                        >{{ item.name }}</a
                      >
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton
              class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
            >
              <span class="sr-only">Open main menu</span>
              <MenuIcon v-if="!open" aria-hidden="true" class="block h-6 w-6" />
              <XIcon v-else aria-hidden="true" class="block h-6 w-6" />
            </DisclosureButton>
          </div>
        </div>
      </div>

      <DisclosurePanel class="md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <DisclosureButton
            v-for="item in navigation"
            :key="item.name"
            :class="[
              $page.url.includes(item.href)
                ? 'bg-gray-900 text-white'
                : 'text-gray-300 hover:bg-gray-700 hover:text-white',
              'block rounded-md px-3 py-2 text-base font-medium',
            ]"
            as="div"
          >
            <Link :href="item.href" as="button" class="w-full text-left">
              {{ item.name }}
            </Link>
          </DisclosureButton>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
          <div class="flex items-center px-5">
            <div class="flex-shrink-0">
              <img :src="user.imageUrl" alt="" class="h-10 w-10 rounded-full" />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-white">
                {{ user.name }}
              </div>
              <div class="text-sm font-medium text-gray-400">
                {{ user.email }}
              </div>
            </div>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <DisclosureButton
              v-for="item in userNavigation"
              :key="item.name"
              :href="item.href"
              as="a"
              class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
              >{{ item.name }}
            </DisclosureButton>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>

    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <slot />
        <!-- /End replace -->
      </div>
    </main>
  </div>
</template>

<script setup>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { MenuIcon, PlusIcon, XIcon } from "@heroicons/vue/outline";
import { Link } from "@inertiajs/inertia-vue3";
import ButtonIcon from "@/Components/Forms/ButtonIcon.vue";
import Logo from "@/Components/Logo.vue";

const user = {
  name: "Tom Cook",
  email: "tom@example.com",
  imageUrl:
    "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};

const navigation = [
  { name: "Dashboard", href: "/dashboard" },
  { name: "Standards", href: "/contents" },
];

const userNavigation = [
  { name: "Your Profile", href: "#" },
  { name: "Settings", href: "#" },
  { name: "Sign out", href: "#" },
];
</script>
