<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 8px;
            font-size: 16px;
            color: #555;
        }
        .info td.label {
            font-weight: bold;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        .data-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .data-table td {
            font-size: 16px;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
        }
        .footer .total {
            font-size: 18px;
            font-weight: bold;
        }
      </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice Detail</h1>
        </div>
      
        <!-- Informasi di atas tabel -->
        <div class="info">
            <table>
                <tr>
                    <td class="label">No Invoice:</td>
                    <td>{{$so->no_invoice}}</td>
                </tr>
                <tr>
                    <td class="label">Nama Sales:</td>
                    <td>{{$sales->nama_lengkap}}</td>
                </tr>
                <tr>
                    <td class="label">Nama Toko:</td>
                    <td>{{$customer->nama_toko}}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Order:</td>
                    <td>{{$so->tanggal_invoice}}</td>
                </tr>
            </table>
        </div>
      
        <!-- Tabel Total Hutang -->
        <table class="data-table">
            <thead>
             
            </thead>
            <tbody>
              <tr>
                <td>Total Hutang</td>
                <td>Rp</td>
                <td>{{$piutang->total_invoice}}</td>
            </tr>
            <tr>
                <td>Terbayar</td>
                <td>Rp</td>
                <td>{{$piutang->jumlah_bayar}}</td>
            </tr>
            <tr>
                <td>Sisa Hutang</td>
                <td>Rp</td>
                <td>{{$piutang->sisa_piutang}}</td>
            </tr>
            </tbody>
        </table>
      
        <!-- Bagian footer -->
        <div class="footer">
            <div class="total">Total Sisa Hutang: Rp {{$piutang->sisa_piutang}}</div>
            <div class="total">27-09-20024</div>
            <div class="total">John Doe</div>
        </div>
      </div>
      <script>
        // window.print();
        setTimeout(function() {
            window.print();
        }, 0);
       </script>
</body>
</html>








   
