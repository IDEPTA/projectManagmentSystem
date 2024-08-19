<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Интерфейс для сервиса User
 */
interface UserServiceInterface
{
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
    public function addAvatar(Request $req, int $id): User;
}
