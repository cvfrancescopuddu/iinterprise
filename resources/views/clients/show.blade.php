<x-app-layout>
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
                        <h4> {{ $client->nome }} {{ $client->cognome }}</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">

                    <tbody>
                        <tr>
                            <td>Nome</td>
                            <td>{{ $client->nome }}</td>
                        </tr>
                        <tr>
                            <td>Cognome</td>
                            <td>{{ $client->cognome }}</td>
                        </tr>
                        <tr>
                            <td>Cellulare</td>
                            <td>{{ $client->cellulare }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <td>Città</td>
                            <td>{{ $client->citta }}</td>
                        </tr>
                        <tr>
                            <td>Tipo</td>
                            <td>{{ $client->tipo }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $client->status }}</td>
                        </tr>

                        <tr>
                            <td>Note</td>
                            <td>
                                {{ $client->note }}
                            </td>
                        </tr>
                        <tr>
                            <td>Creato il:</td>
                            <td>{{ date('d-m-Y', strtotime($client->created_at)) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
