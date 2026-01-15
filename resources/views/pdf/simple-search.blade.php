<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Calibri', Arial, sans-serif; 
            font-size: 11px; 
            line-height: 1.5; 
            color: #000; 
            padding: 30px 40px;
        }
        
        /* HEADER */
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start; 
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }
        .logo-section { 
            display: flex; 
            align-items: center; 
            gap: 10px;
        }
        .logo-img { 
            width: 30px; 
            height: 30px; 
        }
        .company-name { 
            font-weight: bold; 
            font-size: 12px; 
            color: #000;
        }
        .date-section { 
            text-align: right; 
            font-size: 11px;
            line-height: 1.4;
        }
        .date-value {
            font-weight: bold;
            background: #ffff00;
            padding: 2px 5px;
            display: inline-block;
        }
        
        /* SURAT */
        .letter-head { margin: 25px 0 20px 0; }
        .to-section { 
            margin-bottom: 20px; 
            line-height: 1.8; 
            font-size: 11px;
        }
        .to-section div { margin: 3px 0; }
        .to-section .underline { text-decoration: underline; }
        
        .greeting { margin: 20px 0 15px 0; font-size: 11px; line-height: 1.6; }
        .greeting-text { margin-bottom: 8px; }
        
        /* DATA IDENTITAS */
        .identity-section { 
            margin: 20px 0 30px 0; 
            padding: 0;
        }
        .identity-row { 
            display: flex;
            gap: 0;
            margin-bottom: 6px;
            font-size: 11px;
            line-height: 1.4;
        }
        .identity-label { 
            width: 90px;
            font-weight: bold;
            flex-shrink: 0;
        }
        .identity-colon { 
            width: 20px;
            flex-shrink: 0;
        }
        .identity-value { 
            flex: 1;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        /* KONTEN SURAT */
        .letter-content { 
            margin: 25px 0; 
            text-align: justify;
            line-height: 1.8;
            font-size: 11px;
        }
        .letter-content p { 
            margin-bottom: 15px;
            text-indent: 35px;
        }
        .letter-content p:first-child {
            text-indent: 35px;
        }
        
        /* HIGHLIGHT */
        .highlight-yellow {
            background: #ffff00;
            font-weight: bold;
            padding: 1px 4px;
        }
        
        .highlight-underline {
            text-decoration: underline;
            font-weight: bold;
        }
        
        .bold {
            font-weight: bold;
        }
        
        /* TANDA TANGAN */
        .signature-section { 
            margin-top: 50px; 
            text-align: right;
        }
        .signature-closing { 
            margin-bottom: 70px;
            font-size: 11px;
        }
        .signature-name { 
            font-weight: bold;
            font-size: 11px;
            text-decoration: underline;
        }
        .signature-title { 
            font-size: 10px;
            margin-top: 2px;
        }
        
        /* PAGE BREAK */
        .page-break { 
            page-break-after: always;
            margin: 40px 0;
        }
        
        /* TABEL */
        .table-title { 
            text-align: center; 
            font-weight: bold;
            margin: 30px 0 20px 0;
            font-size: 12px;
            text-decoration: underline;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
            font-size: 10px;
        }
        table thead { 
            background: #333; 
            color: #fff;
        }
        table th { 
            padding: 8px 6px; 
            text-align: left; 
            border: 1px solid #000;
            font-weight: bold;
            font-size: 10px;
        }
        table td { 
            padding: 6px; 
            border: 1px solid #ccc;
            font-size: 10px;
        }
        table tbody tr:nth-child(even) { 
            background: #f0f0f0;
        }
        .total-row { 
            background: #e0e0e0; 
            font-weight: bold;
        }
        
        /* FOOTER */
        .footer { 
            margin-top: 25px; 
            text-align: center; 
            font-size: 9px; 
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="logo-section">
            @if(isset($company) && $company && $company->logo)
                <img src="{{ $company->logo }}" alt="Logo" class="logo-img" style="object-fit: contain;">
            @else
                <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 50%, #ffe66d 100%); border-radius: 3px;"></div>
            @endif
            <div class="company-name">{{ optional($company)->name ?? 'PT Nigmagrid Indo Nesia' }}</div>
        </div>
        <div class="date-section">
            <div>Jakarta,</div>
            <div><span class="date-value">{{ $letterDate ?? date('d/m/Y') }}</span></div>
        </div>
    </div>

    <!-- SURAT PERMOHONAN -->
    <div class="letter-head">
        <!-- TO -->
        <div class="to-section">
            <div>Kepada Yth,</div>
            <div class="underline">Pimpinan {{ $company?->bank?->name ?? 'Bank BRI' }}</div>
            <div class="underline">Kantor Cabang {{ $company?->bank?->account_holder ?? 'TB. Simatupang' }}</div>
            <div style="margin-top: 5px;">Di</div>
            <div style="font-weight: bold;">Tempat</div>
        </div>

        <!-- GREETING -->
        <div class="greeting">
            <div class="greeting-text"><span class="underline">Dengan Hormat,</span></div>
            <div style="margin-top: 10px;">Saya yang <span class="underline">bertanda tangan dibawah ini:</span></div>
        </div>
    </div>

    <!-- IDENTITAS PERUSAHAAN -->
    <div class="identity-section">
        <div class="identity-row">
            <div class="identity-label">Nama</div>
            <div class="identity-colon">:</div>
            <div class="identity-value">{{ optional($company)->name ?? '-' }}</div>
        </div>
        <div class="identity-row">
            <div class="identity-label">Alamat</div>
            <div class="identity-colon">:</div>
            <div class="identity-value">{{ optional($company)->address ?? '-' }}</div>
        </div>
        <div class="identity-row">
            <div class="identity-label">Jenis Usaha</div>
            <div class="identity-colon">:</div>
            <div class="identity-value">{{ optional($company)->acronym ?? '-' }}</div>
        </div>
        <div class="identity-row">
            <div class="identity-label">No. Telp</div>
            <div class="identity-colon">:</div>
            <div class="identity-value">{{ optional($company)->phone ?? '-' }}</div>
        </div>
    </div>

    <!-- ISI SURAT -->
    <div class="letter-content">
        <p>Dengan ini <span class="underline">memohonkan pencairan fasilitas sebesar</span> <span class="highlight-yellow">{{ $amountNumber ?? 'Rp 0' }}</span> <span class="highlight-underline">({{ $amountWords ?? '-' }})</span> atas fasilitas pinjaman kami di {{ $company?->bank?->name ?? 'Bank BRI' }} Kantor Cabang {{ $company?->bank?->account_holder ?? 'TB. Simatupang' }}, sebagai pembayaran atas kegiatan <span class="underline bold">{{ optional($item)->pekerjaan ?? '-' }}</span> dari pemberi kerja <span class="underline bold">{{ optional($item)->client ?? '-' }}</span>. Mohon dapat <span class="underline">dicairkan ke rekening pembayaran kami</span> <span class="bold">{{ $company?->bank?->account_number ?? '-' }}</span> atas nama <span class="bold">{{ optional($company)->name ?? '-' }}</span>.</p>

        <p><span class="underline">Demikian</span> permohonan ini saya buat, atas perhatiannya saya sampaikan terima kasih.</p>
    </div>

    <!-- TANDA TANGAN -->
    <div class="signature-section">
        <div class="signature-closing">Hormat Saya,</div>
        <div class="signature-name">{{ optional($company)->leader_name ?? '-' }}</div>
        <div class="signature-title">Direktur {{ optional($company)->name ?? 'PT. Nigmagrid Indo Nesia' }}</div>
    </div>

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- TABEL DETAIL -->
    @if(isset($items) && count($items) > 0)
        <div class="table-title">LAPORAN DETAIL SIMPLE SEARCH</div>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 25%;">Pekerjaan</th>
                    <th style="width: 20%;">Client</th>
                    <th style="width: 18%; text-align: right;">Nilai</th>
                    <th style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($items as $i => $row)
                    @php
                        $tgl = $row->tanggal ? $row->tanggal->format('d/m/Y') : '-';
                        $nilai = $row->nilai ?? 0;
                        $total += $nilai;
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $i + 1 }}</td>
                        <td>{{ $tgl }}</td>
                        <td>{{ $row->pekerjaan ?? '-' }}</td>
                        <td>{{ $row->client ?? '-' }}</td>
                        <td style="text-align: right;">Rp {{ number_format($nilai, 0, ',', '.') }}</td>
                        <td>{{ $row->status ?? '-' }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">TOTAL NILAI</td>
                    <td style="text-align: right;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endif

    <!-- FOOTER -->
    <div class="footer">
        Dokumen ini digenerate pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
