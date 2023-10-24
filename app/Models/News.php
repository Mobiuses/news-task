<?php

declare(strict_types=1);

namespace App\Models;

use App\Modules\Core\ORM\Enums\NewsStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasUuids;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'url',
        'short_description',
        'text',
        'status',
    ];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->short_description;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at->toDateTimeString();
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === NewsStatusEnum::ACTIVE->value;
    }

    /**
     * @return $this
     */
    public function setActive(): self
    {
        $this->status = NewsStatusEnum::ACTIVE->value;

        return $this;
    }

    /**
     * @return $this
     */
    public function setInActive(): self
    {
        $this->status = NewsStatusEnum::IN_ACTIVE->value;

        return $this;
    }
}
