<ul class="navbar-nav sidebar sidebar-dark accordion bg-gradient-primary" id="accordionSidebar"">
    <div class="sidebar-heading">
        <a href="{{ route('admin.home') }}" style="color: white; font-size: 36pt; text-decoration: none">
            <img src="{{ asset('img/logo_white.svg') }}" alt="" style="max-width: 100%; margin: 20px 0">
        </a>
    </div>
    <hr class="sidebar-divider my-0">
    <li class="nav-item"><a href="{{ route('admin.home') }}" class="nav-link">Dashboard</a></li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance" aria-expanded="true" aria-controls="collapseFinance">
            <span>Finance</span>
        </a>
        <div id="collapseFinance" class="collapse" aria-labelledby="headingFinance" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="{{ route('admin.omset') }}" class="collapse-item">Omset Owlix</a>
                <a href="{{ route('admin.order.index') }}" class="collapse-item">Jumlah Order</a>
                <a href="{{ route('admin.saldo.penarikan') }}" class="collapse-item">Penarikan Saldo</a>
                <a href="{{ route('admin.saldo.pengembalian') }}" class="collapse-item">Pengembalian Saldo</a>
                <a href="{{ route('admin.voucher') }}" class="collapse-item">Voucher</a>
                <a href="{{ route('admin.subscribe') }}" class="collapse-item">Subscribe</a>
                <a href="" class="collapse-item">Owlix Network</a>
                <a href="{{ route('admin.donasi.index') }}" class="collapse-item">Donasi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCS" aria-expanded="true" aria-controls="collapseCS">
            <span>Customer Service</span>
        </a>
        <div id="collapseCS" class="collapse" aria-labelledby="headingCS" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="" class="collapse-item">Mading / Info</a>
                <a href="" class="collapse-item">Push Notif</a>
                <a href="" class="collapse-item">Kategori</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
            <span>Settings</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a href="" class="collapse-item">Metode Pembayaran</a>
                <a href="" class="collapse-item">Metode Pengiriman</a>
                <a href="" class="collapse-item">Suspend Akun</a>
            </div>
        </div>
    </li>
</ul>
