<template>
  <input
    :class="`bg-white dark:bg-gray-900 text-gray-900 dark:text-white py-2
  px-3 rounded-lg border-2 border-violet-500 mt-1 focus:outline-none
  focus:ring-2 focus:ring-sky-500 focus:border-transparent`"
    :type="type"
    @input="$emit('update:modelValue', $event.target.value)"
    :value="modelValue"
  />
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: String,
    modelValue: null,
  },
  emits: ["update:modelValue"],
  setup() {},
});
</script>