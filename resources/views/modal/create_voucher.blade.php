<div class="modal fade" id="createVoucher">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.voucher.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Voucher</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                {!! Form::number('discount', null, ['class'=>'form-control', 'min'=>0, 'max'=>100, 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="expired">Berlaku hingga</label>
                                {!! Form::date('expired', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {!! Form::select('status', array(1=>'Aktif', 0=>'Tidak Aktif'), null, ['class'=>'form-control custom-select', 'placeholder'=>'--Pilih Salah Satu--']) !!}
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
