<div class="modal fade" id="updateToko-{{$partner['id']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.category.toko.update', $partner['id']) }}" method="POST">
                @csrf
                <input type="hidden" value="PATCH" name="_method">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kategori Toko</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', $partner['name'], ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {!! Form::select('status', array(1=>'Aktif', 0=>'Tidak Aktif'), 1, ['class'=>'form-control custom-select', 'placeholder'=>'--Pilih Salah Satu--']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
