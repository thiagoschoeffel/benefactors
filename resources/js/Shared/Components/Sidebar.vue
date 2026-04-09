<template>
    <div
        class="w-80 px-8 py-6 fixed md:relative inset-y-0 left-0 top-[88px] md:top-0 z-10 md:z-0 flex justify-between flex-col flex-shrink-0 bg-gray-700 overflow-y-auto shadow md:shadow-none transform transition duration-200 ease-in-out md:translate-x-0"
        :class="!visible ? '-translate-x-full' : ''"
    >
        <div class="w-full">
            <MenuItem
                link="/dashboard"
                @handleMenuItemClick="handleMenuItemClick"
            >
                <TemplateIcon class="w-5 h-5 mr-1" />
                Dashboard
            </MenuItem>

            <MenuItem
                link="/benefactors"
                @handleMenuItemClick="handleMenuItemClick"
            >
                <UsersIcon class="w-5 h-5 mr-1" /> Benfeitores
            </MenuItem>

            <MenuItem
                link="/contributions"
                @handleMenuItemClick="handleMenuItemClick"
            >
                <CurrencyDollarIcon class="w-5 h-5 mr-1" /> Contribuições
            </MenuItem>

            <MenuItem
                link="/reports"
                @handleMenuItemClick="handleMenuItemClick"
            >
                <DocumentReportIcon class="w-5 h-5 mr-1" /> Relatórios
            </MenuItem>
        </div>
    </div>
</template>

<script>
import {
    TemplateIcon,
    UsersIcon,
    CurrencyDollarIcon,
    DocumentReportIcon,
} from '@heroicons/vue/solid';

import MenuItem from '@/Shared/Components/MenuItem.vue';

export default {
    components: {
        MenuItem,
        TemplateIcon,
        UsersIcon,
        CurrencyDollarIcon,
        DocumentReportIcon,
    },

    props: {
        visible: {
            type: Boolean,
            default: false,
        },
    },

    methods: {
        handleMenuItemClick() {
            return this.$emit('handleMenuItemClick');
        },
    },
};
</script>
