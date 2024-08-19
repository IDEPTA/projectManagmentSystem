<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Интерфейс репозитория Project
 */
interface ProjectRepositoryInterface
{
    /**
     * Количество задач по проекту
     * 
     * Этот метод возвращает список с активными задачами по каждому проекту
     * 
     * @return object - объект с задачами по каждому проекту
     */
    public function getCountTaskForProject(): object;

    /**
     * Возвращает количество завершенных задач для проектов
     * 
     * Этот метод возвращает массив объектов, содержащий название проекта и количество завершенных задач
     * 
     * @return object - объект с завершенными задачами по каждому проекту
     */
    public function getCompletedTaskForProject(): object;
    /**
     * Возвращает задачи с высоким приоритетом 
     * 
     * Этот метод возвращает информацию о проекте и его задачи с высоким приоритетом
     * 
     * @return object - объект задач с высоким приоритетом
     */
    public function hightPriorityTasks(): object;
    /**
     * Возвращает массив пользователей для определенного проекта
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенным проектом
     * 
     * @param Request $req - запрос с данными о проекте
     * 
     * @return object - объект с командами для каждого проекта
     */
    public function getTeamForProject(Request $req): object;
    /**
     * Возвращает массив пользователей для определенной задачи.
     * 
     * Этот метод возвращает массив пользователей, которые работают над определенной задачей.
     * 
     * @param Request $req - запрос с данными о задаче
     * 
     * @return object - объект с командами для каждой задачи
     */
    public function getTeamForTask(Request $req): object;
}
