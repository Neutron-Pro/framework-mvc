<?php
namespace App\Model;
use NeutronStars\Model\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }
}
