@extends('layouts.admin')

@section('title', 'Pesanan Masuk')
@section('page-title', 'Pesanan Masuk')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-cart-shopping"></i> Daftar Pesanan</h3>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        @if($orders->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Layanan Dipesan</th>
                    <th>Pesan Tambahan</th>
                    <th>Status</th>
                    <th style="width: 150px;">Ubah Status</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><small style="color: var(--slate-400);">{{ $order->created_at->format('d M Y') }}</small></td>
                    <td>
                        <strong style="color: #fff; display:block;">{{ $order->customer_name }}</strong>
                        <small style="color: var(--purple-400);">{{ $order->customer_contact }}</small>
                    </td>
                    <td><strong style="color: var(--slate-300);">{{ $order->service_name }}</strong></td>
                    <td><small style="color: var(--slate-400); display: block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $order->message ?? '-' }}</small></td>
                    <td><span class="badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" class="select-admin" style="padding: 6px 10px; font-size: 12px; height: 32px; border-radius: 6px;" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini secara permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-admin btn-admin-sm btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="fa-solid fa-cart-shopping"></i>
            <h3>Belum ada pesanan</h3>
            <p>Data pesanan pelanggan akan muncul di sini.</p>
        </div>
        @endif
    </div>
</div>
@endsection
