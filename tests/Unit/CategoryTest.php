<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Category;
use App\Models\RecycledObject;
use App\Models\User;

class CategoryTest extends TestCase
{
    /**
     * Test Category model Entity Scope.
     *
     * @return void
     */
    public function testCategoryEntityScope()
    {
        $user = factory(User::class)->create();
        $user->entity_id = 2;
        $user->save();

        $this->be($user);

        $category = Category::new(
            $this->faker->word,
            $this->faker->randomElement(
                array_keys(config('ifrs')['accounts'])
            )
        );
        $category->save();

        $this->assertEquals(count(Category::all()), 1);

        $this->be(User::withoutGlobalScopes()->find(1));
        $this->assertEquals(count(Category::all()), 0);
    }

    /**
     * Test Category Model recylcling
     *
     * @return void
     */
    public function testCategoryRecycling()
    {
        $category = Category::new(
            $this->faker->word,
            $this->faker->randomElement(
                array_keys(config('ifrs')['accounts'])
            )
        );
        $category->save();

        $recycled = RecycledObject::all()->first();
        $this->assertEquals($category->recycled->first(), $recycled);
    }
}
