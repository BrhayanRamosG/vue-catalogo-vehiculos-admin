<template>
  <Link
    :href="route(nameRoute, parametro)"
    as="button"
    class="
      inline-flex
      items-center
      px-4
      py-2
      bg-neutral-800
      border border-transparent
      rounded-md
      font-semibold
      text-xs text-white
      uppercase
      tracking-widest
      hover:bg-neutral-700
      active:bg-neutral-900
      focus:outline-none
      focus:border-neutral-900
      focus:ring
      focus:ring-neutral-300
      disabled:opacity-25
      transition
    "
  >
    <slot></slot>
  </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    nameRoute: String,
    parametro: null,
  },
};
</script>