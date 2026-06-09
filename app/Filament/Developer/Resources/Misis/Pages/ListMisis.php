<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Misi;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ListMisis extends Page
{
    protected static string $resource = MisiResource::class;

    protected string $view = 'filament.developer.resources.misis.list-misis';

    public function getHeading(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return '';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    public $link_aplikasi;

    public function mulaiMisi($id)
    {
        if (empty($this->link_aplikasi)) {
            \Filament\Notifications\Notification::make()
                ->title(__('Link Aplikasi Harus Diisi'))
                ->danger()
                ->send();
            return;
        }

        $record = Misi::find($id);
        if (!$record || $record->id_user !== Auth::id()) return;

        // 1. Jika paket trusted badge = true, ubah semua tester pending/reviewing menjadi accepted
        if ($record->paket && $record->paket->trusted_badge) {
            \App\Models\MisiAnggota::where('id_misi', $record->id)
                ->whereIn('status', ['pending', 'reviewing'])
                ->update(['status' => 'accepted']);
        }

        // 2. Ambil semua tester yang sudah accepted (beserta relasi user untuk email)
        $acceptedTesters = \App\Models\MisiAnggota::where('id_misi', $record->id)
            ->where('status', 'accepted')
            ->with('user')
            ->get();

        // 3. Buat 14 sub misi untuk setiap tester yang accepted
        $now = \Carbon\Carbon::now();
        $subMisis = [];
        foreach ($acceptedTesters as $tester) {
            for ($i = 1; $i <= 14; $i++) {
                $subMisis[] = [
                    'id_misi' => $record->id,
                    'id_user' => $tester->id_user,
                    'hari_ke' => $i,
                    'status'  => 'notdone',
                    'created_at' => $now->copy()->addDays($i - 1),
                    'updated_at' => $now->copy()->addDays($i - 1),
                ];
            }
        }

        if (!empty($subMisis)) {
            \App\Models\MisiSub::insert($subMisis);
        }

        // 4. Ubah status misi menjadi running & simpan link
        $record->update([
            'status' => 'running',
            'link_aplikasi' => $this->link_aplikasi,
        ]);

        // 5. Ubah status tester accepted menjadi progress
        \App\Models\MisiAnggota::where('id_misi', $record->id)
            ->where('status', 'accepted')
            ->update(['status' => 'progress']);

        // 6. Kirim email notifikasi ke seluruh tester bahwa misi dimulai
        foreach ($acceptedTesters as $tester) {
            if ($tester->user && $tester->user->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($tester->user->email)->send(new \App\Mail\ContactMail(
                        'Pengujian Aplikasi Dimulai — PlayTest ID',
                        'Misi Pengujian Dimulai!',
                        "Halo {$tester->user->name},\n\nMisi pengujian untuk aplikasi \"{$record->nama_aplikasi}\" telah resmi dimulai oleh developer.\nSilakan mulai mengunduh aplikasi dan selesaikan tugas harian Anda selama 14 hari ke depan.",
                        'Lihat Misi Saya',
                        url('/tester/misi-saya')
                    ));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Gagal mengirim email misi dimulai ke ' . $tester->user->email . ': ' . $e->getMessage());
                }
            }
        }

        \Filament\Notifications\Notification::make()
            ->title(__('Misi Berhasil Dimulai'))
            ->body(__('Status misi telah diubah menjadi running dan sub-misi tester telah dibuat.'))
            ->success()
            ->send();
            
        $this->link_aplikasi = null;
        $this->dispatch('close-modal-mulai');
    }

    public function hapusMisi($id)
    {
        $record = Misi::find($id);
        if (!$record || $record->id_user !== Auth::id()) return;

        $record->delete();

        \Filament\Notifications\Notification::make()
            ->title(__('Aplikasi Berhasil Dihapus'))
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        $userId = Auth::id();

        $misis = Misi::where('id_user', $userId)->with(['paket'])
            ->withCount('misiAnggotas')
            ->latest()
            ->get();

        $colors = [
            ['#1e3a8a', '#3b82f6'], // Blue
            ['#ea580c', '#fb923c'], // Orange
            ['#059669', '#10b981'], // Green
            ['#7c3aed', '#a78bfa'], // Purple
            ['#be123c', '#fb7185'], // Rose
        ];

        $statusMap = [
            'pending'   => __('Tertunda'),
            'open'      => __('Terbuka'),
            'running'   => __('Berjalan'),
            'closed'    => __('Ditutup'),
            'completed' => __('Selesai'),
            'rejected'  => __('Ditolak'),
            'active'    => __('Aktif'),
        ];

        return [
            'statTotal'   => $misis->count(),
            'statRunning' => $misis->where('status', 'running')->count(),
            'statTesters' => \App\Models\MisiAnggota::whereIn('id_misi', $misis->pluck('id'))->count(),
            'statPoints'  => $misis->sum('point'),
            
            'kampanyeList' => $misis->map(function($misi, $idx) use ($colors, $statusMap) {
                $rawStatus = trim($misi->status); // e.g. 'active', 'pending', 'closed', 'running'
                $grad = $colors[$idx % count($colors)];
                $statusUI = $statusMap[strtolower($rawStatus)] ?? ucfirst($rawStatus);
                
                // Timeline logic (14 days)
                $createdAt = $misi->created_at;
                $hariKe = $createdAt ? (int) $createdAt->diffInDays(now()) : 0;
                $hariKe = min(max($hariKe, 0), 14);

                return [
                    'id'        => $misi->id,
                    'nama'      => $misi->nama_aplikasi,
                    'developer' => Auth::user()->name ?? 'Unknown',
                    'status'    => $statusUI,
                    'raw_status'=> $rawStatus,
                    'tester'    => $misi->misi_anggotas_count,
                    'maxTester' => $misi->kapasitas ?? config('missions.max_capacity', 20),
                    'hariKe'    => ($rawStatus === 'completed') ? 14 : (($rawStatus === 'pending' || $rawStatus === 'closed') ? 0 : $hariKe),
                    'maxHari'   => 14,
                    'mulai'     => $misi->created_at ? $misi->created_at->format('d M Y') : '-',
                    'selesai'   => $misi->created_at ? $misi->created_at->addDays(14)->format('d M Y') : '-',
                    'paket'     => $misi->paket->nama_paket ?? 'Starter',
                    'poin'      => $misi->point ?? 0,
                    'logo'      => $misi->logo,
                    'ikonHuruf' => strtoupper(substr($misi->nama_aplikasi, 0, 1)),
                    'ikonGrad'  => "linear-gradient(135deg, {$grad[0]} 0%, {$grad[1]} 100%)",
                ];
            })->toArray(),
        ];
    }
}