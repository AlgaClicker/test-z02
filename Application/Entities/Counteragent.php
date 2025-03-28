<?php
namespace Application\Entities;
use Ramsey\Uuid\Uuid;

class Counteragent {

    private string $id;
    private int $inn;
    private string $name;
    private string $ogrn;
    private string $address;

    public function __construct(
        ?int $inn = null,
        ?string $name = null,
        ?string $address = null,
        ?string $id = null,
        ?string $ogrn = null,
    ){
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->inn = $inn ?? 0;
        $this->name = $name ?? "";
        $this->ogrn = $ogrn ?? "";
        $this->address = $address ?? "";
    }


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
     * Установить ИНН контрагента.
     *
     * @param string $ogrn
     * @return void
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
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

    /**
     * Установить ID контрагента.s
     *
     * @param string $ogrn
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}

