<?php

namespace App\Interfaces;


/**
 * Interface ICommentService, определяющий базовые методы по работе с комментариями пользователей в системе
 * @package App\Interfaces
 */
interface  ICommentService
{
    function deleteComment(int $id): bool;

    function postComment(array $commentParams): array;
}
