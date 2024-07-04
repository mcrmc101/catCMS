<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use RalphJSmit\Filament\SEO\SEO;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page info')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)->live()
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    Forms\Components\Hidden::make('slug'),
                    Select::make('published')->options([
                        true => 'Yes',
                        false => 'No'
                    ]),
                    Select::make('page_category_id')->relationship(name: 'category', titleAttribute: 'name')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)->live()
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            Forms\Components\Hidden::make('slug'),
                        ]),
                    Select::make('menu_item_id')->relationship(name: 'menuItem', titleAttribute: 'name')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('order')
                                ->required()
                                ->numeric(),

                        ])
                ])->columns(2),
                Forms\Components\Section::make('Page Content')->schema([
                    Forms\Components\Builder::make('content')->blocks([
                        Forms\Components\Builder\Block::make('Text Editor')
                            ->schema([
                                Forms\Components\RichEditor::make('content-block')
                            ]),
                        Forms\Components\Builder\Block::make('Image Block')
                            ->schema([
                                Forms\Components\Repeater::make('Blocks')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->required()
                                            ->imageEditor(),
                                        TextInput::make('alt')
                                            ->label('Alt text')
                                            ->required(),
                                        RichEditor::make('text-content')->label('Content')
                                            ->disableToolbarButtons([
                                                'attachFiles',
                                            ]),
                                        TextInput::make('link')->label('Link')->url()
                                    ])->addActionLabel('Add a new Image block')
                            ]),
                        Forms\Components\Builder\Block::make('Carousel')
                            ->schema([
                                Forms\Components\Repeater::make('Tiles')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->required()->imageEditor(),
                                        RichEditor::make('Text')->disableToolbarButtons([
                                            'attachFiles',
                                        ]),
                                    ])->addActionLabel('Add a new carousel tile')
                            ]),
                        Forms\Components\Builder\Block::make('Contact Form')
                            ->schema([])
                    ])->addActionLabel('Add a new block')->collapsed(),
                ]),
                Forms\Components\Section::make('Page info')->schema([
                    SEO::make(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultGroup('category.name')->groups([
                'category.name',
                'menuItem.name'
            ]);;
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
