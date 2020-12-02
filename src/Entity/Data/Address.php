<?php

declare(strict_types=1);

namespace App\Entity\Data;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Address
{
    /**
     * @ORM\Column(type="string")
     */
    private $street;

    /**
     * @ORM\Column(type="string")
     */
    private $zip;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    public function __construct(string $street, string $zip, string $city)
    {
        // validate data...

        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
}