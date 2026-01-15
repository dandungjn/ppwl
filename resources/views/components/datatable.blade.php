<div class="table-responsive">
    <table id="{{ $id ?? 'datatable' }}" class="table table-bordered">
        <thead>
            <tr>
                @foreach ($columns as $col)
                    <th>{{ $col['title'] }}</th>
                @endforeach
            </tr>
        </thead>
    </table>
</div>
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script>
        function formatRupiah(amount) {
            return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
        }
        function formatPersen(amount) {
            return amount + '%';
        }
        function formatAngka(amount) {
            return parseInt(amount).toLocaleString('id-ID');
        }
        function formatTanggal(dateStr) {
            if (!dateStr) return '';
            const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            const d = new Date(dateStr);
            return d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
        }
        $(document).ready(function() {
            $('#{{ $id ?? 'datatable' }}').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ $ajax }}',
                columns: {!! json_encode($columns) !!},
                createdRow: function(row, data, dataIndex) {
                    @foreach ($columns as $idx => $col)
                        @if (isset($col['format']))
                            let cell = $('td', row).eq({{ $idx }});
                            switch ('{{ $col['format'] }}') {
                                case 'rupiah':
                                    cell.text(formatRupiah(data['{{ $col['data'] }}']));
                                    break;
                                case 'persen':
                                    cell.text(formatPersen(data['{{ $col['data'] }}']));
                                    break;
                                case 'angka':
                                    cell.text(formatAngka(data['{{ $col['data'] }}']));
                                    break;
                                case 'tanggal':
                                    cell.text(formatTanggal(data['{{ $col['data'] }}']));
                                    break;
                            }
                        @endif
                    @endforeach
                },
                ...{!! $options ?? '{}' !!}
            });
        });
    </script>
@endpush
