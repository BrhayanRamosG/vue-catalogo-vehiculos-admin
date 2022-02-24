<template>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div
        class="
          text-gray-900
          dark:text-white
          py-4
          px-1
          align-middle
          inline-block
          min-w-full
          sm:px-6
          lg:px-8
        "
      >
        {{ tableName }}
        <div class="mt-2 mb-5">
          <SuccessButton type="button" nameRoute="vehiculos.create">
            <PlusCircleIcon class="h-5 w-5 text-white" />
          </SuccessButton>
        </div>
        <div
          v-if="vehicles.data.length > 0"
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
        >
          <table class="table-auto min-w-full divide-y divide-gray-700">
            <thead class="text-sm bg-gray-900 dark:bg-gray-700">
              <tr>
                <th
                  scope="col"
                  class="
                    px-4
                    py-3
                    text-left text-white
                    uppercase
                    tracking-wider
                    font-bold
                  "
                >
                  #
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left
                    font-medium
                    text-white
                    uppercase
                    tracking-wider
                  "
                >
                  ID
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left
                    font-medium
                    text-white
                    uppercase
                    tracking-wider
                  "
                >
                  Precio
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left
                    font-medium
                    text-white
                    uppercase
                    tracking-wider
                  "
                >
                  Kilometraje
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left
                    font-medium
                    text-white
                    uppercase
                    tracking-wider
                  "
                >
                  A&ntilde;o
                </th>
                <th
                  scope="col"
                  class="
                    relative
                    px-6
                    py-3
                    text-center
                    font-medium
                    text-white
                    uppercase
                    tracking-wider
                  "
                >
                  <!-- <span class="sr-only">Opciones</span> -->
                  Opciones
                </th>
              </tr>
            </thead>
            <tbody
              class="
                text-sm
                bg-sky-700
                dark:bg-sky-900
                divide-y divide-gray-200
              "
            >
              <tr v-for="(vehicle, index) in vehicles.data" :key="vehicle.id">
                <td class="px-4 py-4 whitespace-nowrap">
                  <div class="font-bold text-gray-100">
                    {{ index + 1 }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-gray-100">{{ vehicle.id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-100">
                  {{ vehicle.price }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-100">
                  {{ vehicle.driven }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-100">
                  {{ vehicle.year }}
                </td>
                <td
                  class="
                    px-6
                    py-4
                    whitespace-nowrap
                    text-center text-sm
                    font-medium
                  "
                >
                  <InfoButton
                    type="button"
                    nameRoute="vehiculos.show"
                    :parametro="vehicle.id"
                  >
                    <InformationCircleIcon class="h-5 w-5 text-white" />
                  </InfoButton>
                  &nbsp;
                  <WarningButton
                    type="button"
                    nameRoute="vehiculos.edit"
                    :parametro="vehicle.id"
                  >
                    <PencilAltIcon class="h-5 w-5 text-white" />
                  </WarningButton>
                  &nbsp;
                  <!-- <DangerButton
                    @click="confirmingVehicleDeletion"
                    metodo="DELETE"
                    type="button"
                    nameRoute="vehiculos.destroy"
                    :parametro="vehicles.id"
                  >
                    <TrashIcon class="h-5 w-5 text-white" />
                  </DangerButton> -->
                  <jet-danger-button @click="confirmVehicleDeletion(vehicle)">
                    <TrashIcon class="h-5 w-5 text-white" />
                  </jet-danger-button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="p-5 flex justify-end">
            <Link
              as="button"
              :disabled="!vehicles.prev_page_url"
              :href="vehicles.prev_page_url"
              class="bg-pink-700 text-white rounded px-2"
              :class="
                !vehicles.prev_page_url && 'opacity-50 cursor-not-allowed'
              "
            >
              Anterior
            </Link>
            <Link
              as="button"
              :disabled="!vehicles.next_page_url"
              :href="vehicles.next_page_url"
              class="bg-pink-700 text-white rounded ml-2 px-2"
              :class="
                !vehicles.next_page_url && 'opacity-50 cursor-not-allowed'
              "
            >
              Siguiente
            </Link>
          </div>
          <jet-dialog-modal
            :show="confirmingVehicleDeletion"
            @close="closeModal"
          >
            <template #title>
              Eliminar veh&iacute;culo ID
              <strong>{{ infoVehicleDelete.id }}</strong>
            </template>

            <template #content>
              ¿Est&aacute; seguro que desea eliminar este veh&iacute;culo?
            </template>

            <template #footer>
              <jet-secondary-button @click="closeModal">
                Cancelar
              </jet-secondary-button>

              <jet-danger-button class="ml-2" @click="deleteVehicle">
                Elimnar veh&iacute;culo
              </jet-danger-button>
            </template>
          </jet-dialog-modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, inject, defineComponent } from "vue";
import SuccessButton from "@/Components/SuccessButton.vue";
import InfoButton from "@/Components/InfoButton.vue";
import NeutroButton from "@/Components/NeutroButton.vue";
import WarningButton from "@/Components/WarningButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { Link } from "@inertiajs/inertia-vue3";
import {
  InformationCircleIcon,
  PencilAltIcon,
  TrashIcon,
  PlusCircleIcon,
} from "@heroicons/vue/outline";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import { Inertia } from "@inertiajs/inertia";

export default defineComponent({
  components: {
    Link,
    SuccessButton,
    InfoButton,
    NeutroButton,
    DangerButton,
    WarningButton,
    InformationCircleIcon,
    PencilAltIcon,
    TrashIcon,
    PlusCircleIcon,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
    JetDangerButton,
  },
  props: {
    tableName: String,
    vehicles: Object,
  },
  setup() {
    const Swal = inject("$swal");

    const confirmingVehicleDeletion = ref(false);
    const infoVehicleDelete = ref({});

    const confirmVehicleDeletion = (vehicle) => {
      confirmingVehicleDeletion.value = true;
      infoVehicleDelete.value = vehicle;
    };

    const deleteVehicle = () => {
      Inertia.delete(route("vehiculos.destroy", infoVehicleDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => {
          closeModal();
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Éxito",
            text: `Vehículo con ID ${infoVehicleDelete.value.id} eliminado`,
            showConfirmButton: false,
            timer: 3500,
          });
        },
        onError: () =>
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error",
            text: `Vehículo con ID ${infoVehicleDelete.value.id} no se pudo eliminar`,
            showConfirmButton: false,
            timer: 2500,
          }),
        // onFinish: () =>,
      });
    };

    const closeModal = () => {
      confirmingVehicleDeletion.value = false;
    };

    return {
      deleteVehicle,
      confirmingVehicleDeletion,
      confirmVehicleDeletion,
      closeModal,
      infoVehicleDelete,
    };
  },
});
</script>
