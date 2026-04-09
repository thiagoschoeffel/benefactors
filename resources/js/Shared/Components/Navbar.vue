<template>
    <div
        class="relative z-20 px-8 py-6 flex items-center justify-between flex-shrink-0 bg-white shadow"
    >
        <div class="flex items-center">
            <button class="p-2 md:hidden" @click="handleToggleSidebar">
                <MenuIcon class="w-6 h-6 text-gray-700" />
            </button>

            <div class="inline-block w-0.5 h-5 mx-4 bg-gray-200 md:hidden" />

            <Logo />
        </div>

        <div>
            <button
                href="/login"
                class="p-1 flex justify-items-center items-center text-gray-700 box-border transition duration-200 hover:text-red-400"
                @click="handleLogout"
            >
                <svg
                    v-if="logoutProcessing"
                    viewBox="0 0 24 24"
                    class="animate-spin w-5 h-5 mr-1"
                >
                    <path
                        fill="currentColor"
                        d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"
                    />
                </svg>

                <LogoutIcon v-else class="w-5 h-5" />
            </button>
        </div>
    </div>
</template>

<script>
import { MenuIcon, LogoutIcon } from '@heroicons/vue/solid';

import Logo from '@/Shared/Components/Logo.vue';

export default {
    components: {
        Logo,
        MenuIcon,
        LogoutIcon,
    },

    data() {
        return {
            logoutProcessing: false,
        };
    },

    methods: {
        handleToggleSidebar() {
            this.$emit('handleToggleSidebar');
        },

        handleLogout() {
            this.$inertia.delete('/login/destroy', {
                onStart: () => {
                    this.logoutProcessing = true;
                },
                onFinish: () => {
                    this.logoutProcessing = false;
                },
            });
        },
    },
};
</script>
