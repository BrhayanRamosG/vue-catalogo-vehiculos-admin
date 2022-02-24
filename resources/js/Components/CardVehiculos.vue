<template>
  <div v-for="vehicles in data" :key="vehicles.id">
    {{ vehicles.id }}<br />
    {{ vehicles.price }}<br />
    <p
      class="text-xl leading-tight font-semibold "
      v-html="vehicles.description"
    >
    </p>
    {{ vehicles.year }}
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  },
  setup() {},
};
</script>
