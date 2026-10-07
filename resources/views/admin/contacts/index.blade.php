@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Kontak')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-envelope"></i> Daftar Pesan dari Halaman Kontak</h3>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        @if($contacts->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Layanan Diminati</th>
                    <th>Pesan / Brief</th>
                    <th style="width: 150px;">Status</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $i => $contact)
                <tr style="{{ !$contact->is_read ? 'background: rgba(139, 92, 246, 0.05);' : '' }}">
                    <td>
                        {{ $i + 1 }}
                        @if(!$contact->is_read)
                            <div style="width: 8px; height: 8px; background: var(--purple-400); border-radius: 50%; display: inline-block; margin-left: 6px;"></div>
                        @endif
                    </td>
                    <td><small style="color: var(--slate-400);">{{ $contact->created_at->format('d M Y') }}</small></td>
                    <td>
                        <strong style="color: #fff; display:block;">{{ $contact->name }}</strong>
                        <small style="color: var(--purple-400);">{{ $contact->contact_info }}</small>
                    </td>
                    <td><span style="color: var(--slate-300);">{{ $contact->service ?? '-' }}</span></td>
                    <td>
                        <div style="max-width: 300px; max-height: 80px; overflow-y: auto; font-size: 13px; color: var(--slate-400); padding-right: 10px;">
                            {{ $contact->message ?? '-' }}
                        </div>
                    </td>
                    <td>
                        @if($contact->is_read)
                            <span class="badge-status badge-read"><i class="fa-solid fa-check-double"></i> Dibaca</span>
                        @else
                            <form action="{{ route('admin.contacts.markRead', $contact) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-admin btn-admin-sm btn-success-sm" style="font-size: 11px;">
                                    Tandai Dibaca
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
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
            <i class="fa-solid fa-envelope-open-text"></i>
            <h3>Belum ada pesan masuk</h3>
            <p>Pesan dari form kontak pelanggan akan muncul di sini.</p>
        </div>
        @endif
    </div>
</div>
@endsection
