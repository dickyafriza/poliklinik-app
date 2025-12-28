<nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    
    <!-- Right navbar Links -->
    <ul class="navbar-nav ml-auto">
        @if (request()->is('admin*'))
            <!-- Low Stock Notification -->
            @php
                $lowStockThreshold = config('app.low_stock_threshold', 10);
                $lowStockObats = \App\Models\Obat::where('stok', '<=', $lowStockThreshold)->get();
                $lowStockCount = $lowStockObats->count();
            @endphp
            
            @if($lowStockCount > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-danger navbar-badge">{{ $lowStockCount }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $lowStockCount }} Obat Stok Menipis</span>
                        <div class="dropdown-divider"></div>
                        
                        @foreach($lowStockObats->take(5) as $obat)
                            <a href="{{ route('obat.edit', $obat->id) }}" class="dropdown-item">
                                <i class="fas fa-pills mr-2"></i> {{ $obat->nama_obat }}
                                <span class="float-right text-muted text-sm">
                                    <span class="badge badge-danger">{{ $obat->stok }} pcs</span>
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        
                        <a href="{{ route('obat.index') }}" class="dropdown-item dropdown-footer">Lihat Semua Obat</a>
                    </div>
                </li>
            @endif
        @endif
        
        <!-- Fullscreen Button -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
