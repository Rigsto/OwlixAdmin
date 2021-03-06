<div class="modal fade" id="updateVoucher-{{$voucher['id']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.voucher.update', $voucher['id']) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Voucher</h4>
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12 text-gray-800">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                {!! Form::number('discount', $voucher['discount'], ['class'=>'form-control', 'min'=>0, 'max'=>100, 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="expired">Berlaku hingga</label>
                                {!! Form::date('expired', $voucher['expired_date'], ['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {!! Form::select('status', array(1=>'Aktif', 0=>'Tidak Aktif'), $voucher['is_active'], ['class'=>'form-control custom-select', 'placeholder'=>'--Pilih Salah Satu--']) !!}
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
