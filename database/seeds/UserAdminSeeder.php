<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    private \App\Services\UserService $userService;
    private \App\Services\RoleService $roleService;

    public function __construct(
        \App\Services\UserService $userService,
        \App\Services\RoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    private string $email = 'inara97@mail.ru';
    private string $password = '123456';
    private string $name = 'Inara';
    private string $address = 'Address';
    private string $organization = 'My organization';

    public function run(): void
    {
        $adminRole = $this->roleService->findByName('admin');
        $createParams = [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'organization' => $this->organization,
            'password' => $this->password,
            'phone_number' => '88888888888',
            'roleId' => $adminRole['id']
        ];
        $this->userService->postCreateUser($createParams);
    }
}
