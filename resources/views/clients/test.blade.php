<button tabindex="0" type="button" class="btn btn-sm btn-info" data-bs-toggle="popover" data-bs-placement="right"
    data-bs-custom-class="custom-popover" data-bs-title="{{ $client->nome }} {{ $client->cognome }}"
    data-bs-content="{{ $client->note }}"><i class="bi bi-info-circle"></i>

</button>


<a tabindex="0" class="btn btn-lg btn-danger" role="button" data-bs-toggle="popover" data-bs-trigger="focus"
    data-bs-title="{{ $client->nome }} {{ $client->cognome }}"
    data-bs-content="{{ $client->note }}">Dismissible popover</a>
