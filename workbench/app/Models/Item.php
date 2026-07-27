<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Workbench\App\Enums\ItemStatus;
use Workbench\Database\Factories\ItemFactory;

/**
 * A record with two selectable icon states, for exercising `IconSelectColumn`
 * with both an enum and a plain options array.
 */
class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => ItemStatus::class,
        ];
    }

    protected static function newFactory(): ItemFactory
    {
        return ItemFactory::new();
    }
}
