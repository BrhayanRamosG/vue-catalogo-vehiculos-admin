<template>
  <number
    class="
      bg-white
      dark:bg-gray-900
      text-gray-900
      dark:text-white
      py-2
      px-3
      rounded-lg
      border-2 border-violet-500
      mt-1
      focus:outline-none
      focus:ring-2
      focus:ring-sky-500
      focus:border-transparent
    "
    v-model="val"
    v-bind="money ? moneyProp : numberProp"
  >
  </number>
</template>

<script>
import { number } from "@coders-tm/vue-number-format";

export default {
  components: {
    number,
  },
  props: {
    val: "",
    money: false,
  },
  setup() {
    const moneyProp = {
      decimal: ".",
      separator: ",",
      prefix: "$ ",
      suffix: " MXN",
      precision: 2,
      masked: false,
    };
    const numberProp = {
      decimal: ".",
      separator: ",",
      prefix: "",
      suffix: " km",
      precision: 2,
      masked: false,
    };
    return { number, moneyProp, numberProp };
  },
};
</script>