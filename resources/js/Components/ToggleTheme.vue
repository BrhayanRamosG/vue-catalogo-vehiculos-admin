<template>
  <div class="inline-flex items-center px-1 pt-1 text-sm leading-5 transition">
    <Menu as="div" class="relative inline-block text-left">
      <div>
        <MenuButton
          class="
            inline-flex
            justify-center
            w-full
            px-4
            py-2
            text-sm
            font-medium
            bg-gray-400
            dark:bg-gray-700 dark:text-white
            rounded-md
            bg-opacity-20
            hover:bg-opacity-30
            focus:outline-none
            focus-visible:ring-2
            focus-visible:ring-white
            focus-visible:ring-opacity-75
          "
        >
          <MoonIcon
            v-if="userTheme === 'dark'"
            class="w-5 h-5 mr-2 dark:text-white"
            aria-hidden="true"
          />
          <SunIcon
            v-else-if="userTheme === 'light'"
            class="w-5 h-5 mr-2 dark:text-white"
            aria-hidden="true"
          />
          Tema
          <ChevronDownIcon
            class="w-5 h-5 ml-2 -mr-1 dark:text-white hover:dark:text-white"
            aria-hidden="true"
          />
        </MenuButton>
      </div>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="
            absolute
            right-0
            w-full
            mt-2
            origin-top-right
            bg-gray-100
            dark:bg-gray-700
            divide-y divide-gray-500
            dark:divide-gray-100
            rounded-md
            shadow-lg
            ring-1 ring-black ring-opacity-5
            focus:outline-none
          "
        >
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button
                @click="togleTheme('light')"
                :class="[
                  active
                    ? 'text-blue-600 dark:text-blue-500'
                    : 'text-gray-900 dark:text-white',
                  'group flex rounded-md items-center w-full px-2 py-2 text-sm',
                ]"
              >
                <SunIcon
                  :active="active"
                  :class="[
                    active
                      ? 'text-blue-600 dark:text-blue-500'
                      : 'text-gray-900 dark:text-white',
                    'w-5 h-5 mr-2',
                  ]"
                  aria-hidden="true"
                />
                Claro
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button
                @click="togleTheme('dark')"
                :class="[
                  active
                    ? 'text-blue-600 dark:text-blue-500'
                    : 'text-gray-900 dark:text-white',
                  'group flex rounded-md items-center w-full px-2 py-2 text-sm',
                ]"
              >
                <MoonIcon
                  :active="active"
                  :class="[
                    'w-5 h-5 mr-2',
                    active
                      ? 'text-blue-600 dark:text-blue-500'
                      : 'text-gray-900 dark:text-white',
                  ]"
                  aria-hidden="true"
                />
                Oscuro
              </button>
            </MenuItem>
          </div>
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button
                @click="themeSystem"
                :class="[
                  active
                    ? 'text-blue-600 dark:text-blue-500'
                    : 'text-gray-900 dark:text-white',
                  'group flex rounded-md items-center w-full px-2 py-2 text-sm',
                ]"
              >
                <DesktopComputerIcon
                  :active="active"
                  :class="[
                    'w-5 h-5 mr-2',
                    active
                      ? 'text-blue-600 dark:text-blue-500'
                      : 'text-gray-900 dark:text-white',
                  ]"
                  aria-hidden="true"
                />
                Sistema
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/solid";
import { DesktopComputerIcon, MoonIcon, SunIcon } from "@heroicons/vue/outline";
import { InertiaProgress } from "@inertiajs/progress";
import store from "../store/store";

export default {
  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    ChevronDownIcon,
    DesktopComputerIcon,
    MoonIcon,
    SunIcon,
  },
  setup() {
    const setTheme = (theme) => {
      localStorage.setItem("user-theme", theme);
      userTheme.value = theme;
      store.theme = theme;
      document.documentElement.className = theme;
    };

    const togleTheme = (value) => {
      setTheme(value);
    };

    const getMediaPreference = () => {
      const hasDarkPreference = window.matchMedia(
        "(prefers-color-scheme: dark)"
      ).matches;
      if (hasDarkPreference) {
        return "dark";
      } else {
        return "light";
      }
    };

    const themeSystem = () => {
      const initUserTheme = getMediaPreference();
      userTheme.value = initUserTheme;
      localStorage.removeItem("user-theme");
      document.documentElement.className = initUserTheme;
    };

    const activeThemeLocal = localStorage.getItem("user-theme");
    const systemTheme = getMediaPreference();
    let userTheme =
      activeThemeLocal !== null ? ref(activeThemeLocal) : ref(systemTheme);

    //const themeIndicator = ref("");

    onMounted(() => {
      if (activeThemeLocal === null) {
        document.documentElement.className = systemTheme;
      } else {
        setTheme(activeThemeLocal);
      }
      // if (activeThemeLocal === "dark" && systemTheme === "dark") {
      //   themeIndicator.value = "#5aa7ea";
      // } else {
      //   themeIndicator.value = "#1975c5";
      // }
      // InertiaProgress.init({ color: themeIndicator.value });
    });

    return {
      togleTheme,
      themeSystem,
      userTheme,
      store,
    };
  },
};
</script>
