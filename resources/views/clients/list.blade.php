<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clienti') }}
        </h2>
    </x-slot>

    <div class="main-content mt-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-6 " style="vertical-align: middle;">
                                    <h4> Clienti</h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <form method="GET" action="{{ route('client.search') }}" class="d-flex"
                                        role="search">
                                        <input class="form-control me-2" type="search" name="search"
                                            placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit"><i
                                                class="bi bi-search"></i></button>
                                    </form>

                                    <div class="col-md-4 d-flex justify-content-end">
                                        <a class="btn btn-sm btn-success mx-1" href="{{ route('client.create') }}"><i
                                                class="bi bi-plus-circle mt-2"></i></a>
                                        <a class="btn btn-sm btn-dark mx-1" href="{{ route('client.trashed') }}"><i
                                                class="bi bi-trash3 mt-2"></i></a>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-xl">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Cognome</th>
                                                    <th scope="col">Cellulare</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Città</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Note</th>
                                                    <th scope="col">Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clients as $client)
                                                    <tr>
                                                        <td>{{ $client->nome }}</td>
                                                        <td>{{ $client->cognome }}</td>
                                                        <td>{{ $client->cellulare }}</td>
                                                        <td>{{ $client->email }}</td>
                                                        <td>{{ $client->citta }}</td>
                                                        <td>{{ $client->tipo }}</td>
                                                        <td>{{ $client->status }}</td>
                                                        <td> <a class="btn btn-sm btn-info" href=""
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#noteModal{{ $client->cid }}"
                                                                data-id="{{ $client->cid }}"><i
                                                                    class="bi bi-info-circle"></i></a></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a class="btn btn-sm btn-success mx-2"
                                                                    href="{{ route('client.show', $client->cid) }}"><i
                                                                        class="bi bi-eye"></i></a>
                                                                <a class="btn btn-sm btn-primary mx-2"
                                                                    href="{{ route('client.edit', $client->cid) }}"><i
                                                                        class="bi bi-pencil-square"></i></a>

                                                                <form
                                                                    action="{{ route('client.destroy', $client->cid) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('GET')
                                                                    <button class="btn btn-sm btn-danger"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $clients->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</x-app-layout>
