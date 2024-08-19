<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UserServiceInterface;

/**
 * Сервис для таблицы User
 */
class UserService implements UserServiceInterface
{
    /**
     * Репозиторий для управления данными пользователя.
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository - репозиторий для управления данными пользователя.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Обновление аватара пользователя
     * 
     * Этот метод обновляет аватар пользователя
     * 
     * @param Request $req - запрос с загружаемой картинкой
     * @param int $id - идентификатор пользователя
     * 
     * @return User - обновленная информация о пользователе
     */
    public function addAvatar(Request $req, int $id): User
    {
        $User = $this->userRepository->findUser($req['id']);
        $image = file_get_contents($req->file("avatar"));
        $codeImg = base64_encode($image);
        $User->update([
            "avatar" => $codeImg
        ]);

        return  $User;
    }
}
