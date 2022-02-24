<template>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
        >
          <table class="min-w-full divide-y divide-gray-700">
            <thead class="text-xl bg-gray-900 dark:bg-gray-700">
              <tr>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-white
                    uppercase
                    tracking-wider
                  "
                >
                  Descripci&oacute;n
                </th>
                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-white
                    uppercase
                    tracking-wider
                  "
                >
                  Valor
                </th>
              </tr>
            </thead>
            <tbody class="text-xl bg-sky-700 dark:bg-sky-900 divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">Precio</td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  ${{ precio }} MXN
                </td>
              </tr>
              <tr v-if="porcentajeInteres > '0'">
                <td class="px-6 py-4 whitespace-nowrap">Precio con inter&eacute;s</td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  ${{ precioint }} MXN
                </td>
              </tr>
              <tr v-if="opc === '1'">
                <td class="px-6 py-4 whitespace-nowrap">Porcentaje enganche</td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  {{ porcentaje }}%
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">Enganche</td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  ${{ precioEnganche }} MXN
                </td>
              </tr>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">Adeudo restante</td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  ${{ precioRestante }} MXN
                </td>
              </tr>

              <tr v-if="creditoOpc === '1' && porcentajeInteres != null">
                <td class="px-6 py-4 whitespace-nowrap">
                  Porcentaje inter&eacute;s
                </td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  {{ porcentajeInteres }}%
                </td>
              </tr>

              <tr v-if="creditoOpc === '1' && mensualidades != null">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div>Mensualidad</div>
                  <div>
                    {{ mensualidades }}
                    {{ mensualidades > "1" ? "meses" : "mes" }}
                  </div>
                  <div>
                    {{ year }}
                    {{ year === "0.1" || year === "1.0" ? "año" : "años" }}
                  </div>
                </td>
                <td class="font-bold px-6 py-4 whitespace-nowrap">
                  ${{ precioMensualidad }} MXN
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    precioEnganche: String,
    precioRestante: String,
    precio: String,
    precioint: null,
    porcentaje: null,
    mensualidades: null,
    precioInteres: null,
    precioMensualidad: null,
    porcentajeInteres: null,
    opc: String,
    creditoOpc: String,
    year: null,
  },
  setup() {},
});
</script>
