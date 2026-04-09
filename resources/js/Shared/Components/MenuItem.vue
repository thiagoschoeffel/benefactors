<template>
    <Link
        :href="link"
        class="px-5 py-3 mb-2 flex items-center text-lg font-light hover:bg-gray-800 hover:text-white rounded transition duration-200"
        :class="
            $page.url.includes(link)
                ? 'bg-gray-800 text-white'
                : 'text-gray-300'
        "
        @click="handleMenuItemClick"
    >
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link,
    },

    props: {
        link: {
            type: String,
            default: '',
        },
    },

    methods: {
        handleMenuItemClick() {
            return this.$emit('handleMenuItemClick');
        },
    },
};
</script>
