<?php

namespace Database\Factories;

use App\Models\News;
use App\Modules\Core\ORM\Enums\NewsStatusEnum;
use Faker\Generator;
use Faker\Provider\en_US\Text;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ruText = (new Text(new Generator()));
        $id     = Uuid::uuid4();

        return [
            'id'                => $id,
            'url'               => route('news_get_one', [$id]),
            'title'             => $ruText->realText(50),
            'short_description' => $ruText->realText(100),
            'text'              => $ruText->realText(2000),
            'status'            => NewsStatusEnum::ACTIVE->value,
        ];
    }
}
