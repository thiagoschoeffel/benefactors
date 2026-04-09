<template>
    <div class="flex justify-center items-center">
        <HeartIcon
            class="mr-1 text-red-400"
            :class="
                size === 'large' ? 'w-14 h-14 md:w-16 md:h-16' : 'w-10 h-10'
            "
        />

        <span
            class="text-gray-700 font-bold tracking-tight"
            :class="
                size === 'large'
                    ? 'text-3xl md:text-4xl'
                    : 'text-xl md:text-2xl'
            "
        >
            Benfeitores
        </span>
    </div>
</template>

<script>
import { HeartIcon } from '@heroicons/vue/outline';

export default {
    components: {
        HeartIcon,
    },

    props: {
        size: {
            type: String,
            default: 'small',
        },
    },
};
</script>
