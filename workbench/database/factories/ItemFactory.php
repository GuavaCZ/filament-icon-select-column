<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Workbench\App\Enums\ItemStatus;
use Workbench\App\Models\Item;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'status' => fake()->randomElement(ItemStatus::cases()),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
        ];
    }

    /** An item with neither state set, so the column's empty state is visible too. */
    public function withoutState(): static
    {
        return $this->state(fn (): array => ['status' => null, 'priority' => null]);
    }
}
