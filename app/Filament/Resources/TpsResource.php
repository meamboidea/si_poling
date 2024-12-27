<?php

namespace App\Filament\Resources;

use App\Models\Tps;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TpsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TpsResource\RelationManagers;

class TpsResource extends Resource
{
    protected static ?string $model = Tps::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_tps')
                    ->required()
                    ->maxLength(255),
                Select::make('kecamatan_id')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->required(),
                Select::make('desa_id')
                    ->relationship('desa', 'nama_desa')
                    ->required(),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                TextInput::make('pemilih_lk')
                    ->label('Pemilih Laki-laki')
                    ->numeric(),
                TextInput::make('pemilih_pr')
                    ->label('Pemilih Perempuan')
                    ->numeric(),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('nama_tps', 'asc')
            // ->defaultSort('kecamatan_id', 'asc')
            // ->defaultSort('desa_id', 'asc')
            ->modifyQueryUsing(function (Builder $query) {
                $query->orderBy('kecamatan_id', 'asc')
                    ->orderBy('desa_id', 'asc');
            })
            ->columns([
                TextColumn::make('kecamatan.nama_kecamatan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('desa.nama_desa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nama_tps')
                    ->searchable(),
                TextColumn::make('alamat')
                    ->searchable(),
                TextColumn::make('pemilih_lk')
                    ->label('Jumlah Pemilih')
                    ->formatStateUsing(function ($record) {
                        $totalPemilih = $record->pemilih_lk + $record->pemilih_pr;
                        return $totalPemilih;
                    })
                    ->description(function ($record) {
                        return 'LK :' . $record->pemilih_lk . ' -  PR :' . $record->pemilih_pr;
                    }),
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
            'index' => Pages\ListTps::route('/'),
            'create' => Pages\CreateTps::route('/create'),
            'edit' => Pages\EditTps::route('/{record}/edit'),
        ];
    }
}
