<template>
  <app-layout title="Vehículos">
    <template #header>
      <h2
        class="
          font-semibold
          text-xl text-gray-900
          dark:text-white
          leading-tight
        "
      >
        Informacion Veh&iacute;culos
      </h2>
    </template>
    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <Input
          v-model="valueSearch"
          @keyup="search"
          id="search"
          type="text"
          placeholder="Buscar por precio o a&ntilde;o"
        />

        <Button class="ml-2" type="button" @click="clear"> Limpiar </Button>

        <div
          v-if="valueSearch !== ''"
          class="text-base font-bold text-gray-900 dark:text-white"
        >
          Resultados encontrados: {{ vehicles.data.length }}
        </div>
        <TablaVehiculos tableName="Tabla Vehículos" :vehicles="vehicles" />
        <div
          v-if="vehicles.data.length === 0 && valueSearch !== ''"
          class="text-center text-lg font-bold text-gray-900 dark:text-white"
        >
          No hay resultados en su b&uacute;squeda...
        </div>
        <div
          v-if="vehicles.data.length === 0 && valueSearch === ''"
          class="text-center text-lg font-bold text-gray-900 dark:text-white"
        >
          No hay veh&iacute;culos registrados...
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { ref, computed, defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TablaVehiculos from "@/Components/TablaVehiculos.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import { Inertia } from "@inertiajs/inertia";
import _ from "lodash";

export default defineComponent({
  components: {
    AppLayout,
    TablaVehiculos,
    Input,
    Button,
  },
  props: {
    vehicles: null,
  },
  setup() {
    const valueSearch = ref("");

    const clear = () => {
      valueSearch.value = "";
      //Inertia.get(route("vehiculos.index"));
    };

    const search = _.throttle(() => {
      Inertia.get(
        route("vehiculos.index"),
        { search: valueSearch.value },
        {
          preserveState: true,
        }
      );
    }, 500);

    return {
      search,
      clear,
      valueSearch,
    };
  },
});
</script>