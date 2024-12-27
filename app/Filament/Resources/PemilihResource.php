<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemilihResource\Pages;
use App\Filament\Resources\PemilihResource\RelationManagers;
use App\Models\Pemilih;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PemilihResource extends Resource
{
    protected static ?string $model = Pemilih::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pemilih')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('jk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('agama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pekerjaan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('suku')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Select::make('kecamatan_id')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->required(),
                Forms\Components\Select::make('desa_id')
                    ->relationship('desa', 'nama_desa')
                    ->required(),
                Forms\Components\Select::make('tps_id')
                    ->relationship('tps', 'nama_tps'),
                Forms\Components\Select::make('tim_id')
                    ->relationship('tim', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->defaultSort('kecamatan_id', 'asc')
            // ->defaultSort('kecamatan_id', 'asc')
            // ->defaultSort('desa_id', 'asc')
            ->modifyQueryUsing(function (Builder $query) {
                $query->orderBy('kecamatan_id', 'asc')
                    ->orderBy('desa_id', 'asc')
                    ->orderBy('tps_id', 'asc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('nama_pemilih')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pekerjaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('suku')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('desa.nama_desa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps.nama_tps')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tim.nama')
                    ->numeric()
                    ->sortable(),

            ])
            ->defaultSort('nama_pemilih', 'asc')
            ->defaultSort('kecamatan_id', 'asc')
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
            'index' => Pages\ListPemilihs::route('/'),
            'create' => Pages\CreatePemilih::route('/create'),
            'edit' => Pages\EditPemilih::route('/{record}/edit'),
        ];
    }
}
