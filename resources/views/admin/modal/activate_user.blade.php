@foreach ($users as $d)
<div class="modal fade" tabindex="-1" role="dialog" id="modalUpdateAkunStatus{{ $d->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activate User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk mengaktifkan {{ $d->name }}?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-success" href="{{ url('/admin/account/'.$d->id.'/update-status') }}">Aktifkan User</a>
            </div>
        </div>
    </div>
</div>
@endforeach
