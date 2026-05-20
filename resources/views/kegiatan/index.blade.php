@extends('layouts.app')

@section('page_title', 'Kelola Kegiatan')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-extrabold text-white mb-1">Daftar Alternatif Kegiatan</h3>
            <p class="text-sm text-slate-400">
                Data kegiatan ini digunakan sebagai alternatif dalam perhitungan SAW.
                Total: <span class="text-white font-bold">{{ $kegiatan->count() }} kegiatan</span>
            </p>
        </div>
        <a href="{{ route('admin.kegiatan.create') }}"
           class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-lg shadow-indigo-500/10 transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kegiatan
        </a>
    </div>

    {{-- Statistik per jenis --}}
    <div class="grid grid-cols-3 gap-4">
        @php
            $jumlahUkm         = $kegiatan->where('jenis','ukm')->count();
            $jumlahLomba       = $kegiatan->where('jenis','lomba')->count();
            $jumlahSertifikasi = $kegiatan->where('jenis','sertifikasi')->count();
        @endphp
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 text-center">
            <p class="text-2xl font-black text-blue-400">{{ $jumlahUkm }}</p>
            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">UKM</p>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 text-center">
            <p class="text-2xl font-black text-amber-400">{{ $jumlahLomba }}</p>
            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">Lomba</p>
        </div>
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 text-center">
            <p class="text-2xl font-black text-purple-400">{{ $jumlahSertifikasi }}</p>
            <p class="text-xs text-slate-500 font-semibold mt-1 uppercase tracking-wider">Sertifikasi</p>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/60 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Nama Kegiatan</th>
                        <th class="p-4">Penyelenggara</th>
                        <th class="p-4 text-center">Jenis</th>
                        <th class="p-4 text-center">Nilai Kriteria</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @forelse($kegiatan as $index => $item)
                    <tr class="hover:bg-slate-800/30 transition-all">
                        <td class="p-4 text-center font-semibold text-slate-500">{{ $index + 1 }}</td>

                        <td class="p-4">
                            <p class="font-bold text-white">{{ $item->nama }}</p>
                            @if($item->deskripsi)
                                <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $item->deskripsi }}</p>
                            @endif
                        </td>

                        <td class="p-4 text-slate-400 text-xs">{{ $item->penyelenggara ?? '—' }}</td>

                        <td class="p-4 text-center">
                            @php
                                $warna = match($item->jenis) {
                                    'ukm'          => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'lomba'        => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                    'sertifikasi'  => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                    default        => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                                };
                                $label = match($item->jenis) {
                                    'ukm'         => 'UKM',
                                    'lomba'       => 'Lomba',
                                    'sertifikasi' => 'Sertifikasi',
                                    default       => ucfirst($item->jenis),
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-lg border text-xs font-semibold {{ $warna }}">
                                {{ $label }}
                            </span>
                        </td>

                        <td class="p-4 text-center">
                            @if($item->nilai_kegiatan_count > 0)
                                <span class="text-xs text-emerald-400 font-bold">
                                    ✓ {{ $item->nilai_kegiatan_count }} kriteria
                                </span>
                            @else
                                <span class="text-xs text-rose-400 font-bold">⚠ Belum ada nilai</span>
                            @endif
                        </td>

                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kegiatan.edit', $item) }}"
                                   class="p-2 text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-all"
                                   title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}"
                                      onsubmit="return confirm('Hapus kegiatan {{ $item->nama }}? Semua nilai kriterianya ikut terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all"
                                            title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center text-slate-500">
                            <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-3 text-slate-700"></i>
                            <p class="text-sm font-semibold">Belum ada kegiatan.</p>
                            <a href="{{ route('admin.kegiatan.create') }}"
                               class="mt-3 inline-flex items-center gap-1 text-indigo-400 hover:text-indigo-300 text-xs font-bold">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah sekarang
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection