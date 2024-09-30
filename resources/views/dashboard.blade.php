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
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50">
                        <div class="p-6 text-gray-900">
                            Clienti Registrati: {{ $count }}
                        </div>
                    </div>
                    <a href="#">
                        <div class="w-1/2 mt-5">
                            <div class="bg-red-400 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <ul>
                                        <li>
                                            <h2>Hai {{ $urgentTasks }} task urgenti</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="w-1/2 mt-2">
                            <div class="bg-yellow-300 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <ul>
                                        <li>
                                            <h2>Hai {{ $importantTasks }} task da importanti</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="w-1/2 mt-2">
                            <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <ul>
                                        <li>
                                            <h2>Hai {{ $normalTasks }} task normali</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 w-1/2">
                    <div>
                        ciaociao
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
