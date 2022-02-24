 <template>
  <editor
    api-key="3bsnv6j862cbn1peuwyz2o9qqij5qpveufjpv40ll6h1riyn"
    :init="{
      height: 270,
      menubar: true,
      skin: store.isDark() ? 'oxide-dark' : 'oxide',
      content_css: store.isDark() ? 'dark' : 'default',
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount',
      ],
      toolbar:
        'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | code help',
    }"
  />
</template>

 <script>
import Editor from "@tinymce/tinymce-vue";
import store from "../store/store";

export default {
  components: {
    Editor,
  },
  setup() {
    return { store };
  },
};
</script>
