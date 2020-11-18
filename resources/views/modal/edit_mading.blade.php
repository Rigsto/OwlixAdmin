<div class="modal fade" id="updateMading-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.info.update', 1) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Mading</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', 'Home Zona 1', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                {!! Form::select('kategori', array('Home Page', 'News Zona 1', 'News Zona 2', 'News Zona 3'), 1,
                                ['class'=>'form-control custom-select', 'placeholder'=>'--Pilih Kategori--']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {!! Form::select('status', array(1=>'Aktif', 0=>'Tidak Aktif'), 1, ['class'=>'form-control custom-select', 'placeholder'=>'--Pilih Salah Satu--']) !!}
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Foto Mading</label>
                                {!! Form::file('file', ['class'=>'form-control-file']) !!}
                                <img src="http://placehold.it/400x400" alt="" style="width: 200px" class="mt-3">
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
