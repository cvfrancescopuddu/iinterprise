<x-app-layout>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="main-content mt-5">
                        <div class="card mt-5">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4> Modifica Cliente</h4>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">

                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <form action="{{ route('client.update', $client->cid) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('GET')
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="nome"
                                            value="{{ $client->nome }}">
                                        <label for="floatingInput">Nome</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="cognome"
                                            value="{{ $client->cognome }}">
                                        <label for="floatingInput">Cognome</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="cellulare"
                                            value="{{ $client->cellulare }}">
                                        <label for="floatingInput">Cellulare</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="email"
                                            value="{{ $client->email }}">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="citta"
                                            value="{{ $client->citta }}">
                                        <label for="floatingInput">Città</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="tipo"
                                            value="{{ $client->tipo }}">
                                        <label for="floatingInput">Tipo Cliente</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="floatingInput" name="status"
                                            value="{{ $client->status }}">
                                        <label for="floatingInput">Status</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="note" id="floatingInput">{{ $client->note }}</textarea>
                                        <label for="floatingInput">Note</label>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">MODIFICA</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
