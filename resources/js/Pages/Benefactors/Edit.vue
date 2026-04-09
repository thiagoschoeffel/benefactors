<template>
    <div class="flex lg:items-center justify-between mb-5 flex-col lg:flex-row">
        <div class="mb-5 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-700">Benfeitores</h1>
            <span
                class="font-light text-md text-gray-400 flex items-center ml-2 pl-3 border-l-2 border-gray-300"
            >
                <FolderOpenIcon class="w-5 h-5 mr-1" />
                Editando Benfeitores
            </span>
        </div>

        <Link
            href="/benefactors"
            class="flex justify-center items-center p-4 text-gray-500 hover:text-gray-700 transition-colors duration-200"
        >
            <ArrowSmLeftIcon class="w-5 h-5 mr-1" />
            Voltar
        </Link>
    </div>

    <form @submit.prevent="submit" class="mb-10">
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

            <div class="col-span-12 lg:col-span-9">
                <label for="name" class="mb-2 block text-md text-gray-500">
                    Nome
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full p-4 rounded shadow"
                    :class="
                        errors.name
                            ? 'border-red-400 focus:ring-2 focus:border-red-400 focus:ring-red-400'
                            : 'border-none focus:ring-2 focus:ring-gray-700'
                    "
                    v-model="form.name"
                />
                <span
                    v-if="errors.name"
                    class="block mt-1 text-sm text-red-400"
                >
                    {{ errors.name }}
                </span>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label
                    for="birth_date"
                    class="mb-2 block text-md text-gray-500"
                >
                    Data Nascimento
                </label>
                <input
                    type="text"
                    name="birth_date"
                    id="birth_date"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.birth_date"
                    v-mask="'##/##/####'"
                />
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label
                    for="primary_phone"
                    class="mb-2 block text-md text-gray-500"
                >
                    Telefone (1)
                </label>
                <input
                    type="text"
                    name="primary_phone"
                    id="primary_phone"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.primary_phone"
                    v-mask="['(##) ####-####', '(##) #####-####']"
                />
            </div>

            <div class="col-span-12 lg:col-span-4">
                <label
                    for="secondary_phone"
                    class="mb-2 block text-md text-gray-500"
                >
                    Telefone (2)
                </label>
                <input
                    type="text"
                    name="secondary_phone"
                    id="secondary_phone"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.secondary_phone"
                    v-mask="['(##) ####-####', '(##) #####-####']"
                />
            </div>

            <div class="col-span-12 lg:col-span-7">
                <label for="email" class="mb-2 block text-md text-gray-500">
                    E-Mail
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.email"
                />
            </div>

            <div class="col-span-12 lg:col-span-5">
                <label
                    for="civil_state"
                    class="mb-2 block text-md text-gray-500"
                >
                    Estado Civil
                </label>
                <select
                    name="civil_state"
                    id="civil_state"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.civil_state"
                    @change="handleShowSpouseSection($event)"
                >
                    <option value="" selected>Selecione...</option>
                    <option value="Solteiro">Solteiro</option>
                    <option value="Casado">Casado</option>
                </select>
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

            <div
                class="col-span-12 py-4 border-b border-gray-300"
                v-show="showSpouseSection"
            >
                <span class="font-light text-xl text-gray-500">
                    Dados do Cônjuge
                </span>
            </div>

            <div class="col-span-12 lg:col-span-6" v-show="showSpouseSection">
                <label
                    for="spouse_name"
                    class="mb-2 block text-md text-gray-500"
                >
                    Nome
                </label>
                <input
                    type="text"
                    name="spouse_name"
                    id="spouse_name"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.spouse_name"
                />
            </div>

            <div class="col-span-12 lg:col-span-3" v-show="showSpouseSection">
                <label
                    for="spouse_birth_date"
                    class="mb-2 block text-md text-gray-500"
                >
                    Data Nascimento
                </label>
                <input
                    type="text"
                    name="spouse_birth_date"
                    id="spouse_birth_date"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.spouse_birth_date"
                    v-mask="'##/##/####'"
                />
            </div>

            <div class="col-span-12 lg:col-span-3" v-show="showSpouseSection">
                <label
                    for="wedding_date"
                    class="mb-2 block text-md text-gray-500"
                >
                    Data Casamento
                </label>
                <input
                    type="text"
                    name="wedding_date"
                    id="wedding_date"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.wedding_date"
                    v-mask="'##/##/####'"
                />
            </div>

            <div class="col-span-12 py-4 border-b border-gray-300">
                <span class="font-light text-xl text-gray-500">
                    Dados de Endereço
                </span>
            </div>

            <div class="col-span-12 lg:col-span-3">
                <label
                    for="address_zip_code"
                    class="mb-2 block text-md text-gray-500"
                >
                    CEP
                </label>
                <div class="relative">
                    <input
                        type="text"
                        name="address_zip_code"
                        id="address_zip_code"
                        class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                        v-model="form.address_zip_code"
                        v-mask="'#####-###'"
                        @blur="handleGetAddress($event)"
                    />

                    <svg
                        v-if="loadGetAddress"
                        viewBox="0 0 24 24"
                        class="animate-spin w-5 h-5 mr-1 absolute top-[18px] right-4 text-gray-500"
                    >
                        <path
                            fill="currentColor"
                            d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"
                        />
                    </svg>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-7">
                <label
                    for="address_street"
                    class="mb-2 block text-md text-gray-500"
                >
                    Logradouro
                </label>
                <input
                    type="text"
                    name="address_street"
                    id="address_street"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.address_street"
                />
            </div>

            <div class="col-span-12 lg:col-span-2">
                <label
                    for="address_number"
                    class="mb-2 block text-md text-gray-500"
                >
                    Número
                </label>
                <input
                    type="number"
                    name="address_number"
                    id="address_number"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.address_number"
                />
            </div>

            <div class="col-span-12 lg:col-span-5">
                <label
                    for="address_complement"
                    class="mb-2 block text-md text-gray-500"
                >
                    Complemento
                </label>
                <input
                    type="text"
                    name="address_complement"
                    id="address_complement"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.address_complement"
                />
            </div>

            <div class="col-span-12 lg:col-span-7">
                <label
                    for="address_neighborhood"
                    class="mb-2 block text-md text-gray-500"
                >
                    Bairro
                </label>
                <input
                    type="text"
                    name="address_neighborhood"
                    id="address_neighborhood"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700"
                    v-model="form.address_neighborhood"
                />
            </div>

            <div class="col-span-12 lg:col-span-10">
                <label
                    for="address_city"
                    class="mb-2 block text-md text-gray-500"
                >
                    Cidade
                </label>
                <input
                    type="text"
                    name="address_city"
                    id="address_city"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700 disabled:cursor-not-allowed disabled:bg-gray-100"
                    v-model="form.address_city"
                    disabled
                />
            </div>

            <div class="col-span-12 lg:col-span-2">
                <label
                    for="address_state"
                    class="mb-2 block text-md text-gray-500"
                >
                    UF
                </label>
                <input
                    type="text"
                    name="address_state"
                    id="address_state"
                    class="w-full p-4 border-none rounded border-gray-200 shadow focus:ring-2 focus:ring-gray-700 disabled:cursor-not-allowed disabled:bg-gray-100"
                    v-model="form.address_state"
                    v-mask="'SS'"
                    disabled
                />
            </div>
        </div>

        <div class="grid lg:grid-flow-row lg:grid-cols-12 gap-4">
            <div
                class="col-span-12 lg:col-span-6 lg:flex lg:justify-start order-2 lg:order-1"
            >
                <button
                    type="button"
                    class="flex justify-center items-center p-4 text-red-500 hover:text-red-700 transition duration-200"
                    @click="handleDeleteBenefactor"
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

                    Deletar Benfeitor
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

                    Atualizar Benfeitor
                </button>
            </div>
        </div>
    </form>

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

        <div class="text-left lg:text-right">
            <span class="block text-gray-500 text-sm">
                Este benfeitor já contribuiu com
            </span>
            <span class="block text-gray-700 font-black text-3xl">
                {{
                    new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL',
                    }).format(this.contributions_amount)
                }}
            </span>
        </div>
    </div>

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
import { Link, useForm } from '@inertiajs/vue3';
import {
    FolderOpenIcon,
    ArrowSmRightIcon,
    ArrowSmLeftIcon,
    CheckIcon,
    TrashIcon,
} from '@heroicons/vue/solid';

