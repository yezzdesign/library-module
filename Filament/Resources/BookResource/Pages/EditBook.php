<?php

namespace Modules\Library\Filament\Resources\BookResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Library\Filament\Resources\BookResource;

class EditBook extends EditRecord
{
    protected static string $resource = BookResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
