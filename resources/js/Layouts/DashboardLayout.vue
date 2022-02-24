<template>
  <div class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white">
    <div class="p-6 sm:px-2 border-b border-gray-200">
      {{name}}
    </div>
    <div class="bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
      {{msg}}
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "dashboard-layout",
  props: {
    name: String,
    msg: String
  },
  setup() {},
});
</script>
