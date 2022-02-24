<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-4 border-sky-600 dark:border-sky-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-700 transition'
                    : 'text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-blue-600 dark:hover:text-blue-500 hover:border-blue-300 focus:outline-none focus:text-blue-700 focus:border-blue-300 transition'
            }
        }
    })
</script>
