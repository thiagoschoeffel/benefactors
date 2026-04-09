<template>
    <div class="h-screen relative z-0 flex flex-col">
        <Navbar @handleToggleSidebar="handleToggleSidebar" />

        <div class="flex flex-grow overflow-hidden">
            <Sidebar
                :visible="sidebarVisibleComputed"
                @handleMenuItemClick="handleMenuItemClick"
            />

            <div
                class="p-8 flex-1 overflow-auto"
                :class="sidebarVisibleComputed ? 'blur-lg' : ''"
            >
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Shared/Components/Navbar.vue';
import Sidebar from '@/Shared/Components/Sidebar.vue';

const theme = require('tailwindcss/defaultTheme');

export default {
    components: {
        Navbar,
        Sidebar,
    },

    data() {
        return {
            windowWidth: 0,
            sidebarVisible: false,
            mdBreakpoint: Number(theme.screens.md.replace('px', '')),
        };
    },

    computed: {
        sidebarVisibleComputed() {
            return this.windowWidth > this.mdBreakpoint
                ? false
                : this.sidebarVisible;
        },
    },

    methods: {
        updateWindowSize() {
            this.windowWidth = window.innerWidth;
        },

        handleToggleSidebar() {
            this.sidebarVisible = !this.sidebarVisible;
        },

        handleMenuItemClick() {
            this.sidebarVisible = false;
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
