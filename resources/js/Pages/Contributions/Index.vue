<template>
    <div class="flex lg:items-center justify-between mb-5 flex-col lg:flex-row">
        <div class="mb-5 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-700">Contribuições</h1>
            <span
                class="font-light text-md text-gray-400 flex items-center ml-2 pl-3 border-l-2 border-gray-300"
            >
                <FolderOpenIcon class="w-5 h-5 mr-1" />
                Listando Contribuições
            </span>
        </div>

        <Link
            href="/contributions/create"
            class="flex justify-center items-center p-4 text-gray-300 hover:text-white bg-gray-700 rounded shadow hover:shadow-lg hover:bg-gray-800 w-full lg:w-auto transition duration-200"
        >
            <PlusIcon class="w-5 h-5 mr-1" />
            Nova Contribuição
        </Link>
    </div>

    <form action="" class="mb-5">
        <div class="grid grid-flow-row grid-cols-12 gap-4">
            <input
                type="text"
                name="benefactor_name"
                id="benefactor_name"
                placeholder="Nome Benfeitor"
                class="col-span-12 lg:col-span-6 p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                v-model="find.benefactor_name"
                @keyup="search"
            />

            <input
                type="number"
                name="record_number"
                id="record_number"
                placeholder="Número Carnê"
                class="col-span-12 lg:col-span-3 p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                v-model="find.record_number"
                @keyup="search"
            />

            <input
                type="text"
                name="year_month_reference"
                id="year_month_reference"
                placeholder="Mês/Ano Referência"
                class="col-span-12 lg:col-span-3 p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                v-mask="'##/####'"
                v-model="find.year_month_reference"
                @keyup="search"
            />
        </div>
    </form>

    <div class="bg-white rounded shadow overflow-x-auto mb-5">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-left font-bold text-gray-700">
                    <th class="p-4">Código</th>
                    <th class="p-4">Nome Benfeitor</th>
                    <th class="p-4">Número Carnê</th>
                    <th class="p-4">Mês/Ano Referência</th>
                    <th class="p-4">Valor</th>
                    <th class="p-4">Data Lançamento</th>
                    <th class="p-4"></th>
                </tr>
            </thead>

            <tbody v-if="contributions.data.length > 0">
                <tr
                    v-for="contribution in contributions.data"
                    :key="contribution.id"
                    class="hover:bg-gray-100"
                >
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{ contribution.id }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{ contribution.benefactor.name }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{ contribution.record_number }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{
                                contribution.year_month_reference
                                    ? new Intl.DateTimeFormat('pt-BR', {
                                          month: '2-digit',
                                          year: 'numeric',
                                      }).format(
                                          new Date(
                                              contribution.year_month_reference.split(
                                                  '-'
                                              )
                                          )
                                      )
                                    : ''
                            }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{
                                new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                }).format(contribution.amount)
                            }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{
                                contribution.created_at
                                    ? new Intl.DateTimeFormat('pt-BR', {
                                          dateStyle: 'short',
                                          timeStyle: 'medium',
                                      }).format(
                                          new Date(contribution.created_at)
                                      )
                                    : ''
                            }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200 w-px">
                        <Link
                            :href="`/contributions/${contribution.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            <ArrowSmRightIcon class="w-5 h-5 block" />
                        </Link>
                    </td>
                </tr>
            </tbody>

            <tbody v-else>
                <tr class="hover:bg-gray-100">
                    <td colspan="7" class="border-t border-gray-200 w-px">
                        <span class="flex items-center p-4 text-gray-500">
                            Nenhuma contribuição encontrada.
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap">
        <Pagination :links="contributions.links" />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import {
    FolderOpenIcon,
    ArrowSmRightIcon,
    PlusIcon,
} from '@heroicons/vue/solid';
import _ from 'lodash';
import Layout from '@/Shared/Layout.vue';
import Pagination from '@/Shared/Components/Pagination.vue';

export default {
    layout: Layout,

    components: {
        Link,
        ArrowSmRightIcon,
        PlusIcon,
        FolderOpenIcon,
        Pagination,
    },

    props: {
        contributions: Object,
        filters: Object,
        paginator: Object,
        errors: Object,
    },

    data() {
        return {
            find: {
                benefactor_name: this.filters.benefactor_name,
                record_number: this.filters.record_number,
                year_month_reference: this.filters.year_month_reference,
            },
        };
    },

    methods: {
        search: _.debounce(function () {
            this.$inertia.get(
                '/contributions',
                {
                    benefactor_name: this.find.benefactor_name,
                    record_number: this.find.record_number,
                    year_month_reference: this.find.year_month_reference,
                },
                {
                    replace: true,
                    preserveState: true,
                    only: ['contributions'],
                }
            );
        }, 1000),
    },
};
</script>
