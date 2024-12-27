<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimResource\Pages;
use App\Filament\Resources\TimResource\RelationManagers;
use App\Models\Tim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimResource extends Resource
{
    protected static ?string $model = Tim::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $navigationLabel = 'Data Tim';

    protected static ?string $navigationGroup = 'Manajemen TIM';

    protected static ?string $label = 'Data Tim';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kecamatan_id')
                    ->relationship('kecamatan', 'nama_kecamatan')
                    ->required(),
                Forms\Components\Select::make('desa_id')
                    ->relationship('desa', 'nama_desa'),
                Forms\Components\Select::make('jabatantim_id')
                    ->relationship('jabatantim', 'nama_jabatan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('nama', 'asc')
            ->defaultSort('kecamatan_id', 'asc')
            ->defaultSort('jabatantim_id', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan.nama_kecamatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('desa.nama_desa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jabatantim.nama_jabatan')
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
            'index' => Pages\ListTims::route('/'),
            'create' => Pages\CreateTim::route('/create'),
            'edit' => Pages\EditTim::route('/{record}/edit'),
        ];
    }
}
