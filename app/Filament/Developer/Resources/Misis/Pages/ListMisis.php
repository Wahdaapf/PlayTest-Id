<?php

namespace App\Filament\Developer\Resources\Misis\Pages;

use App\Filament\Developer\Resources\Misis\MisiResource;
use App\Models\Misi;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMisis extends ListRecords
{
    protected static string $resource = MisiResource::class;

    public function getHeader(): ?\Illuminate\Contracts\View\View
    {
        return view('filament.developer.resources.misis.list-header', $this->getStats());
    }

    protected function getStats(): array
    {
        $misis = Misi::where('id_user', auth()->id())->get();
        
        return [
            'statTotal' => $misis->count(),
            'statRunning' => $misis->where('status', 'running')->count(),
            'statTesters' => \App\Models\MisiAnggota::whereIn('id_misi', $misis->pluck('id'))->count(),
            'statPoints' => $misis->sum('point'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}