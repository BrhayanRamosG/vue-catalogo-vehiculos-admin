<template>
  <app-layout title="Registrar veh&iacute;culo">
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
              >A&ntilde;o</label
            >
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
              v-model="Form.year"
              id="year"
            >
              <option disabled value="">Seleccione un elemento</option>
              <option :value="years" v-for="years in rangeYear" :key="years">
                {{ years }}
              </option>
            </select>
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Marca</label
            >
            <Select
              v-model="Form.idmarca"
              name="make"
              idSelect="makek"
              :data="makes"
              nameOption="make_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Modelo</label
            >
            <Select
              v-model="Form.make_models_id"
              name="model"
              idSelect="models"
              :data="filterModels"
              nameOption="model_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Transmisi&oacute;n</label
            >
            <Select
              v-model="Form.transmissions_id"
              name="transmission"
              idSelect="transmissions"
              :data="transmissions"
              nameOption="transmission_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Propietario</label
            >
            <Select
              v-model="Form.proprietaries_id"
              name="proprietary"
              idSelect="proprietaries"
              :data="proprietaries"
              nameOption="proprietary_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Formas de pago</label
            >
            <Select
              v-model="Form.payment_methods_id"
              name="payment_method"
              idSelect="payment_methods"
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
              name="condition"
              idSelect="conditions"
              :data="conditions"
              nameOption="condition_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-2">
            <label class="uppercase md:text-sm text-xs font-semibold"
              >Categor&iacute;a</label
            >
            <Select
              v-model="Form.categories_id"
              name="category"
              idSelect="categories"
              :data="categories"
              nameOption="category_name"
            />
          </div>

          <div class="grid grid-cols-1 mt-4 gap-4">
            <div>
              <DangerButton type="button" nameRoute="vehiculos.index">
                Cancelar
              </DangerButton>
              <Button class="ml-2" type="submit">Registrar</Button>
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
              v-for="(value, index) in validateForm()"
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
import { ref, inject, reactive, computed, defineComponent } from "vue";
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
    makes: Array,
    models: Array,
    transmissions: Array,
    categories: Array,
    proprietaries: Array,
    payment_methods: Array,
    status_vehicles: Array,
    conditions: Array,
  },

  setup({
    makes,
    models,
    transmissions,
    categories,
    proprietaries,
    payment_methods,
    status_vehicles,
    conditions,
  }) {
    const Swal = inject("$swal");

    const user = computed(() => usePage().props.value.auth.user);
    const isValidateForm = ref(false);

    const actuallyYear = new Date().getFullYear();
    const Form = reactive({
      description: "",
      price: "",
      driven: "",
      year: "",
      users_id: user.value.id,
      transmissions_id: "",
      categories_id: "",
      proprietaries_id: "",
      payment_methods_id: "",
      status_vehicles_id: 1,
      conditions_id: "",
      make_models_id: "",
      idmarca: "",
    });

    const rangeYear = computed(() => {
      let arrayYear = [];
      for (let index = actuallyYear + 1; index >= 1985; index--) {
        arrayYear.push(index);
      }
      return arrayYear;
    });

    const filterModels = computed(() => {
      const result = models.filter(
        (value) => value.makes_id === parseInt(Form.idmarca)
      );
      return result;
    });

    const validateForm = () => {
      if (Form.description && Form.price && Form.driven) {
        isValidateForm.value = true;
        return true;
      }
      let errors = [];
      isValidateForm.value = false;
      if (!Form.description) {
        errors.push("Descripcion es requerida");
      }
      if (!Form.price) {
        errors.push("Precio es requerido");
      }
      if (!Form.driven) {
        errors.push("Kilometraje es requerido");
      }
      return errors;
    };

    const createVehicle = () => {
      Inertia.post(route("vehiculos.store"), Form, {
        onSuccess: () => {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Vehículo registrado",
            showConfirmButton: false,
            timer: 2000,
          });
        },
        onError: () =>
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error al registrar vehículo",
            showConfirmButton: false,
            timer: 3000,
          }),
      });
    };

    const sendForm = () => {
      validateForm();
      if (isValidateForm.value) createVehicle();
    };

    return {
      Form,
      rangeYear,
      filterModels,
      makes,
      transmissions,
      categories,
      proprietaries,
      payment_methods,
      status_vehicles,
      conditions,
      sendForm,
      validateForm,
      isValidateForm,
    };
  },
});
</script>