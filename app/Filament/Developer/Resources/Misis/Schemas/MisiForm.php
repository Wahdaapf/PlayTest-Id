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
use Filament\Forms\Components\Select;

class MisiForm
{
    public static function configure(Schema $schema): Schema
    {
        $uploadMisiSchema = [
            View::make('filament.developer.components.upload-misi')
                ->schema([
                    TextInput::make('nama_aplikasi')
                        ->label(__('Nama Aplikasi'))
                        ->placeholder(__('Contoh: Aplikasi Kerenku'))
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    FileUpload::make('logo')
                        ->label(__('Logo Aplikasi'))
                        ->disk('public')
                        ->directory('logos')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->required()
                        ->columnSpanFull(),

                    RichEditor::make('instruksi')
                        ->label(__('Instruksi untuk Penguji'))
                        ->placeholder(__('Tuliskan langkah-langkah detail pengujian di sini...'))
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
                ])
                ->columnSpanFull(),

            Hidden::make('link_aplikasi')
                ->default('-'),

            Hidden::make('kapasitas')
                ->default(0),

            Hidden::make('point')
                ->default(0)
                ->live(),
        ];

        if ($schema->getOperation() === 'edit') {
            return $schema->components($uploadMisiSchema);
        }

        return $schema
            ->components([
                Wizard::make([

                    // ══════════════════════════════════════════════
                    //  STEP 1 — Upload Misi
                    // ══════════════════════════════════════════════
                    Step::make(__('Unggah Aplikasi'))
                        ->icon('heroicon-o-document-text')
                        ->schema($uploadMisiSchema),

                    // ══════════════════════════════════════════════
                    //  STEP 2 — Pilih Package
                    // ══════════════════════════════════════════════
                    Step::make(__('Pilih Paket'))
                        ->icon('heroicon-o-squares-2x2')
                        ->hiddenOn('edit')
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

                    // ══════════════════════════════════════════════
                    //  STEP 3 — Pembayaran
                    // ══════════════════════════════════════════════
                    Step::make(__('Lakukan Pembayaran'))
                        ->icon('heroicon-o-banknotes')
                        ->hiddenOn('edit')
                        ->schema([
                            Grid::make(3)
                                ->schema([

                                    // ── Kolom Kiri: Info Duitku ──────────
                                    Hidden::make('payment_method')
                                        ->required(),

                                    View::make('filament.developer.components.payment-methods')
                                        ->columnSpan(2),

                                    // ── Kolom Kanan: Ringkasan ──────────────────
                                    View::make('filament.developer.components.payment-summary')
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
