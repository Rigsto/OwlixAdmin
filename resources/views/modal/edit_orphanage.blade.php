<div class="modal fade" id="updateOrphanage-{{$orphan['id']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.donasi.update', $orphan['id']) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Panti Asuhan / Yayasan</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                {!! Form::text('name', $orphan['orphanage_name'], ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                {!! Form::text('address', $orphan['orphanage_address'], ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="hp">No HP</label>
                                {!! Form::text('hp', $orphan['orphanage_phone_number'], ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="admin">Penanggung Jawab</label>
                                {!! Form::text('admin', $orphan['orphanage_administrator'], ['class'=>'form-control', 'required']) !!}
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
