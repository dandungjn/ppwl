<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima - {{ $receipt->id }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 30px 35px;
        }

        /* ===== HEADER ===== */
        .header {
            margin-bottom: 15px;
        }

        .company-table {
            border-collapse: collapse;
        }

        .logo-cell {
            width: 70px;
            vertical-align: middle;
        }

        .logo {
            width: 65px;
        }

        .company-name {
            vertical-align: middle;
            font-size: 11px;
            font-weight: bold;
            padding-left: 8px;
            line-height: 1.2;
        }

        .title {
            margin-top: 8px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        /* ===== BOX ===== */
        .box {
            border: 1px solid #000;
            height: 360px;
            padding: 12px;
            margin-top: 20px;
        }

        .description {
            font-size: 12px;
            line-height: 1.4;
        }

        /* ===== DATE ===== */
        .date {
            margin-top: 25px;
            font-size: 12px;
        }

        /* ===== SIGNATURE ===== */
        .signature {
            position: relative;
            height: 160px;
            margin-top: 10px;
        }

        .sig-col {
            width: 45%;
            position: absolute;
            top: 0;
            font-size: 12px;
        }

        .sig-left {
            left: 0;
            text-align: left;
        }

        .sig-right {
            right: 0;
            text-align: center;
        }

        .sig-label {
            margin-bottom: 70px;
        }

        .sig-name {
            font-size: 10px;
        }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            bottom: 25px;
            right: 35px;
            width: 160px;
            text-align: right;
            font-size: 9px;
            line-height: 1.3;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <table class="company-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('icons/application-logo.png') }}" class="logo">
                </td>
                <td class="company-name">
                    PT Nigmagrid Indo Nesia
                </td>
            </tr>
        </table>

        <div class="title">Tanda Terima</div>
    </div>

    <!-- BOX -->
    <div class="box">
        <div class="description">
            {!! $receipt->description !!}
        </div>
    </div>

    <!-- DATE -->
    <div class="date">
        Jakarta,
        {{ optional($receipt->received_date)->format('d F Y') ?? optional($receipt->created_at)->format('d F Y') }}
    </div>

    <!-- SIGNATURE -->
    <div class="signature">
        <div class="sig-col sig-left">
            <div class="sig-label">Yang Menyerahkan</div>
            <div class="sig-name">( {{ $receipt->sender_name }} )</div>
        </div>

        <div class="sig-col sig-right">
            <div class="sig-label">Yang Menerima</div>
            <div class="sig-name">( {{ $receipt->receiver_name }} )</div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        www.nigmagrid.net<br>
        Puri Botanical H9-8<br>
        Jakarta Barat 11640<br>
        Indonesia<br>
        62 21 589066608
    </div>

</body>
</html>
