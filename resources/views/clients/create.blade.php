<x-app-layout>
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

                        <div class="card mt-5">
                            <div class="card-header w-100">

                                <h3> Aggiungi Cliente</h3>

                            </div>
                            <div class="card-body">
                                <form action="{{ route('client.store') }}" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-1">
                                        <div class=" col form-floating mb-3">
                                            <input class="form-control" id="nome" name="nome" placeholder="">
                                            <label for="nome">Nome</label>
                                        </div>
                                        <div class="col form-floating mb-3">
                                            <input class="form-control" id="cognome" name="cognome" placeholder="">
                                            <label for="cognome">Cognome</label>
                                        </div>
                                    </div>
                                    <div class="row g-1">
                                        <div class="col form-floating mb-3">
                                            <input class="form-control" id="cellulare" name="cellulare" placeholder="">
                                            <label for="cellulare">Cellulare</label>
                                        </div>
                                        <div class="col form-floating mb-3">
                                            <input class="form-control" id="email" name="email" placeholder="">
                                            <label for="email">Email</label>
                                        </div>

                                        <div class="col form-floating mb-3">
                                            <input class="form-control" id="citta" name="citta" placeholder="">
                                            <label for="citta">Città</label>
                                        </div>
                                    </div>
                                    <div class="row g-1">
                                        <div class="col form-floating mb-3">
                                            <select class="form-control" id="floatingInput" name="tipo">
                                                @foreach ($types as $id => $name)
                                                    <option value="{{ $name }}">
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingInput">tipo</label>
                                        </div>
                                        <div class="col form-floating mb-3">
                                            <select class="form-control" id="floatingInput" name="status">
                                                @foreach ($statuses as $id => $name)
                                                    <option value="{{ $name }}">
                                                        {{ $name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingInput">Status</label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="note" name="note" style="height: 100px" placeholder=""></textarea>
                                        <label for="note">Note</label>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button class="btn btn-success">Aggiungi</button>
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
