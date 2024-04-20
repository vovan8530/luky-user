<?php

namespace App\DTO;

use AllowDynamicProperties;
use App\Helpers\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;

#[AllowDynamicProperties]
class UserDto implements Arrayable
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var int
     */
    protected int $phone;

    /**
     * @var string
     */
    protected string $link_page_a;

    /**
     * @var bool
     */
    protected bool $is_active;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string|null
     */
    protected ?string $password;

    /**
     * UserDto constructor.
     *
     * @param  string  $name
     * @param  int  $phone
     * @param  string  $linkPageA
     * @param  bool  $isActive
     * @param  string  $email
     * @param  string  $password
     */
    public function __construct(
        string $name,
        int $phone,
        string $linkPageA,
        bool $isActive,
        string $email,
        string $password,

    ) {
        $this->name = $name;
        $this->phone = $phone;
        $this->linkPageA = $linkPageA;
        $this->isActive = $isActive;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getLinkPageA(): string
    {
        return $this->linkPageA;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'link_page_a' => $this->linkPageA,
            'is_active' => $this->isActive,
            'email' => $this->email,
            'password' => $this->password,

        ];
    }

    /**
     * @param  array  $attributes
     * @return UserDto
     */
    public static function createFromArray(array $attributes): self
    {
        return new self(
            (string) ArrayHelper::getNotEmptyValue($attributes, 'name'),
            (int) ArrayHelper::getNotEmptyValue($attributes, 'phone'),
            (string) ArrayHelper::getNotEmptyValue($attributes, 'link_page_a'),
            (bool) ArrayHelper::getNotEmptyValue($attributes, 'is_active', true),
            ((string) ArrayHelper::getNotEmptyValue($attributes, 'email')),
            (string) ArrayHelper::getNotEmptyValue($attributes, 'password'),
        );
    }
}

