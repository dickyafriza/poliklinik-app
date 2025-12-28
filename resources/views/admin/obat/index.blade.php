<x-layouts.app title="Data Obat">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- ALERT FLASH MESSAGE --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h1 class="mb-4">Data Obat</h1>

                {{-- LOW STOCK ALERT --}}
                @php
                    $lowStockThreshold = config('app.low_stock_threshold', 10);
                    $lowStockObats = $obats->filter(function($obat) use ($lowStockThreshold) {
                        return $obat->stok <= $lowStockThreshold;
                    });
                @endphp

                @if($lowStockObats->count() > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan Stok Menipis!</h5>
                        <p class="mb-2">Terdapat <strong>{{ $lowStockObats->count() }} obat</strong> dengan stok menipis (≤ {{ $lowStockThreshold }} pcs):</p>
                        <ul class="mb-0">
                            @foreach($lowStockObats->take(5) as $obat)
                                <li>
                                    <strong>{{ $obat->nama_obat }}</strong> - 
                                    <span class="badge badge-danger">{{ $obat->stok }} pcs</span>
                                    <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-xs btn-warning ml-2">
                                        <i class="fas fa-edit"></i> Re-stock
                                    </a>
                                </li>
                            @endforeach
                            @if($lowStockObats->count() > 5)
                                <li class="text-muted">... dan {{ $lowStockObats->count() - 5 }} obat lainnya</li>
                            @endif
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah Obat
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th>Id</th> --}}
                                <th>Nama Obat</th>
                                <th>Kemasan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $obat)
                                <tr>
                                    {{-- <td>{{ $obat->id }}</td> --}}
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->kemasan }}</td>
                                    <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $lowThreshold = config('app.low_stock_threshold', 10);
                                            $warningThreshold = $lowThreshold * 2;
                                        @endphp
                                        
                                        @if($obat->stok <= $lowThreshold)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $obat->stok }} pcs
                                            </span>
                                        @elseif($obat->stok <= $warningThreshold)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-exclamation-circle"></i> {{ $obat->stok }} pcs
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> {{ $obat->stok }} pcs
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">
                                        Belum ada data obat
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>
</x-layouts.app>
