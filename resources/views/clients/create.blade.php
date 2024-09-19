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
                        <div class="row">
                            <div class="col-md-4 bolder">
                                <h3> Aggiungi Cliente</h3>
                            </div>

                        </div>
                        <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nome</label>
                                <input type="text" class="form-control" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="">cognome</label>
                                <input type="text" class="form-control" name="cognome">
                            </div>
                            <div class="form-group">
                                <label for="">Cellulare</label>
                                <input type="text" class="form-control" name="cellulare">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label for="">Città</label>
                                <input type="text" class="form-control" name="citta">
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <input type="text" class="form-control" name="tipo">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="text" class="form-control" name="ststus">
                            </div>
                            <div class="form-group">
                                <label for="">Note</label>
                                <input type="text" class="form-control" name="note">
                            </div>

                            <div class="form-group mt-3">
                                <button class="btn btn-primary">ADD</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
