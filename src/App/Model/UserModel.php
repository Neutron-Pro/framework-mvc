<?php
namespace App\Model;

use NeutronStars\Kernel;
use NeutronStars\Model\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function insert($name, $email, $password, $token): string
    {
        $this->createQuery()
            ->insertInto('name,email,password,token_verify,created_at', '?,?,?,?,NOW()')
            ->setParameters([
                $name, $email, $password, $token
            ])
            ->execute();
        return Kernel::get()->getDatabase()->getLastInsertId();
    }

    public function getUserByToken($id, $token, $tokenColumn): ?Object
    {
        return $this->createQuery()
                    ->select('*')
                    ->where('id=? and '.$tokenColumn.'=?')
                    ->setParameters([$id, $token])
                    ->getResult();
    }

    public function updateToken($id, $token, $tokenColumn): void
    {
        $this->createQuery()
             ->update($tokenColumn.'=?')
             ->where('id=?')
             ->setParameters([$token, $id])
             ->execute();
    }
}
