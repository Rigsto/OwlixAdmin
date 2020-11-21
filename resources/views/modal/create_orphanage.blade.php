<div class="modal fade" id="createOrphanage">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.donasi.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Panti Asuhan / Yayasan</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                {!! Form::text('address', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="hp">No HP</label>
                                {!! Form::text('hp', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="admin">Penanggung Jawab</label>
                                {!! Form::text('admin', null, ['class'=>'form-control', 'required']) !!}
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
