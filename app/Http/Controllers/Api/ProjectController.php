<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер, отвечающий за запросы, связанные с Project
 */
class ProjectController extends Controller
{
    /**
     * Репозиторий отвечающий за запросы с моделью Project
     * 
     * @var ProjectRepositoryInterface
     */
    protected $projectRepository;

    /**
     * @param ProjectRepositoryInterface $projectRepository - репозиторий отвечающий за запросы с моделью Project
     */
    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Количество задач по проекту
     * 
     * Этот метод возвращает список с активными задачами по каждому проекту
     * 
     * @return JsonResponse - Json-ответ
     */
    public function getCountTaskForProject(): JsonResponse
    {
        try {
            $tasks = $this->projectRepository->getCountTaskForProject();

            return response()->json([
                'msg' => "Успешно",
                "data" => $tasks
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        };
    }

    /** 
     * Возвращает количество завершенных задач для проектов
     * 
     * Этот метод возвращает массив объектов, содержащий название проекта и количество завершенных задач
     * @return JsonResponse - Json-ответ
     */
    public function getCompletedTaskForProject(): JsonResponse
    {
        try {
            $completedTask = $this->projectRepository->getCompletedTaskForProject();

            return response()->json([
                'msg' => "Успешно",
                "data" => $completedTask
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        };
    }

    /**
     * Возвращает задачи с высоким приоритетом 
     * 
     * Этот метод возвращает информацию о проекте и его задачи с высоким приоритетом
     * 
     * @return JsonResponse - Json-ответ
     */
    public function hightPriorityTasks(): JsonResponse
    {
        try {
            $hightPriorityTasks = $this->projectRepository->hightPriorityTasks();

            return response()->json([
                'msg' => "Успешно",
                "data" => $hightPriorityTasks
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        };
    }

    /**
     * Возвращает массив пользователей для определенного проекта
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенным проектом
     * 
     * @param Request $req - запрос, содержащий id проекта
     * 
     * @return JsonResponse - Json-ответ
     */
    public function getTeamForProject(Request $req): JsonResponse
    {
        try {
            $taskDependency = $this->projectRepository->getTeamForProject($req);

            return response()->json([
                "msg" => "Успешно",
                "data" => $taskDependency
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        };
    }

    /**
     * Возвращает массив пользователей для определенной задачи.
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенной задачей.
     * 
     * 
     * @param Request $req - запрос, содержащий id задачи
     * 
     * @return JsonResponse - Json-ответ
     */
    public function getTeamForTask(Request $req): JsonResponse
    {
        try {
            $teams = $this->projectRepository->getTeamForTask($req);

            return response()->json([
                "msg" => "Успешно",
                "data" => $teams
            ]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                "code" => $e->getCode()
            ]);
        };
    }
}
