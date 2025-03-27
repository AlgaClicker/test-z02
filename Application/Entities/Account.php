<?php
namespace Application\Entities;


use Ramsey\Uuid\Uuid;
class Account
{
    /**
     * @var string UUID
     */
    private string $id;

    /**
     * @var string Email аккаунта
     */
    private string $email;

    /**
     * @var string ФИО аккаунта
     */
    private string $fullName;

    /**
     * Account constructor.
     *
     * @param string $email
     * @param string $fullName
     * @param string|null $id Если не передано, генерируется новый UUID
     */
    public function __construct(string $email, ?string $fullName = null, ?string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->email = $email;
        $this->fullName = $fullName ?? null;
    }

    /**
     * Получить идентификатор аккаунта.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получить email аккаунта.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Установить email аккаунта.
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Получить ФИО аккаунта.
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * Установить ФИО аккаунта.
     *
     * @param string $fullName
     * @return void
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }
}
