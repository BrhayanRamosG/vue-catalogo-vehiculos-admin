<template>
  <app-layout :title="`Vehículo ID ${vehicleInfo.id}`">
    <template #header>
      <h2
        class="
          font-semibold
          text-xl text-gray-900
          dark:text-white
          leading-tight
        "
      >
        Informacion Vehiculo {{ vehicleInfo.id }}
      </h2>
    </template>
    <div class="py-12">
      <div
        class="
          bg-gray-200
          dark:bg-gray-800
          text-gray-900
          dark:text-white
          max-w-7xl
          mx-auto
          px-4
          sm:px-6
          lg:px-8
        "
      >
        <CardVehiculos :data="vehicle" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import { computed, defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CardVehiculos from "@/Components/CardVehiculos.vue";

export default defineComponent({
  components: {
    AppLayout,
    CardVehiculos,
  },
  props: {
    vehicle: Array,
  },
  setup({ vehicle }) {
    const vehicleInfo = computed(() => vehicle[0]);

    return { vehicleInfo };
  },
});
</script>