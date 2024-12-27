<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Calon;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CalonResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CalonResource\RelationManagers;

class CalonResource extends Resource
{
    protected static ?string $model = Calon::class;

    protected static ?string $navigationLabel = 'Data Pasangan Calon';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $label = 'Data Pasangan Calon';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_calon_bupati')
                    ->label('Nama Calon Bupati')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nama_calon_wakil_bupati')
                    ->label('Nama Calon Wakil Bupati')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->required()
                    ->numeric(),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('calon')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->rounded()
                    ->searchable(),
                TextColumn::make('nama_calon_bupati')
                    ->searchable(),
                TextColumn::make('nama_calon_wakil_bupati')
                    ->searchable(),
                TextColumn::make('nomor_urut')
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
            'index' => Pages\ListCalons::route('/'),
            'create' => Pages\CreateCalon::route('/create'),
            'edit' => Pages\EditCalon::route('/{record}/edit'),
        ];
    }
}
