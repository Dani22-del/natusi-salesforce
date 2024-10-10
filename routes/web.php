<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\data_master\CustommerController;
use App\Http\Controllers\data_master\DataStockController;
use App\Http\Controllers\data_master\GudangController;
use App\Http\Controllers\data_master\PerusahaanController;
use App\Http\Controllers\data_master\PrincipleController;
use App\Http\Controllers\data_master\ProdukController;
use App\Http\Controllers\data_master\SatuanProdukController;
use App\Http\Controllers\data_retur\DataReturController;
use App\Http\Controllers\driver\DriverController;
use App\Http\Controllers\driver\ScheduleController as DriverScheduleController;
use App\Http\Controllers\driver\SummaryController as DriverSummaryController;
use App\Http\Controllers\keuangan\PembayaranController;
use App\Http\Controllers\keuangan\PiutangController;
use App\Http\Controllers\sales\DataSalesController;
use App\Http\Controllers\sales\SalesOrderController;
use App\Http\Controllers\sales\ScheduleController;
use App\Http\Controllers\sales\SummaryController;
use App\Http\Controllers\sales\TargetController;
use App\Http\Controllers\sales\TrackingController;
use App\Http\Controllers\toko\TidakOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
use GuzzleHttp\Middleware;

Route::group(['prefix' => 'mid', 'middleware' => EnsureTokenIsValid::class], function () {
    Route::get('/', function () {
        return 'welcome';
    });
});

