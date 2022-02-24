<template>
  <app-layout title="Cotizador">
    <template #header>
      <h2
        class="
          text-gray-900
          dark:text-white
          font-semibold
          text-xl
          leading-tight
        "
      >
        Cotizador
      </h2>
    </template>
    <div class="py-6">
      <div
        class="
          text-gray-900
          dark:text-white
          max-w-7xl
          mx-auto
          px-4
          sm:px-6
          lg:px-8
        "
      >
        <div
          class="
            grid grid-cols-1
            ml-4
            mr-4
            mb-4
          "
        >
          <div class="grid grid-cols-1">
            <label class="mt-2 text-lg" for="">Cotizar cr&eacute;dito</label>
            <select
              class="
                bg-white
                dark:bg-gray-900
                text-gray-900
                dark:text-white
                py-2
                px-3
                rounded-lg
                border-2 border-violet-500
                text-lg
                mt-1
                focus:outline-none
                focus:ring-2
                focus:ring-sky-500
                focus:border-transparent
              "
              v-model="form.opcCredito"
              id="ocpcredito"
              name="selectcredito"
              @change="clear(1)"
            >
              <option disabled selected value="0">
                Seleccione una opci&oacute;n
              </option>
              <option value="1">Si</option>
              <option value="2">No</option>
            </select>
          </div>

          <div v-if="form.opcCredito != null" class="grid grid-cols-1">
            <label class="mt-2 text-lg" for="">Opciones</label>
            <select
              class="
                bg-white
                dark:bg-gray-900
                text-gray-900
                dark:text-white
                py-2
                px-3
                rounded-lg
                border-2 border-violet-500
                text-lg
                mt-1
                focus:outline-none
                focus:ring-2
                focus:ring-sky-500
                focus:border-transparent
              "
              v-model="form.opc"
              id="ocp"
              name="select"
              @change="clear(2)"
            >
              <option disabled selected value="0">
                Seleccione una opci&oacute;n
              </option>
              <option value="1">Porcentaje enganche</option>
              <option value="2">Cantidad enganche</option>
            </select>
          </div>

          <div v-if="form.opcCredito != null" class="grid grid-cols-1">
            <label class="mt-2 text-lg" for="">Precio</label>
            <input
              v-model="form.price"
              type="number"
              class="
                bg-white
                dark:bg-gray-900
                text-gray-900
                dark:text-white
                py-2
                px-3
                rounded-lg
                border-2 border-violet-500
                text-lg
                mt-1
                focus:outline-none
                focus:ring-2
                focus:ring-sky-500
                focus:border-transparent
              "
              placeholder="Precio"
              min="1"
            />
          </div>

          <div v-if="form.opc === '1'" class="grid grid-cols-1" id="penganche">
            <label class="mt-2 text-lg" for="">Porcentaje enganche</label>
            <input
              v-model="form.percentage"
              type="number"
              class="
                bg-white
                dark:bg-gray-900
                text-gray-900
                dark:text-white
                py-2
                px-3
                rounded-lg
                border-2 border-violet-500
                text-lg
                mt-1
                focus:outline-none
                focus:ring-2
                focus:ring-sky-500
                focus:border-transparent
              "
              placeholder="Porcentaje"
              min="0"
              max="100"
              @input="updateValue"
            />
          </div>

          <div v-if="form.opc === '2'" class="grid grid-cols-1" id="cenganche">
            <label class="mt-2 text-lg" for="">Cantidad enganche</label>
            <input
              v-model="form.priceEng"
              type="number"
              class="
                bg-white
                dark:bg-gray-900
                text-gray-900
                dark:text-white
                py-2
                px-3
                rounded-lg
                border-2 border-violet-500
                text-lg
                mt-1
                focus:outline-none
                focus:ring-2
                focus:ring-sky-500
                focus:border-transparent
              "
              placeholder="Cantidad enganche"
              min="0"
              :max="form.price"
              @input="updateValueEnganche"
            />
          </div>

          <div
            v-if="form.opcCredito === '1' && form.opc != null"
            class="grid grid-cols-1 mt-5"
            id="credito"
          >
            <hr class="border border-cyan-600" />
            <div class="grid">
              <label class="mt-2 text-lg" for=""
                >Inter&eacute;s cr&eacute;dito</label
              >
              <input
                v-model="form.percentageInteres"
                type="number"
                class="
                  bg-white
                  dark:bg-gray-900
                  text-gray-900
                  dark:text-white
                  py-2
                  px-3
                  rounded-lg
                  border-2 border-violet-500
                  text-lg
                  mt-1
                  focus:outline-none
                  focus:ring-2
                  focus:ring-sky-500
                  focus:border-transparent
                "
                placeholder="Porcentaje interés por apertura de crédito"
                min="0"
                max="100"
                @input="updateValueInteres"
              />
            </div>
            <div class="grid">
              <label class="mt-2 text-lg" for="">Mensualidad</label>
              <input
                v-model="form.mensualidad"
                type="number"
                class="
                  bg-white
                  dark:bg-gray-900
                  text-gray-900
                  dark:text-white
                  py-2
                  px-3
                  rounded-lg
                  border-2 border-violet-500
                  text-lg
                  mt-1
                  focus:outline-none
                  focus:ring-2
                  focus:ring-sky-500
                  focus:border-transparent
                "
                placeholder="Mensualidad"
                min="1"
                max="360"
                @input="updateValueMeses"
              />
            </div>
          </div>

          <div class="mt-5 text-white">
            <TableCotizacion
              v-if="precioRestante != null && enganche != null"
              :precio="formatoMexico(precio)"
              :precioEnganche="formatoMexico(enganche)"
              :precioRestante="formatoMexico(precioRestante)"
              :porcentaje="form.percentage"
              :opc="form.opc"
              :mensualidades="form.mensualidad"
              :precioMensualidad="formatoMexico(calculateCredito)"
              :creditoOpc="form.opcCredito"
              :porcentajeInteres="form.percentageInteres"
              :year="monthsToYears"
              :precioint="formatoMexico(calculatePrecioInteres)"
            />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { reactive, computed, defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TableCotizacion from "@/Components/TableCotizacion.vue";

export default defineComponent({
  components: {
    AppLayout,
    TableCotizacion,
  },

  setup() {
    const form = reactive({
      opc: null,
      price: null,
      percentage: null,
      priceEng: null,
      opcCredito: null,
      percentageInteres: null,
      mensualidad: null,
    });
    const precio = computed(() => (form.price * 1).toFixed(2));

    const formatoMexico = (number) => {
      const exp = /(\d)(?=(\d{3})+(?!\d))/g;
      const rep = "$1,";
      return number.toString().replace(exp, rep);
    };

    const clear = (selected) => {
      if (selected === 1) {
        switch (form.opcCredito) {
          case "1":
            break;
          case "2":
            form.percentageInteres = null;
            form.mensualidad = null;
            break;
        }
      } else if (selected === 2) {
        switch (form.opc) {
          case "1":
            form.priceEng = null;
            break;
          case "2":
            form.percentage = null;
            break;
        }
      }
    };

    const updateValue = (event) => {
      const value = event.target.value;
      if (
        String(value).length <= 3 &&
        String(value) >= 0 &&
        String(value) <= 100
      ) {
        form.percentage = value;
      } else {
        form.percentage = "";
      }
    };

    const updateValueEnganche = (event) => {
      const value = event.target.value;
      if (
        String(value).length <= 9 &&
        String(value) >= 0 &&
        String(value) <= form.price
      ) {
        form.priceEng = value;
      } else {
        form.priceEng = null;
      }
    };

    const updateValueInteres = (event) => {
      const value = event.target.value;
      if (
        String(value).length <= 3 &&
        String(value) >= 0 &&
        String(value) <= 100
      ) {
        form.percentageInteres = value;
      } else {
        form.percentageInteres = null;
      }
    };

    const updateValueMeses = (event) => {
      const value = event.target.value;
      if (
        String(value).length <= 3 &&
        String(value) >= 1 &&
        String(value) <= 360
      ) {
        form.mensualidad = value;
      } else {
        form.mensualidad = null;
      }
    };

    const enganche = computed(() => {
      if (form.opc === "1") {
        if (form.price != null && form.percentage != null) {
          const result = form.price * (form.percentage / 100);
          return result.toFixed(2);
        }
      } else if (form.opc === "2") {
        if (form.price != null && form.priceEng != null) {
          const result = form.priceEng * 1;
          return result.toFixed(2);
        }
      }
    });

    const calculatePrecioInteres = computed(() => {
      const precio = parseFloat(form.price);
      const porInteres = parseFloat(form.percentageInteres);
      const precioInteres = precio + precio * (porInteres / 100);
      return precioInteres.toFixed(2);
    });

    const precioRestante = computed(() => {
      if (form.percentageInteres > "0") {
        const result = calculatePrecioInteres.value - enganche.value;
        return result.toFixed(2);
      } else {
        const result = form.price - enganche.value;
        return result.toFixed(2);
      }
    });

    const calculateCredito = computed(() => {
      const adeudo = parseFloat(precioRestante.value);
      const result = adeudo / parseInt(form.mensualidad);
      return result.toFixed(2);
    });

    const monthsToYears = computed(() => {
      const meses = parseInt(form.mensualidad);
      const formula = meses / 12;
      const result = formula;
      return result.toFixed(1);
    });

    return {
      clear,
      updateValue,
      updateValueEnganche,
      updateValueInteres,
      updateValueMeses,
      form,
      enganche,
      precioRestante,
      formatoMexico,
      precio,
      calculateCredito,
      calculatePrecioInteres,
      monthsToYears,
    };
  },
});
</script>
