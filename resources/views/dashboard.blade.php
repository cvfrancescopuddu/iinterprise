@vite(['resources/js/charts.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row flex flex-wrap mx-4">
                <div class="col-6 w-1/2">
                    <div
                        class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-200 p-4 md:p-6">
                        <div class="flex justify-between mb-3">
                            <div class="flex items-center">
                                <div class="flex justify-center items-center">
                                    <h5 class="text-xl font-bold">I Tuoi Progressi</h5>

                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="grid grid-cols-3 gap-3 mb-2">
                                <a href="{{ route('client.urgent') }}" target="_self" rel="noopener noreferrer">
                                    <dl
                                        class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                        <dt
                                            class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                            {{ $urgentTasks }}</dt>
                                        <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Urgenti
                                        </dd>
                                    </dl>
                                </a>
                                <a href="{{ route('client.important') }}" target="_self" rel="noopener noreferrer">
                                    <dl
                                        class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                        <dt
                                            class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                                            {{ $importantTasks }}</dt>
                                        <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Importanti</dd>
                                    </dl>
                                </a>
                                <a href="{{ route('client.done') }}" target="_self" rel="noopener noreferrer">
                                    <dl
                                        class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                                        <dt
                                            class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                            {{ $doneTasks }}</dt>
                                        <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Fatte</dd>
                                    </dl>
                                </a>
                            </div>
                        </div>
                        <!-- Radial Chart -->
                        <div class="py-6" id="radial-chart"></div>
                    </div>
                </div>
                <div class="col-6 w-1/2">
                    <div style="height: 80%;">
                        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                            <div class="flex justify-between items-start w-full">
                                <div class="flex-col items-center">
                                    <div class="flex items-center mb-1">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                            Clienti Registrati: {{ $count }}</h5>
                                        <svg data-popover-target="chart-info" data-popover-placement="bottom"
                                            class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                        </svg>
                                        <div data-popover id="chart-info" role="tooltip"
                                            class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                            <div class="p-3 space-y-2">
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Clienti B2B
                                                </h3>
                                                <p>Portafoglio clienti appartenenti al mercato d'impresa
                                                </p>
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Clienti B2C
                                                </h3>
                                                <p>Portafoglio clienti appartenenti al mercato del consumo</p>
                                            </div>
                                            <div data-popper-arrow></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Line Chart -->
                            <div class="py-6" id="pie-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
