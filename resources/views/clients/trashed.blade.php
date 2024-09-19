@extends('layouts.app')

@section('content')
    <div class="main-content mt-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <div class="card mt-5">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Cestino</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
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
                                <td>{{ $client->note }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-success  mx-2" href="{{route('client.restore', $client->cid)}}">Restore</a>

                                        <form action="{{ route('client.force_delete', $client->cid) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
