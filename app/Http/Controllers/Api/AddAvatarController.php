<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Контроллер отвечающий за обновление аватара пользователя
 */
class AddAvatarController extends Controller
{
    /**
     * Сервис для управления данными пользователя 
     * 
     * @var UserServiceInterface 
     */
    protected $userService;

    /**
     * @param UserServiceInterface $userService - сервис для управления данными пользователя 
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @param Request $req - обновленные данные пользователя
     * @param int $id - id пользователя, для которого обновляется аватар
     * 
     * @return JsonResponse - Json ответ с обновленными данными пользователя.
     */
    public function __invoke(Request $req, int $id): JsonResponse
    {
        try {
            $User = $this->userService->addAvatar($req, $id);

            return response()->json(['msg' => 'успешно', "data" => $User]);
        } catch (Exception $e) {
            return response()->json(["msg" => $e->getMessage(), "code" => $e->getCode()]);
        }
    }
}
