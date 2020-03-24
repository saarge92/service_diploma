<?php

namespace Tests\Unit;

use App\Comment;
use App\Order;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use App\Interfaces\ICommentService;

/**
 * Тестирование функционала класса CommentService
 * с бизнес-логикой по добавлению комментариев в базу
 *
 * @package Tests\Unit
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class CommentServiceTest extends TestCase
{

    /**
     * Тестирование удаления комментария
     * Тестируем метод deleteComment
     *
     * Должен вернуть true в случае успешного удаления
     */
    public function testComment()
    {
        $commentService = $this->getCommentServiceDependency();
        $randomComment = Comment::orderByRaw("RAND()")->first();

        $resultDelete = $commentService->deleteComment($randomComment['id']);

        $this->assertEquals($resultDelete, true);
    }

    /**
     * Тестирование отправки комментария в базу данных
     * Тестирование метода postComment
     */
    public function testPostComment()
    {
        $commentService = $this->getCommentServiceDependency();
        $randomUser = User::orderByRaw("RAND()")->first();
        $randomOrder = Order::orderByRaw("RAND()")->first();
        $faker = Factory::create('ru-RU');

        $commentParams = [
            'user' => $randomUser,
            'orderId' => $randomOrder['id'],
            'textComment' => $faker->text
        ];

        $resultComment = $commentService->postComment($commentParams);

        $this->assertIsArray($resultComment);
        $this->arrayHasKey('created', $resultComment);
    }

    /**
     * Получение зависимости ICommentService для получения функционала
     * работы с комментариями
     * @return ICommentService
     */
    private function getCommentServiceDependency(): ICommentService
    {
        return resolve(ICommentService::class);
    }
}