import axios from 'axios';
import Layout from '@/Shared/Layout.vue';
import Pagination from '@/Shared/Components/Pagination.vue';

export default {
    layout: Layout,

    components: {
        Link,
        ArrowSmLeftIcon,
        CheckIcon,
        FolderOpenIcon,
        TrashIcon,
        ArrowSmRightIcon,
        Pagination,
    },

    props: {
        benefactor: Object,
        contributions: Object,
        contributions_amount: Number,
        errors: Object,
    },

    data() {
        return {
            form: useForm({
                id: this.benefactor.id,
                name: this.benefactor.name,
                birth_date: this.benefactor.birth_date
                    ? new Intl.DateTimeFormat('pt-BR').format(
                          new Date(this.benefactor.birth_date.split('-'))
                      )
                    : '',
                primary_phone: this.benefactor.primary_phone,
                secondary_phone: this.benefactor.secondary_phone,
                email: this.benefactor.email,
                civil_state: this.benefactor.civil_state
                    ? this.benefactor.civil_state
                    : '',
                note: this.benefactor.note,
                spouse_name: this.benefactor.spouse_name,
                spouse_birth_date: this.benefactor.spouse_birth_date
                    ? new Intl.DateTimeFormat('pt-BR').format(
                          new Date(this.benefactor.spouse_birth_date.split('-'))
                      )
                    : '',
                wedding_date: this.benefactor.wedding_date
                    ? new Intl.DateTimeFormat('pt-BR').format(
                          new Date(this.benefactor.wedding_date.split('-'))
                      )
                    : '',
                address_zip_code: this.benefactor.address_zip_code,
                address_street: this.benefactor.address_street,
                address_number: this.benefactor.address_number,
                address_complement: this.benefactor.address_complement,
                address_neighborhood: this.benefactor.address_neighborhood,
                address_city: this.benefactor.address_city,
                address_state: this.benefactor.address_state,
            }),
            showSpouseSection: false,
            loadGetAddress: false,
            deleteProcessing: false,
        };
    },

    methods: {
        submit() {
            this.form.put(`/benefactors/${this.benefactor.id}/edit`, {
                preserveState: (page) => Object.keys(page.props.errors).length,
            });
        },

        handleDeleteBenefactor() {
            this.$inertia.delete(`/benefactors/${this.benefactor.id}/destroy`, {
                onStart: () => {
                    this.deleteProcessing = true;
                },
                onFinish: () => {
                    this.deleteProcessing = false;
                },
            });
        },

        handleShowSpouseSection(event) {
            if (event.target.value === 'Casado') {
                this.showSpouseSection = true;
            } else {
                this.showSpouseSection = false;
            }
        },

        async handleGetAddress(event) {
            console.log(this.form.address_city);

            if (
                this.form.address_city &&
                this.form.address_state &&
                this.form.address_zip_code
            ) {
                const confirm = window.confirm(
                    'Deseja recarregar os dados de endereço do benfeitor?'
                );

                if (!confirm) {
                    return;
                }
            }

            const zipCodeMask = event.target.value;

            if (zipCodeMask.length === 0) {
                this.form.address_street = null;
                this.form.address_number = null;
                this.form.address_complement = null;
                this.form.address_neighborhood = null;
                this.form.address_city = null;
                this.form.address_state = null;
            }

            if (zipCodeMask.length === 9 && zipCodeMask.indexOf('-')) {
                const zipCodeArray = zipCodeMask.split('-');
                const zipCode = zipCodeArray[0] + zipCodeArray[1];

                this.loadGetAddress = true;

                const result = await axios.get(
                    `https://viacep.com.br/ws/${zipCode}/json`
                );

                this.loadGetAddress = false;

                if (result.status === 200 && result.data) {
                    this.form.address_street = result.data.logradouro;
                    this.form.address_number = null;
                    this.form.address_complement = result.data.complemento;
                    this.form.address_neighborhood = result.data.bairro;
                    this.form.address_city = result.data.localidade;
                    this.form.address_state = result.data.uf;
                } else {
                    this.form.address_street = null;
                    this.form.address_number = null;
                    this.form.address_complement = null;
                    this.form.address_neighborhood = null;
                    this.form.address_city = null;
                    this.form.address_state = null;
                }
            }
        },
    },

    mounted() {
        if (this.benefactor.civil_state === 'Casado') {
            this.showSpouseSection = true;
        }
    },
};
</script>
