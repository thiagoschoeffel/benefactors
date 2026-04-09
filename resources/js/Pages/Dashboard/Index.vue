<template>
    <h1 class="mb-5 text-3xl font-bold text-gray-700">Dashboard</h1>

    <div class="grid grid-flow-row grid-cols-12 gap-4">
        <div
            class="bg-white p-6 rounded shadow-sm flex items-center justify-between col-span-12 lg:col-span-6"
        >
            <div>
                <span class="block text-xl text-gray-500"> Benfeitores </span>
                <span class="block text-4xl font-black text-gray-700">
                    {{ total_benefactors }}
                </span>
            </div>

            <UsersIcon class="w-14 h-14 text-gray-300" />
        </div>

        <div
            class="bg-white p-6 rounded shadow-sm flex items-center justify-between col-span-12 lg:col-span-6"
        >
            <div>
                <span class="block text-xl text-gray-500"> Contribuições </span>
                <span class="block text-4xl font-black text-gray-700">
                    {{
                        new Intl.NumberFormat('pt-BR', {
                            style: 'currency',
                            currency: 'BRL',
                        }).format(total_contributions)
                    }}
                </span>
            </div>

            <CurrencyDollarIcon class="w-14 h-14 text-gray-300" />
        </div>

        <div
            class="bg-white p-6 rounded shadow-sm flex items-center justify-between col-span-12"
        >
            <LineChart
                :chartData="data"
                :options="options"
                class="w-full h-[500px]"
            />
        </div>
    </div>
</template>

<script>
import { Chart, registerables } from 'chart.js';
import { LineChart } from 'vue-chart-3';
import { UsersIcon, CurrencyDollarIcon } from '@heroicons/vue/solid';

import resolveConfig from 'tailwindcss/resolveConfig';
import tailwindConfig from '../../../../tailwind.config';

import Layout from '@/Shared/Layout.vue';

const twFullConfig = resolveConfig(tailwindConfig);

Chart.register(...registerables);

export default {
    layout: Layout,

    components: {
        UsersIcon,
        CurrencyDollarIcon,
        LineChart,
    },

    props: {
        total_benefactors: Number,
        total_contributions: Number,
        chart_contributions: Object,
    },

    data() {
        return {
            data: {
                labels: Object.keys(this.chart_contributions),
                datasets: [
                    {
                        label: 'Contribuições',
                        data: Object.values(this.chart_contributions),
                        fill: true,
                        backgroundColor: twFullConfig.theme.colors.green[200],
                        borderColor: twFullConfig.theme.colors.green[400],
                        borderWidth: 5,
                        tension: 0.5,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            boxWidth: 30,
                            boxHeight: 0,
                            font: {
                                family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                                size: 14,
                                weight: '700',
                            },
                            color: twFullConfig.theme.colors.gray[700],
                        },
                    },
                    tooltip: {
                        backgroundColor: 'rgba(51, 65, 85, 0.75)',
                        displayColors: false,
                        padding: 12,
                        titleFont: {
                            family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                            size: 12,
                            weight: '400',
                        },
                        bodyFont: {
                            family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                            size: 14,
                            weight: '700',
                        },
                        caretSize: 8,
                        caretPadding: 12,
                        callbacks: {
                            label(context) {
                                let label = '';

                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL',
                                    }).format(context.parsed.y);
                                }

                                return label;
                            },
                        },
                    },
                },
                scales: {
                    xAxis: {
                        grid: {
                            display: false,
                            borderWidth: 0,
                        },
                        ticks: {
                            font: {
                                family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                                weight: '400',
                            },
                            color: twFullConfig.theme.colors.gray[500],
                        },
                    },
                    yAxis: {
                        grid: {
                            display: false,
                            borderWidth: 0,
                        },
                        ticks: {
                            font: {
                                family: 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
                                weight: '400',
                            },
                            color: twFullConfig.theme.colors.gray[500],
                            callback(value, index, ticks) {
                                return new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                }).format(value);
                            },
                        },
                    },
                },
                elements: {
                    point: {
                        radius: 6,
                        hoverRadius: 5,
                        borderWidth: 5,
                        hoverBorderWidth: 5,
                    },
                },
            },
        };
    },
};
</script>
