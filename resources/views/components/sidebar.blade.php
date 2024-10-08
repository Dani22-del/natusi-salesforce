<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item active">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ri-home-smile-line"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-copy-line"></i>
            <div data-i18n="Sales">Sales</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('sales-order') }}" class="menu-link">
                    <div data-i18n="Sales Order">Sales Order</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-sales') }}" class="menu-link">
                    <div data-i18n="Data Sales">Data Sales</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-target') }}" class="menu-link">
                    <div data-i18n="Target">Target</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('schedule') }}" class="menu-link">
                    <div data-i18n="Schedule">Schedule</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('tracking') }}" class="menu-link">
                    <div data-i18n="Tracking">Tracking</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('summary') }}" class="menu-link">
                    <div data-i18n="Summary">Summary</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Front Pages -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-copy-line"></i>
            <div data-i18n="Driver">Driver</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('data-driver') }}" class="menu-link">
                    <div data-i18n="Data Driver">Data Driver</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('schedule-driver') }}" class="menu-link">
                    <div data-i18n="Schedule">Schedule</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('summary-driver') }}" class="menu-link">
                    <div data-i18n="Summary">Summary</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Apps & Pages -->
    <li class="menu-header mt-5">
        <span class="menu-header-text" data-i18n="KEUANGAN">KEUANGAN</span>
    </li>
    <li class="menu-item">
        <a href="{{ route('pembayaran') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-mail-open-line"></i>
            <div data-i18n="Pembayaran">Pembayaran</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('piutang') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-wechat-line"></i>
            <div data-i18n="Piutang">Piutang</div>
        </a>
    </li>

    <!-- Components -->
    <li class="menu-header mt-5">
        <span class="menu-header-text" data-i18n="DATA MASTER">DATA MASTER</span>
    </li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-bank-card-2-line"></i>
            <div data-i18n="Data Master">Data Master</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('data-customer') }}" class="menu-link">
                    <div data-i18n="Customer (Toko)">Customer (Toko)</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-principle') }}" class="menu-link">
                    <div data-i18n="Principle">Principle</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-stock') }}" class="menu-link">
                    <div data-i18n="Stock Produk">Stock Produk</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-produk') }}" class="menu-link">
                    <div data-i18n="Data Produk">Data Produk</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-satuan-produk') }}" class="menu-link">
                    <div data-i18n="Satuan Produk">Satuan Produk</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('data-gudang') }}" class="menu-link">
                    <div data-i18n="Gudang">Gudang</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('data-perusahaan')}}" class="menu-link">
                    <div data-i18n="Perusahaan">Perusahaan</div>
                </a>
            </li>
        </ul>
    </li>


    <!-- Forms & Tables -->
    <li class="menu-header mt-5">
        <span class="menu-header-text" data-i18n="TIDAK ORDER">TIDAK ORDER</span>
    </li>

    <li class="menu-item">
        <a href="{{ route('toko-tidak-order') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-checkbox-multiple-line"></i>
            <div data-i18n="Toko Tidak Order">Toko Tidak Order</div>
        </a>
    </li>

    <!-- Charts & Maps -->

    <li class="menu-header mt-5">
        <span class="menu-header-text" data-i18n="Retur">Retur</span>
    </li>

    <li class="menu-item">
        <a href="{{ route('data-retur') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-map-2-line"></i>
            <div data-i18n="Data Retur">Data Retur</div>
        </a>
    </li>

    <!-- Misc -->
    <li class="menu-header mt-5">
        <span class="menu-header-text" data-i18n="laporan">laporan</span>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ri-lifebuoy-line"></i>
            <div data-i18n="Presensi">Presensi</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ri-article-line"></i>
            <div data-i18n="Penjualan">Penjualan</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons ri-article-line"></i>
            <div data-i18n="Log Kunjungan">Log Kunjungan</div>
        </a>
    </li>
</ul>
