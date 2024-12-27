<?php

namespace App\Filament\Resources;

use App\Models\Tim;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Saksi;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Manajemen User';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 7;

    protected static ?string $label = 'Manajemen User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('roles')
                    ->label('Roles')
                    ->relationship('roles', 'name')
                    ->options(function(){
                        $currentUser = auth()->user();
                        //jika user yang login adalah admin batasi pilihan 'super_admin'
                        if($currentUser && $currentUser->hasRole('Admin')){
                            return Role::where('name','!=', 'super_admin')->pluck('name', 'id');
                        }

                        //jika user yang login adalah super_admin
                        return Role::pluck('name', 'id');
                    })
                    ->multiple()
                    ->maxItems(1)
                    ->preload()
                    ->live()
                    ->searchable(),
                Hidden::make('role'),
                Select::make('id_model')
                    ->searchable()
                    ->hidden(
                        fn($record, $get) => Role::query()
                            // ->where(['id' => $get('roles'),'name' => 'super_admin'])->exists()
                            ->where('id', $get('roles'))
                            ->whereIn('name', ['super_admin','Admin'])
                            ->exists()
                        )

                    ->options(function (Get $get) {
                        $nameRole = Role::query()->where('id', $get('roles'))->first();
                        $collection = collect($nameRole);
                        // dd($collection);
                        if ($collection->contains('Tim_kecamatan')) {
                            return Tim::query()->get()->pluck('nama', 'id');
                        }elseif($collection->contains('Saksi')){
                            return Saksi::query()->get()->pluck('nama_saksi', 'id');
                        }

                    })
                    ->default(fn ($record) => $record ? $record->id_model : null)
                    ->preload(),
                TextInput::make('name')
                    ->label('Nama User')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(fn (string $context):bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image('jpeg', 'png', 'jpg')
                    ->directory('foto_profil')
                    ->maxSize('1024'),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $is_super_admin = auth()->user()->hasRole('super_admin');
                $is_admin = auth()->user()->hasRole('Admin');
                // $is_guru = Auth::user()->hasRole('Guru');
                // $is_siswa = Auth::user()->hasRole('Siswa');

                if($is_admin){
                    $query->whereHas('roles', function ($query) {
                        $query->where('name', '!=', 'super_admin');
                    });
                }

            })
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->rounded()
                    ->size(50),
                TextColumn::make('nomor_urut')
                ->label('No')
                ->getStateUsing(static function (User $record, Table $table) {
                    return $table->getRecords()->search($record) + 1;
                }),
                TextColumn::make('name')
                    ->label('Nama User')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Level')
                    ->badge()
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
