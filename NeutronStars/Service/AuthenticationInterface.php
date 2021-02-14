<?php
namespace NeutronStars\Service;


use NeutronStars\Entity\UserInterface;

interface AuthenticationInterface
{
    public function loadUser(UserInterface $user, $id): bool;
}
