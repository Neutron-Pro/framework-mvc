<?php
namespace App\Service;


use App\Model\UserModel;
use DateTime;
use NeutronStars\Entity\UserInterface;
use NeutronStars\Service\AuthenticationInterface;

class Authentification implements AuthenticationInterface
{
    public function loadUser(UserInterface $user, $id): bool
    {
        $u = (new UserModel())->findById($id);
        if ($u === null) {
            return false;
        }
        $user->setId($u->id);
        $user->setName($u->name);
        $user->setEmail($u->email);
        $user->setCreatedAt(new DateTime($u->created_at));
        return true;
    }
}
