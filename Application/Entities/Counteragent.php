<?php
namespace Application\Entities;
use Ramsey\Uuid\Uuid;

class Counteragent {
    public function __construct(
        ?string $inn = null,
        ?string $name = null,
        ?string $address = null,
        ?string $id = null,
        ?string $ogrn = null,
    ){
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->inn = $inn ?? null;
        $this->name = $name ?? null;
        $this->ogrn = $ogrn ?? null;
        $this->address = $address ?? null;
    }
    private string $id;
    private string $inn;
    private string $name;
    private string $ogrn;
    private string $address;

    /**
     * Получить UUID идентификатор контрагента.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Получить ИНН контрагента.
     *
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * Получить наименование контрагента.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Получить ОГРН контрагента.
     *
     * @return string
     */
    public function getOgrn(): string
    {
        return $this->ogrn;
    }

    /**
     * Получить адрес контрагента.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Установить наименование контрагента.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Установить ОГРН контрагента.
     *
     * @param string $ogrn
     * @return void
     */
    public function setOgrn(string $ogrn): void
    {
        $this->ogrn = $ogrn;
    }

    /**
     * Установить адрес контрагента.
     *
     * @param string $address
     * @return void
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}

