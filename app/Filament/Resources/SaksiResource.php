<?php

namespace App\Filament\Resources;

use App\Models\Tps;
use Filament\Forms;
use App\Models\Desa;
use Filament\Tables;
use App\Models\Saksi;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SaksiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SaksiResource\RelationManagers;

class SaksiResource extends Resource
{
    protected static ?string $model = Saksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $navigationLabel = 'Data Saksi';

    protected static ?string $navigationGroup = 'Manajemen TIM';

    protected static ?string $label = 'Data Saksi';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_saksi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('foto')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Select::make('kecamatan_id')
                    // ->relationship('kecamatan', 'nama_kecamatan')
                    ->options(Kecamatan::pluck('nama_kecamatan', 'id'))
                    ->live()
                    ->searchable()
                    ->afterStateUpdated(function (Set $set) {
                        $set('desa_id', null);
                    })
                    ->required(),
                Forms\Components\Select::make('desa_id')
                    ->options( fn(Get $get) => $get('kecamatan_id') ? Desa::where('kecamatan_id', $get('kecamatan_id'))->pluck('nama_desa', 'id') : [])
                    ->live()
                    ->searchable()
                    ->afterStateUpdated(function (Set $set) {
                        $set('tps_id', null);
                    })
                    ->required(),
                Forms\Components\Select::make('tps_id')
                    ->options( fn(Get $get) => $get('desa_id') ? Tps::where('desa_id', $get('desa_id'))->pluck('nama_tps', 'id') : [])
                    ->live()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('tim_id')
                    ->relationship('tim', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                    $query->orderBy('kecamatan_id', 'asc')
                        ->orderBy('desa_id', 'asc')
                        ->orderBy('tps_id', 'asc');
                })
            ->columns([
                Tables\Columns\TextColumn::make('nama_saksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
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
            'index' => Pages\ListSaksis::route('/'),
            'create' => Pages\CreateSaksi::route('/create'),
            'edit' => Pages\EditSaksi::route('/{record}/edit'),
        ];
    }
}
