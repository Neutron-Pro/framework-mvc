<?php
namespace NeutronStars\Entity;


use NeutronStars\Service\Role;

class AnonymousUser extends UserInterface
{
    public function getRoles(): array
    {
        return [ Role::ANONYMOUS ];
    }
}
