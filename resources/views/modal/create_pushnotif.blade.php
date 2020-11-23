<div class="modal fade" id="createNotif">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.notif.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Notifikasi</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="tgl">Tanggal</label>
                                {!! Form::date('tgl', \Carbon\Carbon::now(), ['class'=>'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                <label for="headline">Headline</label>
                                {!! Form::text('title', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
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
