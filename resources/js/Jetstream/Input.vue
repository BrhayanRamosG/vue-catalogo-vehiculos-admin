<template>
  <input
    class="
      bg-white
      dark:bg-gray-800
      dark:text-white
      border-gray-400
      focus:border-sky-700
      focus:ring
      focus:ring-sky-300
      rounded-md
      shadow-sm
    "
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["modelValue"],

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
});
</script>
