<?php

namespace Modules\Library\Filament\Resources;

//use App\Filament\Resources\BookResource\Pages;
//use App\Filament\Resources\BookResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\Library\Entities\Book;
use Modules\Library\Filament\Resources\BookResource\RelationManagers\LinksRelationManager;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class BookResource extends Resource
{

    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $slug = 'book';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Heading')
                    ->columnSpanFull()
                ->tabs([

                    Tabs\Tab::make(__('library::index.filament.form.tab1.label'))
                    ->columnSpanFull()
                    ->schema([

                        Section::make(__('library::index.filament.form.tab1.section.label'))
                            ->description(__('library::index.filament.form.tab1.section.description'))
                            ->compact()
                            ->columnSpanFull()
                            ->aside()
                            ->schema([

                                TextInput::make('title')
                                    ->label(__('library::index.filament.form.title.label'))
                                    ->required(),

                                TextInput::make('author')
                                    ->label(__('library::index.filament.form.author.label'))
                                    ->datalist(fn(Book $record) => $record::all()->pluck('author', 'author')),

                                //TextInput::make('author')
                                //    ->label(__('library::index.filament.form.author.label')),
                            ]),

                        Section::make(__('library::index.filament.form.tab1.section2.label'))
                            ->description(__('library::index.filament.form.tab1.section2.description'))
                            ->compact()
                            ->columnSpanFull()
                            ->aside()
                            ->schema([

                                Toggle::make('active_state')
                                    ->label(__('library::index.filament.form.active_state.label')),
                            ]),
                    ]),

                    Tabs\Tab::make(__('library::index.filament.form.tab2.label'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('Cover')
                            ->image()
                            ->collection('book_cover')
                            ->conversion('full')
                            ->columnSpanFull()
                    ]),

                    Tabs\Tab::make(__('library::index.filament.form.tab3.label'))
                    ->schema([
                        TinyEditor::make('blurb')
                            ->label(__('library::index.filament.form.tab3.blurb.label'))
                            ->simple(),

                        DatePicker::make('read_date')
                            ->label(__('library::index.filament.form.tab3.read_date.label')),

                        TextInput::make('pages')
                            ->integer()
                            ->label(__('library::index.filament.form.tab3.pages.label')),

                        TextInput::make('publisher')
                            ->label(__('library::index.filament.form.publisher.label'))
                            ->datalist(fn(Book $record) => $record::all()->pluck('publisher', 'publisher')),

                        TextInput::make('genre')
                            ->label(__('library::index.filament.form.genre.label'))
                            ->datalist(fn(Book $record) => $record::all()->pluck('genre', 'genre')),


                    ])
                ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('library::index.filament.table.id.label'))
                    ->sortable(),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('Cover')
                    ->label(__('library::index.filament.table.cover.label'))
                    ->collection('book_cover')
                    ->conversion('thumb')
                    ->width(60)
                    ->height(60),

                Tables\Columns\IconColumn::make('active_state')
                    ->label(__('library::index.filament.table.active_state.label'))
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('library::index.filament.table.author.label'))
                    ->description( fn(Book $record) :string => $record->author )
                    ->limit(40)
                    ->searchable(['author', 'title'])
                    ->sortable(),

                Tables\Columns\TextColumn::make('read_date')
                    ->label(__('library::index.filament.table.read_date.label'))
                    ->dateTime('j M, Y')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\Library\Filament\Resources\BookResource\Pages\ListBooks::route('/'),
            'create' => \Modules\Library\Filament\Resources\BookResource\Pages\CreateBook::route('/create'),
            'edit' => \Modules\Library\Filament\Resources\BookResource\Pages\EditBook::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('library::index.filament.title.book_settings');
    }

    protected static function getNavigationLabel(): string
    {
        return __('library::index.filament.label.book_settings');
    }

    public static function getBreadcrumb(): string
    {
        return __('library::index.filament.label.book_settings');
    }

    public static function getModelLabel(): string
    {
        return __('library::index.filament.label.model_label');
    }
}
