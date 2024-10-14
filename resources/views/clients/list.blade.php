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
                                <div class="col-md-6" style="vertical-align: middle;">
                                    <h4> Clienti</h4>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <form method="GET" action="{{ route('client.search') }}" class="d-flex"
                                        role="search">
                                        <input class="form-control me-2" name="search" placeholder="Search"
                                            aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit"><i
                                                class="bi bi-search"></i></button>
                                    </form>

                                    <div class="col-md-4 d-flex justify-content-end">
                                        <a class="btn btn-sm btn-outline-success mx-1 d-flex align-items-center"
                                            href="{{ route('client.create') }}">Nuovo</a>
                                        <a class="btn btn-sm btn-outline-dark mx-1 d-flex align-items-center"
                                            href="{{ route('client.trashed') }}">Cestino</a>
                                    </div>
                                </div>

                                <div class="card-body mt-2">
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
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $client->status }}
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    @foreach (['chiamato', 'trattativa', 'chiuso', 'ospite'] as $status)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('client.updateStatus', [$client->cid, $status]) }}">
                                                                                {{ ucfirst($status) }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>

                                                            <button tabindex="0" type="button" class="bg-cyan-400 hover:bg-cyan-500 text-white font-bold py-1 px-2 rounded"
                                                                data-bs-toggle="popover" data-bs-placement="right"
                                                                data-bs-custom-class="custom-popover"
                                                                data-bs-trigger="focus"
                                                                data-bs-title="{{ $client->nome }} {{ $client->cognome }}"
                                                                data-bs-content="{{ $client->note }}"><i
                                                                    class="bi bi-info-circle"></i>

                                                            </button>
                                                        </td>
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
