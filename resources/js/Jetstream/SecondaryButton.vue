<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      bg-white
      dark:bg-gray-800
      border border-gray-300
      rounded-md
      font-semibold
      text-xs text-gray-700 dark:text-gray-200
      uppercase
      tracking-widest
      shadow-sm
      hover:text-gray-500
      dark:hover:text-gray-300
      focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200
      active:text-gray-800 active:bg-gray-50
      dark:active:text-gray-300 dark:active:bg-gray-600
      disabled:opacity-25
      transition
    "
  >
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: {
      type: String,
      default: "button",
    },
  },
});
</script>
