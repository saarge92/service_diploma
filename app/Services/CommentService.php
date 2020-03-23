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

    /**
     * Создания комментария в базе данных
     * @param array $commentParams Параметры создания ко
     * @return array Ассоциативный массив с информацией о созданном комментарии в базе
     */
    public function postComment(array $commentParams): array
    {
        $userId = $commentParams['user']['id'];
        $orderId = isset($commentParams['orderId']) ? $commentParams['orderId'] : null;
        $textComment = isset($commentParams['textComment']) ? $commentParams['textComment'] : null;
        $isAdmin = in_array('admin', $commentParams['user']->roles->pluck('name')->toArray());
        $newComment = Comment::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'comments' => $textComment
        ]);
        $isCreated = $newComment->save();
        if ($isCreated) {
            return [
                'created' => $isCreated,
                'author' => $commentParams['user']->name,
                'create_date' => $newComment->created_at->format('Y-m-d H:i:00'),
                'isAdmin' => $isAdmin,
                'id' => $newComment->id
            ];
        }
        return [
            'created' => false
        ];
    }
}
