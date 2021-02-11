<?php
namespace App\Model;
use NeutronStars\Api\Model\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }
}
