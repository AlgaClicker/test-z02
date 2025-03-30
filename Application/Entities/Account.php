<?php
namespace Application\Entities;

//use Illuminate\Foundation\Auth\User as Authenticatable;

use Ramsey\Uuid\Uuid;
final class Account extends AbstractEntity
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
     * @var string Токен аккаунта
     */
    private string $token;

    /**
     * Account constructor.
     *
     * @param string $email
     * @param string|null $fullName
     * @param string|null $id Если не передано, генерируется новый UUID
     */
    public function __construct(?string $email=null, ?string $fullName = null, ?string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->email = $email?? "";
        $this->fullName = $fullName ?? "";
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
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * Получить  Токен аккаунта.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Установить Токен аккаунта.
     *
     * @param string $token
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
