<?php

namespace App\Entity;

use App\Entity\Data\Address;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use Symfony\Component\Security\Core\User\UserInterface;
use function filter_var;
use const FILTER_VALIDATE_EMAIL;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column
     */
    private $name;

    /**
     * @ORM\Column(unique=true)
     */
    private $email;

    /**
     * @ORM\Embedded(class="App\Entity\Data\Address", columnPrefix="address_")
     */
    private $address;

    /**
     * @ORM\Column(name="password", length=100)
     */
    private $encodedPassword = '';

    public function __construct(string $name, string $email, Address $address)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('The provided email is invalid');
        }

        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
    }

    public function updatePassword(string $encodedPassword): void
    {
        $this->encodedPassword = $encodedPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @internal Should only be used by security mechanism
     */
    public function getUsername(): string
    {
        return $this->getEmail();
    }

    /**
     * @internal Should only be used by security mechanism
     */
    public function getPassword(): string
    {
        return $this->encodedPassword;
    }

    /**
     * @internal Should only be used by security mechanism
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * @internal Should only be used by security mechanism
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @internal Should only be used by security mechanism
     */
    public function eraseCredentials(): void
    {
    }

    public function __toString()
    {
        return $this->getName();
    }
}
