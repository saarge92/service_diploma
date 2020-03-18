<?php

namespace App\Services;

use App\Comment;
use App\Interfaces\ICommentService;

/**
 * Class CommentService, содержащий бизнес-логику по работе с комментариями
 * @package App\Services
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class CommentService implements ICommentService
{

    /**
     * Удаление комментария по его Id
     * @param int $id Id комментария
     * @return bool Булевое значение удален ли комметарий
     */
    public function deleteComment(int $id): bool
    {
        $resultOperation = false;
        $comment = Comment::find($id);
        if ($comment) {
            $resultOperation = $comment->delete();
        }
        return $resultOperation;
    }
}
