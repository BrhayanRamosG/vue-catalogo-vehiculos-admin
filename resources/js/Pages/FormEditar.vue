<template>
  <app-layout :title="`Editar veh&iacute;culo ID ${vehicleInfo.id}`">
    <div class="container py-16">
      <div
        class="
          grid grid-cols-1
          mx-auto
          px-4
          sm:px-6
          lg:px-8
          py-4
          ml-4
          mt-2
          mr-4
          mb-4
          text-gray-900
          dark:text-white
        "
      >
        <form @submit.prevent="sendForm" class="mb-6">
          <div class="grid grid-cols-1">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Descripci&oacute;n</label
            >
            <Editor v-model="Form.description" />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Precio</label
            >
            <input-format
              id="precio"
              placeholder="Ingrese precio"
              v-model="Form.price"
              :money="true"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Kilometraje</label
            >
            <input-format
              id="kilometraje"
              placeholder="Ingrese kilometraje"
              v-model="Form.driven"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Estado veh&iacute;culo</label
            >
            <Select
              v-model="Form.status_vehicles_id"
              id="status_vehicles"
              :data="status_vehicles"
              nameOption="status_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Formas de pago</label
            >
            <Select
              v-model="Form.payment_methods_id"
              id="payment_methods"
              :data="payment_methods"
              nameOption="payment_method_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Condici&oacute;n</label
            >
            <Select
              v-model="Form.conditions_id"
              id="conditions"
              :data="conditions"
              nameOption="condition_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-4 gap-4">
            <div>
              <DangerButton type="button" nameRoute="vehiculos.index">
                Cancelar
              </DangerButton>
              <Button class="ml-2" type="submit">Actualizar</Button>
            </div>
          </div>
        </form>
        <AlertDanger
          v-if="isValidateForm === false"
          title="Formulario incompleto"
        >
          Errores encontrados:
          <ul>
            <li
              class="font-bold"
              v-for="(value, index) in checkForm()"
              :key="index"
            >
              {{ value }}
            </li>
          </ul>
        </AlertDanger>
      </div>
      {{ Form }}
    </div>
  </app-layout>
</template>

<script>
import { inject, ref, reactive, computed, defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Select from "@/Components/SelectDB.vue";
import InputFormat from "@/Components/InputFormat.vue";
import Editor from "@/Components/Editor.vue";
import AlertDanger from "@/Components/AlertDanger.vue";

export default defineComponent({
  components: {
    AppLayout,
    Button,
    DangerButton,
    Select,
    InputFormat,
    Editor,
    AlertDanger,
  },
  props: {
    vehicle: Object,
    status_vehicles: Array,
    payment_methods: Array,
    conditions: Array,
  },
  setup({ vehicle, status_vehicles, payment_methods, conditions }) {
    const Swal = inject("$swal");
    const user = computed(() => usePage().props.value.auth.user);
    const vehicleInfo = computed(() => vehicle);

    const isValidateForm = ref(false);

    const Form = reactive({
      users_id: user.value.id,
      status_vehicles_id: 1,
      price: vehicleInfo.value.price,
      description: vehicleInfo.value.description,
      driven: vehicleInfo.value.driven,
      status_vehicles_id: vehicleInfo.value.status_vehicles_id,
      payment_methods_id: vehicleInfo.value.payment_methods_id,
      conditions_id: vehicleInfo.value.conditions_id,
    });

    const checkForm = () => {
      let error = [];

      if (Form.price != "" && Form.driven != "" && Form.description != "") {
        isValidateForm.value = true;
        return true;
      }
      isValidateForm.value = false;
      if (!Form.price) {
        error.push("Precio es requerido");
      }
      if (!Form.driven) {
        error.push("Kilometraje es requerido");
      }
      if (!Form.description) {
        error.push("Descripción es requerida");
      }
      return error;
    };

    const editVehicle = () => {
      //if (checkForm === true) {
      Inertia.put(route("vehiculos.update", vehicle.id), Form, {
        onSuccess: () => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `Vehículo con ID ${vehicle.id} actualizado`,
            showConfirmButton: false,
            timer: 2000,
          });
        },
        onError: () =>
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error al actualizar vehículo",
            showConfirmButton: false,
            timer: 2500,
          }),
      });
      //}
    };

    const sendForm = () => {
      checkForm();
      if (isValidateForm.value) editVehicle();
    };

    return {
      vehicle,
      status_vehicles,
      payment_methods,
      conditions,
      Form,
      vehicleInfo,
      isValidateForm,
      sendForm,
      checkForm,
    };
  },
});
</script>