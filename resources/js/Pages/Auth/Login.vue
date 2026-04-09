<template>
    <div class="flex flex-row justify-center items-center h-screen z-0">
        <div class="w-80 sm:w-96 p-4">
            <Logo size="large" />

            <div class="w-14 h-1 mx-auto my-7 bg-gray-300" />

            <form @submit.prevent="submit">
                <div class="grid grid-cols-12 gap-4 mb-10">
                    <div class="col-span-12">
                        <label
                            for="email"
                            class="mb-2 block text-md text-gray-500"
                        >
                            E-Mail
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="w-full p-4 rounded shadow"
                            :class="
                                errors.email
                                    ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                                    : 'border-none focus:ring-2 focus:ring-gray-700'
                            "
                            v-model="form.email"
                            autofocus
                        />
                        <span
                            v-if="errors.email"
                            class="block mt-1 text-sm text-red-400"
                        >
                            {{ errors.email }}
                        </span>
                    </div>

                    <div class="col-span-12">
                        <label
                            for="password"
                            class="mb-2 block text-md text-gray-500"
                        >
                            Senha
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full p-4 rounded shadow"
                            :class="
                                errors.password
                                    ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                                    : 'border-none focus:ring-2 focus:ring-gray-700'
                            "
                            v-model="form.password"
                        />
                        <span
                            v-if="errors.password"
                            class="block mt-1 text-sm text-red-400"
                        >
                            {{ errors.password }}
                        </span>
                    </div>
                </div>

                <div class="col-span-12">
                    <div class="col-span-12">
                        <button
                            type="submit"
                            class="flex justify-center items-center p-4 text-gray-300 hover:text-white bg-gray-700 rounded shadow hover:shadow-lg hover:bg-gray-800 w-full transition duration-200 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <svg
                                v-if="form.processing"
                                viewBox="0 0 24 24"
                                class="animate-spin w-5 h-5 mr-1"
                            >
                                <path
                                    fill="currentColor"
                                    d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"
                                />
                            </svg>

                            <LoginIcon v-else class="w-5 h-5 mr-1" />

                            Entrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { LoginIcon } from '@heroicons/vue/solid';
import { useForm } from '@inertiajs/vue3';
import Logo from '@/Shared/Components/Logo.vue';

export default {
    components: {
        Logo,
        LoginIcon,
    },

    props: {
        errors: Object,
    },

    data() {
        return {
            form: useForm({
                email: '',
                password: '',
            }),
        };
    },

    methods: {
        submit() {
            this.form.post('/login/store', {
                preserveState: (page) => Object.keys(page.props.errors).length,
            });
        },
    },
};
</script>
