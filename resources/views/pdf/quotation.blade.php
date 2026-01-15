<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Penawaran Harga</title>

    <style>
        @page {
            size: A4;
            margin: 2cm 2.5cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #000;
            line-height: 1.45;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* ================= HEADER ================= */
        .header {
            margin-bottom: 0.6cm;
        }

        .company {
            display: flex;
            align-items: center;
        }

        .company img {
            width: 1.2cm;
            margin-right: 0.3cm;
        }

        .company-name {
            font-weight: bold;
            font-size: 12.5pt;
        }

        .date {
            text-align: right;
        }

        /* ================= DOC INFO ================= */
        .doc-info {
            margin-bottom: 0.5cm;
        }

        .doc-info td {
            padding: 1px 0;
        }

        .doc-info .label {
            width: 2.2cm;
        }

        /* ================= CONTENT ================= */
        .kepada {
            margin-bottom: 0.4cm;
        }

        .paragraph {
            margin-bottom: 0.45cm;
            text-align: left !important;
            line-height: 1.6;
            word-wrap: break-word;
            white-space: normal;
        }

        /* ================= TABLE ================= */
        .item-table {
            margin: 0.4cm 0 0.5cm 0;
            font-size: 9.8pt;
        }

        .item-table th,
        .item-table td {
            border: 1px solid #000;
            padding: 0.14cm;
        }

        .item-table thead th {
            background-color: #2f5fb3;
            color: #fff;
            text-align: center;
        }

        .item-table tbody tr:nth-child(odd) {
            background-color: #e9f0ff;
        }

        .item-table tfoot td {
            background-color: #2f5fb3;
            color: #fff;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* ================= TERMS ================= */
        .terms {
            margin-bottom: 0.45cm;
        }

        .terms ul {
            margin-left: 0.6cm;
            margin-top: 0.15cm;
        }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<table class="header">
    <tr>
        <td width="65%">
            <table style="border:0;">
                <tr>
                    <td style="padding:0; border:0; vertical-align:middle; width:1.2cm;">
                        <img src="{{ public_path('icons/application-logo.png') }}" style="width:1.2cm; display:block;">
                    </td>
                    <td style="padding:0 0 0 0.3cm; border:0; vertical-align:middle;">
                        <div class="company-name">PT Nigmagrid Indo Nesia</div>
                    </td>
                </tr>
            </table>
        </td>
        <td width="35%" class="date">
            Jakarta, {{ \Carbon\Carbon::parse($quotation->date ?? now())->locale('id')->translatedFormat('d F Y') }}
        </td>
    </tr>
</table>

<!-- ================= DOC INFO ================= -->
<table class="doc-info">
    <tr>
        <td class="label">Nomor</td>
        <td>: {{ $quotation->number }}</td>
    </tr>
    <tr>
        <td class="label">Perihal</td>
        <td>: {{ $quotation->subject ?? 'Surat Penawaran Harga' }}</td>
    </tr>
</table>

<!-- ================= KEPADA ================= -->
<div class="kepada">
    Kepada Yth,<br>
    <strong>{{ $quotation->client?->name }}</strong>
    @if($quotation->attention_name)
        <br>Up. {{ $quotation->attention_name }}
    @endif
</div>

<!-- ================= SALAM PEMBUKA ================= -->
<div class="paragraph">
    Dengan hormat,
</div>

<!-- ================= PEMBUKA ================= -->
<div class="paragraph">
    {{ $quotation->job_description ?? 'Sehubungan dengan adanya kebutuhan untuk Jasa Backup Server Baremetal - Hyper V dan Power Automate. Maka dengan ini kami lampirkan penawaran untuk pekerjaan tersebut, dengan penawaran sebagai berikut :' }}
</div>

<!-- ================= TABLE ================= -->
<table class="item-table">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Item</th>
            <th width="8%">Qty</th>
            <th width="17%">Harga Satuan</th>
            <th width="18%">Total</th>
        </tr>
    </thead>
    <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($quotation->items as $i => $item)
        @php
            $total = $item->qty * $item->selling_price;
            $grandTotal += $total;
        @endphp
        <tr>
            <td class="text-center">{{ $i+1 }}</td>
            <td>{{ $item->item }}</td>
            <td class="text-center">{{ $item->qty }}</td>
            <td class="text-right">Rp{{ number_format($item->selling_price, 0, ',', '.') }}</td>
            <td class="text-right">Rp{{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right">Total</td>
            <td class="text-right">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>

<!-- ================= TERMS ================= -->
<div class="terms">
    <strong>Term & Condition :</strong>
    <ul>
        <li>Harga belum termasuk PPN;</li>
        <li>PO yang sudah diterima tidak dapat dibatalkan;</li>
        <li>Metode Pembayaran :
            <ul>
                <li>50% dibayarkan sebagai uang muka (DP)</li>
                <li>50% dibayarkan setelah pekerjaan selesai</li>
            </ul>
        </li>
    </ul>
</div>

<!-- ================= PENUTUP ================= -->
<div class="paragraph">
    Demikianlah penawaran ini kami sampaikan. Atas perhatian dan kerjasamanya kami
    ucapkan terima kasih.
</div>

<!-- ================= SIGNATURE (ANTI PAGE BREAK) ================= -->
<div style="margin-top:1.2cm; width:40%;">
    Hormat kami,<br>
    <strong>PT Nigmagrid Indo Nesia</strong><br>
    <br><br><br><br>
    <strong>{{ $quotation->company?->leader_name ?? '' }}</strong><br>
    Direktur
</div>

</body>
</html>
