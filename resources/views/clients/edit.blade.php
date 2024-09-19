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
                        <h4> Modifica Cliente</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">

                    </div>
                </div>
            </div>


            <div class="card-body">
                <form action="{{ route('client.update', $client->cid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('GET')
                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" value="{{$client->nome}}" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="">cognome</label>
                        <input type="text" class="form-control" value="{{$client->cognome}}" name="cognome">
                    </div>
                    <div class="form-group">
                        <label for="">Cellulare</label>
                        <input type="text" class="form-control" value="{{$client->cellulare}}" name="cellulare">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" value="{{$client->email}}" name="email">
                    </div>
                    <div class="form-group">
                        <label for="">Città</label>
                        <input type="text" class="form-control" value="{{$client->citta}}" name="citta">
                    </div>
                    <div class="form-group">
                        <label for="">Tipo Cliente</label>
                        <input type="text" class="form-control" value="{{$client->tipo}}" name="tipo">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" class="form-control" value="{{$client->status}}" name="status">
                    </div>
                    <div class="form-group">
                        <label for="">Nota</label>
                        <textarea type="text" class="form-control" value="{{$client->note}}" name="note"></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">MODIFICA</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection