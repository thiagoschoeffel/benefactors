<template>
    <h1 class="mb-5 text-3xl font-bold text-gray-700">Relatórios</h1>

    <div class="grid grid-flow-row grid-cols-12 gap-4">
        <div
            class="
                bg-white
                shadow
                rounded
                col-span-12
                lg:col-span-6
                overflow-hidden
                flex flex-col
                justify-between
            "
        >
            <div class="p-4">
                <span class="block text-xs text-gray-400 mb-1">Nome</span>

                <span class="block text-xl text-gray-700 mb-5 font-medium">
                    Ficha de Cadastro
                </span>

                <span class="block text-xs text-gray-400 mb-1">Descrição</span>

                <span class="block text-md text-gray-700">
                    Este relatório emite uma ficha de cadastro em branco para
                    novos benfeitores preencherem.
                </span>
            </div>

            <a
                href="/benefactors/report"
                target="_blank"
                class="
                    flex
                    justify-center
                    items-center
                    p-4
                    text-gray-300
                    hover:text-white
                    bg-gray-700
                    shadow
                    hover:shadow-lg hover:bg-gray-800
                    transition
                    duration-200
                "
            >
                <DocumentDownloadIcon class="w-5 h-5 mr-1" />
                Gerar Relatório
            </a>
        </div>

        <div
            class="
                bg-white
                shadow
                rounded
                col-span-12
                lg:col-span-6
                overflow-hidden
                flex flex-col
                justify-between
            "
        >
            <div class="p-4">
                <span class="block text-xs text-gray-400 mb-1">Nome</span>

                <span class="block text-xl text-gray-700 mb-5 font-medium">
                    Contribuições
                </span>

                <span class="block text-xs text-gray-400 mb-1">Descrição</span>

                <span class="block text-md text-gray-700">
                    Este relatório imprime um resumo das contribuições no
                    período informado no filtro.
                </span>
            </div>

            <button
                type="button"
                class="
                    flex
                    justify-center
                    items-center
                    p-4
                    text-gray-300
                    hover:text-white
                    bg-gray-700
                    shadow
                    hover:shadow-lg hover:bg-gray-800
                    transition
                    duration-200
                "
                @click="
                    reportContribuitionsModalVisible =
                        !reportContribuitionsModalVisible
                "
            >
                <DocumentDownloadIcon class="w-5 h-5 mr-1" />
                Gerar Relatório
            </button>
        </div>
    </div>

    <!-- Start Modal Contributions -->
    <div
        class="bg-gray-700 bg-opacity-50 fixed inset-0 z-20"
        :class="
            reportContribuitionsModalVisible
                ? 'flex justify-center items-center'
                : 'hidden'
        "
    >
        <div class="bg-white rounded shadow relative w-3/4 overflow-hidden">
            <div class="w-full border-b flex justify-between items-center p-4">
                <span class="text-xl font-medium text-gray-700">
                    Contribuições
                </span>
                <XIcon
                    class="w-5 h-5 text-gray-700 cursor-pointer"
                    @click="
                        reportContribuitionsModalVisible =
                            !reportContribuitionsModalVisible
                    "
                />
            </div>

            <div class="w-full p-4">
                <form
                    @submit.prevent="submit"
                    action="/contributions/report"
                    ref="formContribution"
                >
                    <div class="grid grid-flow-row grid-cols-12 gap-4 mb-10">
                        <div class="col-span-12 lg:col-span-6">
                            <label
                                for="contribution_benefactor_name"
                                class="mb-2 block text-md text-gray-500"
                            >
                                Nome Benfeitor
                            </label>
                            <input
                                type="text"
                                name="contribution_benefactor_name"
                                id="contribution_benefactor_name"
                                class="
                                    w-full
                                    p-4
                                    border
                                    focus:border-gray-700
                                    rounded
                                    border-gray-300
                                    shadow
                                    focus:ring-1 focus:ring-gray-700
                                "
                            />
                        </div>

                        <div class="col-span-12 lg:col-span-3">
                            <label
                                for="contribution_start_date"
                                class="mb-2 block text-md text-gray-500"
                            >
                                Data Inicial
                            </label>
                            <input
                                type="text"
                                name="contribution_start_date"
                                id="contribution_start_date"
                                class="
                                    w-full
                                    p-4
                                    border
                                    focus:border-gray-700
                                    rounded
                                    border-gray-300
                                    shadow
                                    focus:ring-1 focus:ring-gray-700
                                "
                                v-mask="'##/####'"
                            />
                        </div>

                        <div class="col-span-12 lg:col-span-3">
                            <label
                                for="contribution_finish_date"
                                class="mb-2 block text-md text-gray-500"
                            >
                                Data Final
                            </label>
                            <input
                                type="text"
                                name="contribution_finish_date"
                                id="contribution_finish_date"
                                class="
                                    w-full
                                    p-4
                                    border
                                    focus:border-gray-700
                                    rounded
                                    border-gray-300
                                    shadow
                                    focus:ring-1 focus:ring-gray-700
                                "
                                v-mask="'##/####'"
                            />
                        </div>
                    </div>

                    <div
                        class="col-span-12 lg:col-span-6 lg:flex lg:justify-end"
                    >
                        <div class="col-span-12 md:flex md:justify-end">
                            <button
                                type="submit"
                                class="
                                    flex
                                    justify-center
                                    items-center
                                    p-4
                                    text-gray-300
                                    hover:text-white
                                    bg-gray-700
                                    rounded
                                    shadow
                                    hover:shadow-lg hover:bg-gray-800
                                    w-full
                                    lg:w-auto
                                    transition
                                    duration-200
                                "
                            >
                                <CheckIcon class="w-5 h-5 mr-1" />
                                Gerar Relatório
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Finish Modal Contributions -->
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { DocumentDownloadIcon, XIcon, CheckIcon } from '@heroicons/vue/solid';

import Layout from '@/Shared/Layout.vue';

export default {
    layout: Layout,

    components: {
        Link,
        DocumentDownloadIcon,
        XIcon,
        CheckIcon,
    },

    data() {
        return {
            reportContribuitionsModalVisible: false,
        };
    },

    methods: {
        submit() {
            this.$refs.formContribution.submit();
            this.$refs.formContribution.reset();
            this.reportContribuitionsModalVisible = false;
        },
    },
};
</script>
