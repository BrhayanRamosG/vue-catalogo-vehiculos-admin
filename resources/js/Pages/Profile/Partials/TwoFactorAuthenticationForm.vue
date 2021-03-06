<template>
  <jet-action-section>
    <template #title> Autenticaci&oacute;n de dos factores </template>

    <template #description>
      Agregue seguridad adicional a su cuenta mediante la autenticaci&oacute;n
      de dos factores.
    </template>

    <template #content>
      <h3
        class="text-lg font-medium text-gray-900 dark:text-gray-100"
        v-if="twoFactorEnabled"
      >
        Ha habilitado la autenticaci&oacute;n de dos factores.
      </h3>

      <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" v-else>
        No ha habilitado la autenticaci&oacute;n de dos factores.
      </h3>

      <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-200">
        <p>
          Cuando la autenticaci&oacute;n de dos factores est&aacute; habilitada,
          se le solicitar&aacute; un token seguro y aleatorio durante la
          autenticaci&oacute;n. Puede recuperar este token de la
          aplicaci&oacute;n Google Authenticator de su tel&eacute;fono.
        </p>
      </div>

      <div v-if="twoFactorEnabled">
        <div v-if="qrCode">
          <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-200">
            <p class="font-semibold">
              La autenticaci&oacute;n de dos factores ahora est&aacute;
              habilitada. Escanee el siguiente c&oacute;digo QR usando la
              aplicaci&oacute;n de autenticaci&oacute;n de su tel&eacute;fono.
            </p>
          </div>

          <div class="mt-4" v-html="qrCode"></div>
        </div>

        <div v-if="recoveryCodes.length > 0">
          <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-200">
            <p class="font-semibold">
              Guarde estos c&oacute;digos de recuperaci&oacute;n en un
              administrador de contrase&ntilde;as seguro. Se pueden usar para
              recuperar el acceso a su cuenta si se pierde su dispositivo de
              autenticaci&oacute;n de dos factores.
            </p>
          </div>

          <div
            class="
              grid
              gap-1
              max-w-xl
              mt-4
              px-4
              py-4
              font-mono
              text-sm
              bg-gray-100
              dark:bg-gray-500 dark:text-gray-100
              rounded-lg
            "
          >
            <div v-for="code in recoveryCodes" :key="code">
              {{ code }}
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <div v-if="!twoFactorEnabled">
          <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
            <jet-button
              type="button"
              :class="{ 'opacity-25': enabling }"
              :disabled="enabling"
            >
              Habilitar
            </jet-button>
          </jet-confirms-password>
        </div>

        <div v-else>
          <jet-confirms-password @confirmed="regenerateRecoveryCodes">
            <jet-secondary-button class="mr-3" v-if="recoveryCodes.length > 0">
              Regenerar c&oacute;digos de recuperaci&oacute;n
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="showRecoveryCodes">
            <jet-secondary-button
              class="mr-3"
              v-if="recoveryCodes.length === 0"
            >
              Mostrar c&oacute;digos de recuperaci&oacute;n
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
            <jet-danger-button
              :class="{ 'opacity-25': disabling }"
              :disabled="disabling"
            >
              Desactivar
            </jet-danger-button>
          </jet-confirms-password>
        </div>
      </div>
    </template>
  </jet-action-section>
</template>

<script>
import { defineComponent } from "vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
  components: {
    JetActionSection,
    JetButton,
    JetConfirmsPassword,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      enabling: false,
      disabling: false,

      qrCode: null,
      recoveryCodes: [],
    };
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true;

      this.$inertia.post(
        "/user/two-factor-authentication",
        {},
        {
          preserveScroll: true,
          onSuccess: () =>
            Promise.all([this.showQrCode(), this.showRecoveryCodes()]),
          onFinish: () => (this.enabling = false),
        }
      );
    },

    showQrCode() {
      return axios.get("/user/two-factor-qr-code").then((response) => {
        this.qrCode = response.data.svg;
      });
    },

    showRecoveryCodes() {
      return axios.get("/user/two-factor-recovery-codes").then((response) => {
        this.recoveryCodes = response.data;
      });
    },

    regenerateRecoveryCodes() {
      axios.post("/user/two-factor-recovery-codes").then((response) => {
        this.showRecoveryCodes();
      });
    },

    disableTwoFactorAuthentication() {
      this.disabling = true;

      this.$inertia.delete("/user/two-factor-authentication", {
        preserveScroll: true,
        onSuccess: () => (this.disabling = false),
      });
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.props.user.two_factor_enabled;
    },
  },
});
</script>
