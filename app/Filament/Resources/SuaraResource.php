<?php

namespace App\Filament\Resources;

use App\Models\Tps;
use Filament\Forms;
use Filament\Tables;
use App\Models\Saksi;
use App\Models\Suara;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Widgets\FotoCalonWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuaraResource\Pages;
use App\Filament\Widgets\RekapitulasiSuaraChart;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuaraResource\RelationManagers;

class SuaraResource extends Resource
{
    protected static ?string $model = Suara::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('calon_id')
                    ->relationship('calon', 'id')
                    ->required(),
                Forms\Components\Select::make('tps_id')
                    ->options(Tps::with('desa')->get()->pluck('nama_tps', 'id')->map(function ($nama_tps, $id) {
                        $desa_nama = Tps::find($id)->desa->nama_desa ?? 'Desa Tidak Ditemukan';
                        return $nama_tps . ' - ' . $desa_nama; // Menampilkan nama TPS dan nama Desa
                    }))
                    ->live()
                    ->searchable()
                    ->afterStateUpdated(function (Set $set) {
                        $set('saksi_id', null);
                    })
                    ->required(),
                Forms\Components\TextInput::make('jumlah_suara')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('saksi_id')
                    ->options( fn (Get $get) => $get('tps_id') ? Saksi::where('tps_id', $get('tps_id'))->pluck('nama_saksi', 'id') : [])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calon.nomor_urut')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps.desa.nama_desa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps.kecamatan.nama_kecamatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps.nama_tps')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saksi.nama_saksi')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuaras::route('/'),
            'create' => Pages\CreateSuara::route('/create'),
            'edit' => Pages\EditSuara::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FotoCalonWidget::class,
            RekapitulasiSuaraChart::class,
        ];
    }
}
