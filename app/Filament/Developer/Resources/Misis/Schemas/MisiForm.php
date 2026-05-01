<?php

namespace App\Filament\Developer\Resources\Misis\Schemas;

use App\Models\Paket;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class MisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // ══════════════════════════════════════════════
                    //  STEP 1 — Upload Misi
                    // ══════════════════════════════════════════════
                    Step::make('Upload Misi')
                        ->icon('heroicon-o-document-text')
                        ->description('Lengkapi informasi aplikasi yang ingin ditest')
                        ->schema([
                            Section::make()
                                ->schema([
                                    TextInput::make('nama_aplikasi')
                                        ->label('Nama Aplikasi')
                                        ->placeholder('Contoh: My Awesome App')
                                        ->required()
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                    FileUpload::make('logo')
                                        ->label('Logo Aplikasi')
                                        ->disk('public')
                                        ->directory('logos')
                                        ->image()
                                        ->imageEditor()
                                        ->circleCropper()
                                        ->required()
                                        ->columnSpanFull(),

                                    Hidden::make('link_aplikasi')
                                        ->default('-'),

                                    RichEditor::make('instruksi')
                                        ->label('Instruksi untuk Tester')
                                        ->placeholder('Tuliskan langkah-langkah detail pengetesan di sini...')
                                        ->toolbarButtons([
                                            'bold',
                                            'italic',
                                            'link',
                                            'h2',
                                            'h3',
                                            'bulletList',
                                            'orderedList',
                                            'blockquote',
                                            'undo',
                                            'redo',
                                        ])
                                        ->columnSpanFull(),

                                    Hidden::make('kapasitas')
                                        ->default(0),

                                    Hidden::make('point')
                                        ->default(0)
                                        ->live(),
                                ]),
                        ]),

                    // ══════════════════════════════════════════════
                    //  STEP 2 — Pilih Package
                    // ══════════════════════════════════════════════
                    Step::make('Pilih Package')
                        ->icon('heroicon-o-squares-2x2')
                        ->description('Pilih paket yang sesuai kebutuhanmu')
                        ->hiddenOn('edit')
                        ->schema([
                            Section::make()
                                ->schema([
                                    Hidden::make('id_paket')
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            if ($state) {
                                                $paket = Paket::find($state);
                                                $set('point', $paket?->point ?? 0);
                                            }
                                        }),

                                    View::make('filament.developer.components.package-selection')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // ══════════════════════════════════════════════
                    //  STEP 3 — Pembayaran
                    // ══════════════════════════════════════════════
                    Step::make('Pembayaran')
                        ->icon('heroicon-o-banknotes')
                        ->description('Upload bukti pembayaran untuk mengaktifkan misi')
                        ->hiddenOn('edit')
                        ->schema([
                            Grid::make(3)
                                ->schema([

                                    // ── Kolom Kiri: Instruksi + Upload ──────────
                                    Section::make('Upload Bukti Pembayaran')
                                        ->icon('heroicon-o-arrow-up-tray')
                                        ->description('Transfer ke salah satu rekening di bawah, lalu upload buktiya')
                                        ->schema([

                                            // Info rekening (static display)
                                            View::make('filament.developer.components.payment-accounts')
                                                ->columnSpanFull(),

                                            FileUpload::make('pembayaran_image')
                                                ->label('Bukti Transfer')
                                                ->disk('public')
                                                ->directory('bukti-pembayaran')
                                                ->image()
                                                ->imagePreviewHeight('180')
                                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                                                ->maxSize(5120)
                                                ->required()
                                                ->helperText('Upload screenshot transfer (PNG / JPG / WebP, maks 5MB)')
                                                ->columnSpanFull()
                                                ->panelLayout('compact'),
                                        ])
                                        ->columnSpan(2),

                                    // ── Kolom Kanan: Ringkasan ──────────────────
                                    Section::make('Ringkasan')
                                        ->icon('heroicon-o-receipt-percent')
                                        ->schema([
                                            View::make('filament.developer.components.payment-summary')
                                                ->columnSpanFull(),
                                        ])
                                        ->columnSpan(1),
                                ]),
                        ]),

                ])
                    ->submitAction(view('filament.developer.components.wizard-submit-button'))
                    ->skippable(false)
                    ->columnSpanFull(),
            ]);
    }
}