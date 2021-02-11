<?php
namespace App\Controller;
use NeutronStars\Api\Controller\Controller;

class UserController extends Controller
{
    private array $users = [
        [
            'id'   => 1,
            'name' => 'John Doe'
        ],
        [
            'id'   => 2,
            'name' => 'Mike Brown'
        ]
    ];

    public function users()
    {
        $this->render('app.users.users', [
            'users' => $this->users
        ]);
    }

    public function user($id)
    {
        if(empty($this->users[$id-1])){
            $this->page404();
        }
        $this->render('app.users.user', [
            'user' => $this->users[$id-1]
        ]);
    }
}
