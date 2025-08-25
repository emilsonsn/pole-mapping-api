<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoleResource\Pages;
use App\Filament\Resources\PoleResource\RelationManagers;
use App\Models\Pole;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class PoleResource extends Resource
{
    protected static ?string $model = Pole::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Poste';
    protected static ?string $pluralModelLabel = 'Postes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuário')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('qrcode')
                    ->label('QR Code')
                    ->required()
                    ->readonly()
                    ->maxLength(255),

                Forms\Components\Fieldset::make('Localização')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Endereço')
                            ->maxLength(255)
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('neighborhood')
                            ->label('Bairro')
                            ->maxLength(255)
                            ->disabled()
                            ->required(),
                        Forms\Components\TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(255)
                            ->disabled()
                            ->required(),
                    ])->columns(5),

                Forms\Components\Select::make('type_id')
                    ->label('Tipo')
                    ->relationship('type', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('height')
                    ->label('Altura (m)')
                    ->numeric()
                    ->step('0.01')
                    ->required(),

                Forms\Components\TextInput::make('remote_management_relay')
                    ->label('Relê telegestão')
                    ->maxLength(255),

                Forms\Components\Select::make('paving_id')
                    ->label('Pavimentação')
                    ->relationship('paving', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('position_id')
                    ->label('Posição')
                    ->relationship('position', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('network_type_id')
                    ->label('Tipo de Rede')
                    ->relationship('networkType', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('connection_type_id')
                    ->label('Tipo de Conexão')
                    ->relationship('connectionType', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('transformer_id')
                    ->label('Transformador')
                    ->relationship('transformer', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('access_id')
                    ->label('Acesso')
                    ->relationship('access', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('luminaire_quantity')
                    ->label('Qtd. Iluminação')
                    ->options([1=>1,2=>2,3=>3,4=>4,5=>5])
                    ->required(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('qrcode')
                    ->label('QR Code')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitude')
                    ->sortable(),

                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitude')
                    ->sortable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Endereço')
                    ->searchable(),

                Tables\Columns\TextColumn::make('neighborhood')
                    ->label('Bairro')
                    ->searchable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type.name')
                    ->label('Tipo')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('height')
                    ->label('Altura (m)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('remote_management_relay')
                    ->label('Relê telegestão')
                    ->searchable(),

                Tables\Columns\TextColumn::make('paving.name')
                    ->label('Pavimentação')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('position.name')
                    ->label('Posição')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('networkType.name')
                    ->label('Tipo de Rede')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('connectionType.name')
                    ->label('Tipo de Conexão')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('transformer.name')
                    ->label('Transformador')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('access.name')
                    ->label('Acesso')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('luminaire_quantity')
                    ->label('Qtd. Iluminação')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Excluído em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
->headerActions([
                Action::make('export_csv')
                    ->label('Exportar CSV (My Maps)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () {
                        $poles = Pole::query()->select(['id','latitude','longitude','qrcode','address','neighborhood','city'])->get();
                        $filename = 'postes-'.now()->format('Ymd-His').'.csv';
                        return response()->streamDownload(function () use ($poles) {
                            $out = fopen('php://output', 'w');
                            fputcsv($out, ['name','latitude','longitude','address','neighborhood','city','qrcode']);
                            foreach ($poles as $p) {
                                fputcsv($out, ['Poste '.$p->id, $p->latitude, $p->longitude, $p->address, $p->neighborhood, $p->city, $p->qrcode]);
                            }
                            fclose($out);
                        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
                    }),
                Action::make('export_kml')
                    ->label('Exportar KML (Google Earth)')
                    ->icon('heroicon-o-map')
                    ->action(function () {
                        $poles = Pole::query()->select(['id','latitude','longitude','qrcode','address','neighborhood','city'])->get();
                        $filename = 'postes-'.now()->format('Ymd-His').'.kml';
                        $kmlHeader = '<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://www.opengis.net/kml/2.2"><Document><name>Postes</name>';
                        $kmlFooter = '</Document></kml>';
                        $placemarks = '';
                        foreach ($poles as $p) {
                            $name = 'Poste '.$p->id;
                            $desc = htmlspecialchars("QR: {$p->qrcode}\n{$p->address}, {$p->neighborhood}, {$p->city}", ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                            $placemarks .= "<Placemark><name>{$name}</name><description>{$desc}</description><Point><coordinates>{$p->longitude},{$p->latitude},0</coordinates></Point></Placemark>";
                        }
                        $content = $kmlHeader.$placemarks.$kmlFooter;
                        return response()->streamDownload(function () use ($content) {
                            echo $content;
                        }, $filename, ['Content-Type' => 'application/vnd.google-earth.kml+xml; charset=UTF-8']);
                    }),
            ])            
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar'),
                Tables\Actions\ViewAction::make()->label('Ver'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Excluir selecionados'),
                    Tables\Actions\RestoreBulkAction::make()->label('Restaurar selecionados'),
                    Tables\Actions\ForceDeleteBulkAction::make()->label('Excluir permanentemente'),
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
            'index' => Pages\ListPoles::route('/'),
            'create' => Pages\CreatePole::route('/create'),
            'edit' => Pages\EditPole::route('/{record}/edit'),
        ];
    }
}   