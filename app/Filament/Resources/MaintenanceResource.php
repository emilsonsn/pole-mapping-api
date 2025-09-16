<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Str;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $modelLabel = 'Manutenção';
    protected static ?string $pluralModelLabel = 'Manutenções';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->label('Usuário')->relationship('user', 'name')->searchable()->required(),
                Forms\Components\Select::make('pole_id')
                    ->label('Poste')
                    ->relationship('pole', 'address')
                    ->searchable()
                    ->required(),
                Forms\Components\Fieldset::make('Localização')->schema([
                    Forms\Components\TextInput::make('latitude')->label('Latitude')->numeric(),
                    Forms\Components\TextInput::make('longitude')->label('Longitude')->numeric(),
                    Forms\Components\TextInput::make('address')->label('Endereço')->maxLength(255),
                    Forms\Components\TextInput::make('neighborhood')->label('Bairro')->maxLength(255),
                    Forms\Components\TextInput::make('city')->label('Cidade')->maxLength(255),
                ])->columns(5),
                Forms\Components\View::make('forms.components.image-preview')
                    ->label('Foto')
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Usuário')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pole.address')
                    ->label('Poste')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('photo_path')->label('Foto')->getStateUsing(fn (Maintenance $r) => $r->photo_path)->circular(),
                Tables\Columns\TextColumn::make('city')->label('Cidade')->searchable(),
                Tables\Columns\TextColumn::make('neighborhood')->label('Bairro')->searchable(),
                Tables\Columns\TextColumn::make('address')->label('Endereço')->searchable(),
                Tables\Columns\TextColumn::make('latitude')->label('Latitude')->sortable(),
                Tables\Columns\TextColumn::make('longitude')->label('Longitude')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Criado em')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Atualizado em')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Action::make('export_csv')
                    ->label('Exportar CSV (My Maps)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        $rows = Maintenance::query()->select(['id','latitude','longitude','address','neighborhood','city'])->get();
                        $filename = 'manutencoes-'.now()->format('Ymd-His').'.csv';
                        return response()->streamDownload(function () use ($rows) {
                            $out = fopen('php://output', 'w');
                            fputcsv($out, ['name','latitude','longitude','address','neighborhood','city']);
                            foreach ($rows as $r) fputcsv($out, ["Manutenção {$r->id}", $r->latitude, $r->longitude, $r->address, $r->neighborhood, $r->city]);
                            fclose($out);
                        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
                    }),
                Action::make('export_kml')
                    ->label('Exportar KML (Google Earth)')
                    ->icon('heroicon-o-map')
                    ->action(function () {
                        $rows = Maintenance::query()->select(['id','latitude','longitude','address','neighborhood','city'])->get();
                        $filename = 'manutencoes-'.now()->format('Ymd-His').'.kml';
                        $head = '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document><name>Manutenções</name>';
                        $foot = '</Document></kml>';
                        $body = '';
                        foreach ($rows as $r) {
                            $name = 'Manutenção '.$r->id;
                            $desc = htmlspecialchars(trim(($r->address ? $r->address.', ' : '').($r->neighborhood ? $r->neighborhood.', ' : '').($r->city ?? '')), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                            $body .= "<Placemark><name>{$name}</name><description>{$desc}</description><Point><coordinates>{$r->longitude},{$r->latitude},0</coordinates></Point></Placemark>";
                        }
                        $xml = $head.$body.$foot;
                        return response()->streamDownload(fn() => print $xml, $filename, ['Content-Type' => 'application/vnd.google-earth.kml+xml; charset=UTF-8']);
                    }),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Ver'),
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\DeleteAction::make()->label('Excluir'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Excluir selecionados'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenances::route('/'),
            'create' => Pages\CreateMaintenance::route('/create'),
            'edit' => Pages\EditMaintenance::route('/{record}/edit'),
        ];
    }
}
