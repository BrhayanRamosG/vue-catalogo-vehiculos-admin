import { reactive } from 'vue'

const store = reactive({
    theme: '',
    isDark() {
        if (this.theme === 'dark') {
            return true;
        }
        else {
            return false;
        }
    }
});

export default store;