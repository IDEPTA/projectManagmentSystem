<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Репозиторий таблицы Project
 */
class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * Количество задач по проекту
     * 
     * Этот метод возвращает список с активными задачами по каждому проекту
     * 
     * @return object - объект с задачами по каждому проекту
     */
    public function getCountTaskForProject(): object
    {
        $tasks = Project::with([
            'task' => function ($query) {
                $query->whereNot("status", "Завершен");
            }
        ])->withCount([
            'task' => function ($query) {
                $query->whereNot("status", "Завершен");
            }
        ])->paginate(15);

        return $tasks;
    }
    /**
     * Возвращает количество завершенных задач для проектов
     * 
     * Этот метод возвращает массив объектов, содержащий название проекта и количество завершенных задач
     * 
     * @return object - объект с завершенными задачами по каждому проекту
     */

    public function getCompletedTaskForProject(): object
    {
        $completedTasks = Project::join("tasks", "tasks.project_id", "=", "projects.id")
            ->select(["projects.name as projectname", DB::raw("COUNT(tasks.id) as completedTasks")])
            ->where("tasks.status", "Завершен")
            ->groupBy("projects.name")
            ->paginate(10);

        return $completedTasks;
    }

    /**
     * Возвращает задачи с высоким приоритетом 
     * 
     * Этот метод возвращает информацию о проекте и его задачи с высоким приоритетом
     * 
     * @return object - объект задач с высоким приоритетом
     */
    public function hightPriorityTasks(): object
    {
        $hightPriorityTasks = Task::with("project")
            ->where("priority", "Высокий")
            ->get();

        return $hightPriorityTasks;
    }

    /**
     * Возвращает массив пользователей для определенного проекта
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенным проектом
     * 
     * @param Request $req - запрос с данными о проекте
     * 
     * @return object - объект с командами для каждого проекта
     */
    public function getTeamForProject(Request $req): object
    {
        $teams =
            Project::with('task.task_dependencie.user')
            ->orderBy('name')
            ->where("id", $req["id"])
            ->get(['id', 'name'])
            ->map(function ($project) {
                return [
                    'id' => $project->id,
                    'projectname' => $project->name,
                    'users' => $project->task->map(function ($task) {
                        return $task->task_dependencie->map(function ($taskDependency) {
                            return $taskDependency->user;
                        });
                    })->unique()->values()->toArray(),
                ];
            });

        return $teams;
    }

    /**
     * Возвращает массив пользователей для определенной задачи.
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенной задачей.
     * 
     * @param Request $req - запрос с данными о задаче
     * 
     * @return object - объект с командами для каждой задачи
     */
    public function getTeamForTask(Request $req): object
    {
        $teams =
            Task::with(['task_dependencie.user'])
            ->orderBy('name')
            ->where("id", $req["id"])
            ->get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'taskname' => $data->name,
                    'users' => $data->task_dependencie->map(function ($task) {
                        return $task->user;
                    })->unique()->values()->toArray(),
                ];
            });

        return $teams;
    }
}
