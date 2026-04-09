<template>
    <div class="flex lg:items-center justify-between mb-5 flex-col lg:flex-row">
        <div class="mb-5 lg:mb-0">
            <h1 class="text-3xl font-bold text-gray-700">Benfeitores</h1>
            <span
                class="font-light text-md text-gray-400 flex items-center ml-2 pl-3 border-l-2 border-gray-300"
            >
                <FolderOpenIcon class="w-5 h-5 mr-1" />
                Cadastrando Benfeitores
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

        <div class="col-span-12 lg:col-span-6 lg:flex lg:justify-end">
            <div class="col-span-12 md:flex md:justify-end">
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

                    Cadastrar Benfeitor
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';
import {
    FolderOpenIcon,
    ArrowSmLeftIcon,
    CheckIcon,
} from '@heroicons/vue/solid';

import axios from 'axios';
import Layout from '@/Shared/Layout.vue';

export default {
    layout: Layout,

    components: {
        Link,
        ArrowSmLeftIcon,
        CheckIcon,
        FolderOpenIcon,
    },

    props: {
        errors: Object,
    },

    data() {
        return {
            form: useForm({
                name: '',
                birth_date: '',
                primary_phone: '',
                secondary_phone: '',
                email: '',
                civil_state: '',
                note: '',
                spouse_name: '',
                spouse_birth_date: '',
                wedding_date: '',
                address_zip_code: '',
                address_street: '',
                address_number: '',
                address_complement: '',
                address_neighborhood: '',
                address_city: '',
                address_state: '',
            }),
            showSpouseSection: false,
            loadGetAddress: false,
        };
    },

    methods: {
        submit() {
            this.form.post('/benefactors/store', {
                preserveState: (page) => Object.keys(page.props.errors).length,
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
};
</script>