#Login
Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login/aksi_login', [LoginController::class, 'aksi_login'])->name('aksi_login')->middleware('guest');
    // Route::post('/sales-order/add-sales', [SalesOrderController::class, 'createSales'])->name('form-add-sales');
    // Route::post('/sales-order/detail-sales', [SalesOrderController::class, 'detailSales'])->name(
    //     'form-detail-sales-order'
    // );
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.main');
    });
    # SALES
    Route::group(['prefix' => 'sales'], function () {
        Route::group(['prefix' => 'sales-order'], function () {
            Route::get('/', [SalesOrderController::class, 'index'])->name('sales-order');
            Route::post('/store-sales-order', [SalesOrderController::class, 'store'])->name('store-so');
            Route::post('/delete-sales-order', [SalesOrderController::class, 'destroy'])->name('destroy-so');
            Route::post('/update-status-sales/{id}', [SalesOrderController::class, 'updateStatus'])->name('update-status');
            Route::post('/sales-order/add-sales', [SalesOrderController::class, 'createSales'])->name('form-add-sales');
            Route::post('/sales-order/detail-sales', [SalesOrderController::class, 'detailSales'])->name(
                'form-detail-sales-order'
            );
            Route::post('/delete-order-item', [SalesOrderController::class, 'destroyOrderItem'])->name('destroy-order-item');
            Route::post('/sales/sales-order/item-details', [SalesOrderController::class, 'getOrderItemDetails'])->name('get-order-item-details');
            Route::post('/sales/sales-order/update-item', [SalesOrderController::class, 'updateOrderItem'])->name('update-order-item');
        });
        Route::group(['prefix' => 'data-sales'], function () {
            Route::get('/', [DataSalesController::class, 'index'])->name('data-sales');
            Route::post('/data-sales/add-sales', [DataSalesController::class, 'createDataSales'])->name('form-add-data-sales');
            Route::post('/data-sales/detail-sales', [SalesOrderController::class, 'detailSales'])->name('form-detail-sales');
            Route::post('/data-sales/store-sales', [DataSalesController::class, 'store'])->name('store-sales');
            Route::post('/data-master/delete-data-sales', [DataSalesController::class, 'destroy'])->name('destroy-data-sales');
        });
        Route::group(['prefix' => 'target'], function () {
            Route::get('/', [TargetController::class, 'index'])->name('data-target');
            Route::post('/target/add-target', [TargetController::class, 'createDataTarget'])->name('form-add-data-target');
        });
        Route::group(['prefix' => 'schedule'], function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('schedule');
            Route::post('/schedule/add-schedule', [ScheduleController::class, 'createSchedule'])->name('form-add-schedule');
            Route::post('/schedule/detail-schedule', [ScheduleController::class, 'detailSchedule'])->name(
                'form-detail-schedule'
            );
            Route::post('/schedule/store-schedule', [ScheduleController::class, 'store'])->name('store-schedule-sales');
            Route::post('/schedule/delete-schedule-sales', [ScheduleController::class, 'destroy'])->name('destroy-schedule-sales');
        });
        Route::group(['prefix' => 'tracking'], function () {
            Route::get('/', [TrackingController::class, 'index'])->name('tracking');
        });
        Route::group(['prefix' => 'summary'], function () {
            Route::get('/', [SummaryController::class, 'index'])->name('summary');
        });
    });
    #DRIVER
    Route::group(['prefix' => 'driver'], function () {
        Route::group(['prefix' => 'data-driver'], function () {
            Route::get('/', [DriverController::class, 'index'])->name('data-driver');
            Route::post('/sales-order/add-sales', [DriverController::class, 'createDriver'])->name('form-add-driver');
            Route::post('/data-driver/store-driver', [DriverController::class, 'store'])->name('store-driver');
            Route::post('/data-driver/delete-driver', [DriverController::class, 'destroy'])->name('destroy-driver');
        });
        Route::group(['prefix' => 'schedule-driver'], function () {
            Route::get('/', [DriverScheduleController::class, 'index'])->name('schedule-driver');
            Route::post('/schedule-driver/add-schedule', [DriverScheduleController::class, 'createSchedule'])->name(
                'form-add-schedule-driver'
            );
            Route::post('/schedule-driver/store-schedule', [DriverScheduleController::class, 'store'])->name(
                'store-schedule-driver'
            );
            Route::post('/schedule-driver/delete-schedule-driver', [DriverScheduleController::class, 'destroy'])->name(
                'destroy-schedule-driver'
            );
        });
        Route::group(['prefix' => 'summary'], function () {
            Route::get('/', [DriverSummaryController::class, 'index'])->name('summary-driver');
        });
    });

    #KEUANGAN
    Route::group(['prefix' => 'keuangan'], function () {
        Route::group(['prefix' => 'piutang'], function () {
            Route::get('/', [PiutangController::class, 'index'])->name('piutang');
            Route::post('/add-piutang', [PiutangController::class, 'createPiutang'])->name('form-add-piutang');
            Route::post('/store-piutang', [PiutangController::class, 'store'])->name('store-piutang');
        });
        Route::group(['prefix' => 'pembayaran'], function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('pembayaran');
            Route::post('/add-pembayaran', [PembayaranController::class, 'createPembayaran'])->name('form-add-pembayaran');
        });
    });


    #DATA MASTER
    Route::group(['prefix' => 'data-master'], function () {
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', [CustommerController::class, 'index'])->name('data-customer');
            Route::post('/data-master/store-custommer', [CustommerController::class, 'store'])->name('store-custommer');
            Route::post('/data-master/delete-custommer', [CustommerController::class, 'destroy'])->name('destroy-custommer');
            Route::post('/data-master/add-custommer', [CustommerController::class, 'addCustommer'])->name('form-add-custommer');
            Route::post('/data-master/edit-custommer', [CustommerController::class, 'editCustommer'])->name(
                'form-edit-custommer'
            );
            Route::post('/data-master/detail-custommer', [CustommerController::class, 'detailCustommer'])->name(
                'form-detail-custommer'
            );
            Route::post('/data-master/delete-sales', [CustommerController::class, 'deleteSales'])->name(
                'form-delete-custommer'
            );
        });
        Route::group(['prefix' => 'principle'], function () {
            Route::get('/', [PrincipleController::class, 'index'])->name('data-principle');
            Route::post('/add-principle', [PrincipleController::class, 'addPrinciple'])->name('form-add-principle');
            Route::post('/edit-Principle', [PrincipleController::class, 'editPrinciple'])->name('form-edit-Principle');
            Route::post('/data-master/store-principle', [PrincipleController::class, 'store'])->name('store-Principle');
            Route::post('/data-master/delete-principle', [PrincipleController::class, 'destroy'])->name('destroy-Principle');
        });
        Route::group(['prefix' => 'stock'], function () {
            Route::get('/', [DataStockController::class, 'index'])->name('data-stock');
            Route::post('/data-master/store-stock', [DataStockController::class, 'store'])->name('store-stock');
            Route::post('/data-master/delete-stock', [DataStockController::class, 'destroy'])->name('destroy-stock');
            Route::post('/data-master/add-stock', [DataStockController::class, 'addStock'])->name('form-add-stock');
            Route::post('/data-master/detail-stock', [DataStockController::class, 'detailStock'])->name('form-detail-stock');
        });
        Route::group(['prefix' => 'produk'], function () {
            Route::get('/', [ProdukController::class, 'index'])->name('data-produk');
            Route::post('/data-master/add-produk', [ProdukController::class, 'addProduk'])->name('form-add-produk');
            Route::post('/data-master/detail-produk', [ProdukController::class, 'detailProduk'])->name('form-detail-produk');
            Route::post('/data-master/store', [ProdukController::class, 'store'])->name('store-produk');
            Route::post('/data-master/delete-produk', [ProdukController::class, 'destroy'])->name('destroy-produk');
        });
        Route::group(['prefix' => 'satuan-produk'], function () {
            Route::get('/', [SatuanProdukController::class, 'index'])->name('data-satuan-produk');
            Route::post('/data-master/add-satuan-produk', [SatuanProdukController::class, 'addSatuanProduk'])->name(
                'form-add-satuan-produk'
            );
            Route::post('/data-master/detail-satuan-produk', [SatuanProdukController::class, 'detailSatuanProduk'])->name(
                'form-detail-satuan-produk'
            );
            Route::post('/data-master/store-satuan', [SatuanProdukController::class, 'store'])->name('store-satuan');
            Route::post('/data-master/delete-satuan', [SatuanProdukController::class, 'destroy'])->name('destroy-satuan');
        });
        Route::group(['prefix' => 'gudang'], function () {
            Route::get('/', [GudangController::class, 'index'])->name('data-gudang');
            Route::post('/data-master/add-gudang', [GudangController::class, 'addGudang'])->name('form-add-gudang');
            Route::post('/data-master/detail-gudang', [GudangController::class, 'detailGudang'])->name('form-detail-gudang');
            Route::post('/data-master/store-gudang', [GudangController::class, 'store'])->name('store-gudang');
            Route::post('/data-master/delete-gudang', [GudangController::class, 'destroy'])->name('destroy-gudang');
        });
        Route::group(['prefix' => 'perusahaan'], function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('data-perusahaan');
            Route::post('/data-master/add-perusahaan', [PerusahaanController::class, 'addPerusahaan'])->name('form-add-perusahaan');
            Route::post('/data-master/detail-perusahaan', [PerusahaanController::class, 'detailPerusahaan'])->name('form-detail-perusahaan');
            Route::post('/data-master/store-perusahaan', [PerusahaanController::class, 'store'])->name('store-perusahaan');
            Route::post('/data-master/delete-perusahaan', [PerusahaanController::class, 'destroy'])->name('destroy-perusahaan');
        });
    });

    # TOKO TIDAK ORDER
    Route::group(['prefix' => 'toko-tidak-order'], function () {
        Route::get('/', [TidakOrderController::class, 'index'])->name('toko-tidak-order');
    });

    # DATA RETUR
    Route::group(['prefix' => 'data-retur'], function () {
        Route::get('/', [DataReturController::class, 'index'])->name('data-retur');
    });
});
