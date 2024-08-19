<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\TaskDependencies;
use Illuminate\Support\Facades\DB;
use App\Interfaces\UserRepositoryInterface;

/**
 * Репозиторий таблицы User
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Возвращает количество задач для пользователей
     * 
     * Этот метод возвращает количество закрепленных данных за определенным пользователем.
     * 
     * @return object - объект с задачами для пользователей
     */
    public function getCountTaskForUser(): object
    {
        $data = User::join("task_dependencies", "users.id", "user_id")
            ->select(["users.id", "users.name as username", DB::raw("count(user_id) as counts")])
            ->groupBy("users.id")
            ->get();

        return $data;
    }

    /**
     * Возвращает задачи для конкретного пользователя
     * 
     * Этот метод возвращает количество закрепленных задач за определенным пользователем.
     * 
     * @param int $id - пользователя
     * 
     * @return object - объект с задачами для конкретного пользователей
     */
    public function getTasksForConcreteUser(int $id): object
    {
        $data = TaskDependencies::with("task.project")
            ->where("user_id", $id)
            ->whereHas("task", function ($q) {
                $q->whereNot("tasks.status", "Завершен");
            })
            ->get();

        return $data;
    }

    /**
     * Возвращает пользователя с максимальным количеством задач
     * 
     * Этот метод возвращает информацию о пользователе с наибольшеи количеством 
     * закрепленных за ним задач и информацию о этих задачах.
     * 
     * @return object - объект с данными пользователя и закрепленными за ним задачами
     */
    public function getMaxUserTask(): object
    {
        $data =
            TaskDependencies::join("users", "users.id", "user_id")
            ->join("tasks", "tasks.id", "task_id")
            ->select([
                "users.id",
                "users.name",
                DB::raw("COUNT(tasks.id) as tasksCount"),
            ])
            ->where("tasks.status", "В разработке")
            ->groupBy("users.id", "users.name")
            ->orderByDesc("tasksCount")
            ->first();

        $data['tasks'] = TaskDependencies::with("task.project")
            ->where("user_id", $data->id)
            ->whereHas("task", function ($q) {
                $q->where("tasks.status", "В разработке");
            })
            ->get();

        return $data;
    }

    /**
     * Возвращает пользователя по id
     * 
     * Этот метод ищет пользователя в базе данных по заданному id
     * 
     * @param int $id
     * 
     * @return User - модель найденного пользователя
     */
    public function findUser(int $id): User
    {
        $user = User::findOrFail($id);

        return $user;
    }
}
