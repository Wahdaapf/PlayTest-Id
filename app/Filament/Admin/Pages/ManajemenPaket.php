<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use App\Models\Paket;
use App\Models\Pembayaran;

class ManajemenPaket extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Manajemen Paket';
    protected static ?string $title = 'Manajemen Paket';
    protected static ?string $slug = 'manajemen-paket';
    protected string $view = 'filament.admin.pages.manajemen-paket';

    public function table(Table $table): Table
    {
        return $table
            ->query(Paket::query())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Paket')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('short_desc')
                    ->label('Subtitle')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fee')
                    ->label('Fee')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('point')
                    ->label('Poin Reward')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('most_popular')
                    ->label('Terpopuler')
                    ->boolean(),
                ToggleColumn::make('aktif')
                    ->label('Aktif'),
                ToggleColumn::make('trusted_badge')
                    ->label('Trusted Badge'),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->label('Nama Paket')
                            ->required(),
                        TextInput::make('short_desc')
                            ->label('Subtitle Dasar')
                            ->placeholder('Solusi dasar untuk memenuhi syarat...'),
                        TextInput::make('price')
                            ->label('Harga (Rp)')
                            ->numeric()
                            ->required(),
                        TextInput::make('fee')
                            ->label('Fee (Rp)')
                            ->numeric()
                            ->required(),
                        TextInput::make('point')
                            ->label('Poin Reward')
                            ->numeric()
                            ->required(),
                        RichEditor::make('desc')
                            ->label('Fitur & Deskripsi')
                            ->required(),
                        Toggle::make('aktif')
                            ->label('Aktif')
                            ->default(true),
                        Toggle::make('most_popular')
                            ->label('Terpopuler')
                            ->default(false),
                        Toggle::make('trusted_badge')
                            ->label('Trusted Badge')
                            ->default(false),
                    ]),
                DeleteAction::make(),
            ]);
    }

    protected function getViewData(): array
    {
        $pakets = Paket::withCount([
            'pembayarans' => function ($q) {
                $q->where('status', 'success');
            }
        ])->get();

        $totalPendapatan = 0;
        $totalAktif = 0;

        foreach ($pakets as $p) {
            $subscriberCount = $p->pembayarans_count;
            $pendapatan = $p->price * $subscriberCount;
            $totalPendapatan += $pendapatan;
            if ($p->aktif) $totalAktif++;
        }

        $subs = Pembayaran::with(['user', 'paket', 'misi'])->latest()->get();
        $subscriberList = [];
        $totalSubs = 0;

        foreach ($subs as $s) {
            if (!$s->user || !$s->paket)
                continue;

            $nama = $s->user->name ?? 'User Unknown';
            $inisial = strtoupper(substr($nama, 0, 2));

            $colors = [
                'from-blue-500 to-cyan-400',
                'from-emerald-500 to-teal-400',
                'from-violet-500 to-purple-400',
                'from-orange-500 to-amber-400',
                'from-rose-500 to-pink-400',
                'from-sky-500 to-cyan-400'
            ];
            $color = $colors[crc32($nama) % count($colors)];

            $statusStr = 'Aktif';
            if ($s->status === 'pending')
                $statusStr = 'Review';
            else if ($s->status === 'failed' || $s->status === 'refund')
                $statusStr = 'Selesai';

            if ($s->status === 'success')
                $totalSubs++;

            $subscriberList[] = [
                'nama' => $nama,
                'inisial' => $inisial,
                'avatarColor' => $color,
                'paket' => $s->paket->name,
                'kampanye' => $s->misi ? $s->misi->name : 'N/A',
                'status' => $statusStr,
                'tanggal' => $s->created_at->format('j M Y'),
            ];
        }

        return [
            'statTotalPaket' => count($pakets),
            'statPaketAktif' => $totalAktif,
            'statTotalSubscriber' => $totalSubs,
            'statPendapatan' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
            'subscriberList' => $subscriberList,
        ];
    }
}