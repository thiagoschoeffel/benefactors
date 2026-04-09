<template>
    <div class="flex lg:items-center justify-between mb-5 flex-col lg:flex-row">
        <div class="mb-5 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-700">Contribuições</h1>
            <span
                class="font-light text-md text-gray-400 flex items-center ml-2 pl-3 border-l-2 border-gray-300"
            >
                <FolderOpenIcon class="w-5 h-5 mr-1" />
                Editando Contribuições
            </span>
        </div>

        <Link
            href="/contributions"
            class="flex justify-center items-center p-4 text-gray-500 hover:text-gray-700 transition-colors duration-200"
        >
            <ArrowSmLeftIcon class="w-5 h-5 mr-1" />
            Voltar
        </Link>
    </div>

    <form @submit.prevent="submit">
        <div class="grid grid-flow-row grid-cols-12 gap-4 mb-10">
            <div class="col-span-12 lg:col-span-3">
                <label for="id" class="mb-2 block text-md text-gray-500">
                    Código
                </label>
                <input
                    type="number"
                    name="id"
                    id="id"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700 disabled:cursor-not-allowed disabled:bg-gray-100"
                    v-model="form.id"
                    disabled
                />
            </div>

            <div class="col-span-12 lg:col-span-3">
                <label
                    for="benefactor_id"
                    class="mb-2 block text-md text-gray-500"
                >
                    Código Benfeitor
                </label>
                <div class="relative">
                    <input
                        type="number"
                        name="benefactor_id"
                        id="benefactor_id"
                        class="w-full p-4 rounded shadow"
                        :class="
                            errors.benefactor_id
                                ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                                : 'border-none focus:ring-2 focus:ring-gray-700'
                        "
                        v-model="form.benefactor_id"
                        @blur="handleGetBenefactor($event)"
                    />
                    <svg
                        v-if="loadGetBenefactor"
                        viewBox="0 0 24 24"
                        class="animate-spin w-5 h-5 mr-1 absolute top-[18px] right-8 text-gray-500"
                    >
                        <path
                            fill="currentColor"
                            d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"
                        />
                    </svg>
                </div>
                <span
                    v-if="errors.benefactor_id"
                    class="block mt-1 text-sm text-red-400"
                >
                    {{ errors.benefactor_id }}
                </span>
            </div>

            <div class="col-span-12 lg:col-span-6">
                <label
                    for="benefactor_name"
                    class="mb-2 block text-md text-gray-500"
                >
                    Nome Benfeitor
                </label>
                <div class="relative">
                    <input
                        type="text"
                        name="benefactor_name"
                        id="benefactor_name"
                        class="w-full p-4 border-none rounded border-gray-200 focus:ring-2 shadow focus:ring-gray-700"
                        v-model="benefactor_name"
                        @keyup="handleGetBenefactorByName"
                    />
                    <div
                        v-if="autoCompleteBenefactor"
                        class="w-full absolute top-[64px] border-none rounded border-gray-200 bg-white shadow overflow-hidden"
                    >
                        <button
                            v-for="benefactor in benefactors"
                            :key="benefactor.id"
                            type="button"
                            class="w-full block p-4 hover:bg-gray-100 text-left"
                            @click.prevent="handleSelectBenefactor(benefactor)"
                        >
                            {{ benefactor.name }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label
                    for="record_number"
                    class="mb-2 block text-md text-gray-500"
                >
                    Número Carnê
                </label>
                <input
                    type="number"
                    name="record_number"
                    id="record_number"
                    class="w-full p-4 rounded shadow"
                    :class="
                        errors.record_number
                            ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                            : 'border-none focus:ring-2 focus:ring-gray-700'
                    "
                    v-model="form.record_number"
                />
                <span
                    v-if="errors.record_number"
                    class="block mt-1 text-sm text-red-400"
                >
                    {{ errors.record_number }}
                </span>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label
                    for="year_month_reference"
                    class="mb-2 block text-md text-gray-500"
                >
                    Mês/Ano Referência
                </label>
                <input
                    type="text"
                    name="year_month_reference"
                    id="year_month_reference"
                    class="w-full p-4 rounded shadow"
                    :class="
                        errors.year_month_reference
                            ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                            : 'border-none focus:ring-2 focus:ring-gray-700'
                    "
                    v-model="form.year_month_reference"
                    v-mask="'##/####'"
                />
                <span
                    v-if="errors.year_month_reference"
                    class="block mt-1 text-sm text-red-400"
                >
                    {{ errors.year_month_reference }}
                </span>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label for="amount" class="mb-2 block text-md text-gray-500">
                    Valor
                </label>
                <input
                    type="text"
                    name="amount"
                    id="amount"
                    class="w-full p-4 rounded shadow"
                    :class="
                        errors.amount
                            ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                            : 'border-none focus:ring-2 focus:ring-gray-700'
                    "
                    v-model="form.amount"
                    v-money="amount"
                />
                <span
                    v-if="errors.amount"
                    class="block mt-1 text-sm text-red-400"
                >
                    {{ errors.amount }}
                </span>
            </div>

            <div class="col-span-12">
                <label for="note" class="mb-2 block text-md text-gray-500">
                    Observações
                </label>
                <textarea
                    name="note"
                    id="note"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700 resize-none"
                    v-model="form.note"
                ></textarea>
            </div>
        </div>

        <div class="grid lg:grid-flow-row lg:grid-cols-12 gap-4">
            <div
                class="col-span-12 lg:col-span-6 lg:flex lg:justify-start order-2 lg:order-1"
            >
                <button
                    type="button"
                    class="flex justify-center items-center p-4 text-red-500 hover:text-red-700 transition duration-200"
                    @click="handleDeleteContribution"
                >
                    <svg
                        v-if="deleteProcessing"
                        viewBox="0 0 24 24"
                        class="animate-spin w-5 h-5 mr-1"
                    >
                        <path
                            fill="currentColor"
                            d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"
                        />
                    </svg>

                    <TrashIcon v-else class="w-5 h-5 mr-1" />

                    Deletar Contribuição
                </button>
            </div>

            <div
                class="col-span-12 lg:col-span-6 lg:flex lg:justify-end order-1 lg:order-2"
            >
                <button
                    type="submit"
                    class="flex justify-center items-center p-4 text-gray-300 hover:text-white bg-gray-700 rounded shadow hover:shadow-lg hover:bg-gray-800 w-full lg:w-auto transition duration-200 disabled:cursor-not-allowed"
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

                    <CheckIcon v-else class="w-5 h-5 mr-1" />

                    Atualizar Contribuição
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';
import {
    FolderOpenIcon,
    CheckIcon,
    ArrowSmLeftIcon,
    TrashIcon,
} from '@heroicons/vue/solid';

import axios from 'axios';
import _ from 'lodash';
import Layout from '@/Shared/Layout.vue';

export default {
    layout: Layout,

    components: {
        Link,
        FolderOpenIcon,
        CheckIcon,
        ArrowSmLeftIcon,
        TrashIcon,
    },

    props: {
        contribution: Object,
        errors: Object,
    },

    data() {
        return {
            form: useForm({
                id: this.contribution.id,
                benefactor_id: this.contribution.benefactor_id,
                record_number: this.contribution.record_number,
                year_month_reference: this.contribution.year_month_reference
                    ? new Intl.DateTimeFormat('pt-BR', {
                          month: '2-digit',
                          year: 'numeric',
                      }).format(
                          new Date(
                              this.contribution.year_month_reference.split('-')
                          )
                      )
                    : '',
                amount: this.contribution.amount
                    ? new Intl.NumberFormat('pt-BR', {
                          style: 'currency',
                          currency: 'BRL',
                      }).format(this.contribution.amount)
                    : '',
                note: this.contribution.note,
            }),
            benefactor_name: this.contribution.benefactor.name,
            amount: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
            },
            loadGetBenefactor: false,
            autoCompleteBenefactor: false,
            benefactors: Array,
            deleteProcessing: false,
        };
    },

    methods: {
        submit() {
            this.form.put(`/contributions/${this.contribution.id}/edit`, {
                preserveState: (page) => Object.keys(page.props.errors).length,
            });
        },

        handleDeleteContribution() {
            this.$inertia.delete(
                `/contributions/${this.contribution.id}/destroy`,
                {
                    onStart: () => {
                        this.deleteProcessing = true;
                    },
                    onFinish: () => {
                        this.deleteProcessing = false;
                    },
                }
            );
        },

        async handleGetBenefactor(event) {
            const id = event.target.value;

            if (!id || id === '0') {
                this.form.benefactor_id = '';
                this.benefactor_name = '';

                return;
            }

            this.loadGetBenefactor = true;

            try {
                const result = await axios.get('/benefactors/find', {
                    params: {
                        id,
                    },
                });

                this.benefactor_name = result.data[0].name;
            } catch (error) {
                this.form.benefactor_id = '';
                this.benefactor_name = '';
            }

            this.loadGetBenefactor = false;
        },

        handleGetBenefactorByName: _.debounce(async function () {
            if (this.benefactor_name === '') {
                this.autoCompleteBenefactor = false;
                this.benefactors = [];

                return;
            }

            try {
                const result = await axios.get('/benefactors/find', {
                    params: {
                        name: this.benefactor_name,
                    },
                });

                this.benefactors = result.data;

                this.autoCompleteBenefactor = true;
            } catch (error) {
                this.autoCompleteBenefactor = false;
                this.benefactors = [];
            }
        }, 500),

        handleSelectBenefactor(benefactor) {
            this.form.benefactor_id = benefactor.id;
            this.benefactor_name = benefactor.name;
            this.autoCompleteBenefactor = false;
            this.benefactors = [];
        },
    },
};
</script>
