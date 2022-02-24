<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      bg-gray-800
      dark:bg-sky-600
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      uppercase
      tracking-widest
      hover:bg-gray-700
      active:bg-gray-900
      dark:hover:bg-sky-700 dark:active:bg-sky-900
      focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300
      dark:focus:border-sky-900 dark:focus:ring-sky-300
      disabled:opacity-25
      transition
    "
    @click="$emit('operation')"
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
      default: "submit",
    },
  },
  emits: ["operation"],
  setup() {
    // function saysHello() {
    //   console.log("desde button");
    // }
    // return { saysHello };
  },
});
</script>
