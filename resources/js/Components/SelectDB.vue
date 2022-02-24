<template>
  <select
    class="
      bg-white
      dark:bg-gray-900
      text-gray-900
      dark:text-white
      rounded-lg
      border-2 border-violet-500
      focus:outline-none
      focus:ring-2
      focus:ring-sky-500
      focus:border-transparent
    "
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >
    <option disabled value="">Seleccione un elemento</option>
    <option :key="value.id" v-for="value in data" :value="value.id">
      {{ value[nameOption] }}
    </option>
  </select>
</template>

<script >
export default {
  props: {
    modelValue: null,
    name: null,
    data: null,
    nameOption: null,
  },
  emits: ["update:modelValue"],
  setup() {},
};
</script>
