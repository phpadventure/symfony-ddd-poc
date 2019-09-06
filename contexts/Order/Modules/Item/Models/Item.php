<?php

namespace Contexts\Order\Modules\Item\Models;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Models\ArraySerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 * @ORM\Table("items")
 */
class Item implements ArraySerializable
{
    public const ID = 'id';
    public const NAME = 'name';
    public const PRICE = 'PRICE';
    public const DESCRIPTION = 'description';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $description;

    /**
     * Item constructor.
     * @param $id
     * @param $name
     * @param $price
     * @param $description
     */
    public function __construct($id, $name, $price, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function toArray(): array
    {
        return [
            self::ID => $this->getId(),
            self::NAME => $this->getName(),
        ];
    }


}
