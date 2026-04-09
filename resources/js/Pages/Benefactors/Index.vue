<template>
    <div class="flex lg:items-center justify-between mb-5 flex-col lg:flex-row">
        <div class="mb-5 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-700">Benfeitores</h1>
            <span
                class="font-light text-md text-gray-400 flex items-center ml-2 pl-3 border-l-2 border-gray-300"
            >
                <FolderOpenIcon class="w-5 h-5 mr-1" />
                Listando Benfeitores
            </span>
        </div>

        <Link
            href="/benefactors/create"
            class="flex justify-center items-center p-4 text-gray-300 hover:text-white bg-gray-700 rounded shadow hover:shadow-lg hover:bg-gray-800 w-full lg:w-auto transition duration-200"
        >
            <PlusIcon class="w-5 h-5 mr-1" />
            Novo Benfeitor
        </Link>
    </div>

    <form action="" class="mb-5">
        <div class="grid grid-flow-row grid-cols-12 gap-4">
            <input
                type="number"
                name="id"
                id="id"
                placeholder="Código"
                class="col-span-12 lg:col-span-3 p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                v-model="find.id"
                @keyup="search"
            />

            <input
                type="text"
                name="name"
                id="name"
                placeholder="Nome"
                class="col-span-12 lg:col-span-9 p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                v-model="find.name"
                @keyup="search"
            />
        </div>
    </form>

    <div class="bg-white rounded shadow overflow-x-auto mb-5">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-left font-bold text-gray-700">
                    <th class="p-4">Código</th>
                    <th class="p-4">Nome</th>
                    <th class="p-4"></th>
                </tr>
            </thead>

            <tbody v-if="benefactors.data.length > 0">
                <tr
                    v-for="benefactor in benefactors.data"
                    :key="benefactor.id"
                    class="hover:bg-gray-100"
                >
                    <td class="border-t border-gray-200 w-[150px]">
                        <Link
                            :href="`/benefactors/${benefactor.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{ benefactor.id }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200">
                        <Link
                            :href="`/benefactors/${benefactor.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            {{ benefactor.name }}
                        </Link>
                    </td>
                    <td class="border-t border-gray-200 w-px">
                        <Link
                            :href="`/benefactors/${benefactor.id}/edit`"
                            class="flex items-center p-4 text-gray-500"
                        >
                            <ArrowSmRightIcon class="w-5 h-5 block" />
                        </Link>
                    </td>
                </tr>
            </tbody>

            <tbody v-else>
                <tr class="hover:bg-gray-100">
                    <td colspan="3" class="border-t border-gray-200 w-px">
                        <span class="flex items-center p-4 text-gray-500">
                            Nenhum benfeitor encontrado.
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex flex-wrap">
        <Pagination :links="benefactors.links" />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import {
    FolderOpenIcon,
    PlusIcon,
    ArrowSmRightIcon,
} from '@heroicons/vue/solid';
import _ from 'lodash';
import Pagination from '@/Shared/Components/Pagination.vue';

import Layout from '@/Shared/Layout.vue';

export default {
    layout: Layout,

    components: {
        Link,
        Pagination,
        ArrowSmRightIcon,
        PlusIcon,
        FolderOpenIcon,
    },

    props: {
        benefactors: Object,
        filters: Object,
        paginator: Object,
        errors: Object,
    },

    data() {
        return {
            find: {
                id: this.filters.id,
                name: this.filters.name,
            },
        };
    },

    methods: {
        search: _.debounce(function () {
            this.$inertia.get(
                '/benefactors',
                {
                    id: this.find.id,
                    name: this.find.name,
                },
                {
                    replace: true,
                    preserveState: true,
                    only: ['benefactors'],
                }
            );
        }, 1000),
    },
};
</script>
