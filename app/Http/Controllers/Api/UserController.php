<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConcreteTaskResource;
use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер отвечающий за запросы, связанные с User
 */
class UserController extends Controller
{
    /**
     * Репозиторий отвечающий за запросы с моделью User
     * 
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository - репозиторий отвечающий за запросы с моделью User
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Возвращает количество задач для пользователей
     * 
     * Этот метод возвращает количество закрепленных данных за определенным пользователем.
     * 
     * @return JsonResponse - Json-ответ
     */
    public function getCountTaskForUser(): JsonResponse
    {
        try {
            $countTask = $this->userRepository->getCountTaskForUser();

            return response()->json([
                'msg' => "Успешно",
                "data" => $countTask
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        }
    }

    /**
     * Возвращает задачи для конкретного пользователя
     * 
     * Этот метод возвращает количество закрепленных задач за определенным пользователем.
     * 
     * @param Request $req -  запрос, содержащий id пользователя
     * 
     * @return JsonResponse - Json-ответ
     */
    public function getTasksForConcreteUser(Request $req): JsonResponse
    {
        try {
            $userTask = $this->userRepository->getTasksForConcreteUser($req["id"]);

            return response()->json([
                'msg' => "Успешно",
                "data" => ConcreteTaskResource::collection($userTask)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        }
    }

    /**
     * Возвращает пользователя с максимальным количеством задач
     * 
     * Этот метод возвращает информацию о пользователе с наибольшеи количеством закрепленных за ним задач и информацию о этих задачах.
     * @return JsonResponse - Json-ответ
     */
    public function getMaxUserTask(): JsonResponse
    {
        try {
            $maxUserTask = $this->userRepository->getMaxUserTask();

            return response()->json([
                'msg' => "успешно",
                "data" => $maxUserTask
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        }
    }
}
