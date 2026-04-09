<template>
    <div
        class="flex flex-1 lg:flex-none last-of-type:mr-0 mr-2 lg:mb-2"
        v-for="(link, key) in paginationVisibleComputed"
        :key="key"
    >
        <Link
            v-if="link.url !== null"
            :href="link.url"
            class="flex-1 lg:flex-none px-5 py-4 bg-white rounded text-gray-700 shadow text-center"
            :class="
                link.active ? 'bg-gray-800 text-white' : 'hover:bg-gray-100'
            "
            v-html="link.label"
        />

        <span
            v-else
            class="flex-1 lg:flex-none px-5 py-4 bg-white rounded text-gray-700 shadow text-center cursor-not-allowed opacity-70"
            v-html="link.label"
        />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

const theme = require('tailwindcss/defaultTheme');

export default {
    components: {
        Link,
    },

    props: {
        links: Object,
        errors: Object,
    },

    data() {
        return {
            windowWidth: 0,
            lgBreakpoint: Number(theme.screens.lg.replace('px', '')),
        };
    },

    computed: {
        paginationVisibleComputed() {
            if (this.windowWidth > this.lgBreakpoint) {
                return this.links;
            }

            const linksArray = [];
            linksArray.push(this.links[0]);
            linksArray.push(this.links[this.links.length - 1]);

            return linksArray;
        },
    },

    methods: {
        updateWindowSize() {
            this.windowWidth = window.innerWidth;
        },
    },

    mounted() {
        this.updateWindowSize();
        window.addEventListener('resize', this.updateWindowSize);
    },

    beforeDestroyed() {
        window.removeEventListener('resize', this.updateWindowSize);
    },
};
</script>
