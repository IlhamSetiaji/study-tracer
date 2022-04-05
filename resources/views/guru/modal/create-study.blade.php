<div class="modal fade" tabindex="-1" role="dialog" id="modalCreateData">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createRecord" action="{{ url('/guru/study') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Study</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Alumni</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">University</label>
                        <input type="text" class="form-control" id="description" name="university">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Joined Date</label>
                        <input type="date" class="form-control" id="description" name="joined_date">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Graduate Date</label>
                        <input type="date" class="form-control" id="description" name="graduate_date">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Address</label>
                        <input type="text" class="form-control" id="description" name="address">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Fakultas</label>
                        <input type="text" class="form-control" id="description" name="fakultas">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="description" name="jurusan">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
