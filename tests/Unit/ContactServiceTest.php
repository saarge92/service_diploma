<?php

namespace Tests\Unit;

use App\Interfaces\IContactService;
use Tests\TestCase;


/**
 * Тестирование класса ContactService, содержащий бизнес-логику по работе с
 * заявками пользователей на обратную связь
 *
 * @package Tests\Unit
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ContactServiceTest extends TestCase
{
    /**
     * Тестирование получения заявки
     * Тестирование метода getRecordsOfContacts
     * Должен вернуть ассоциативный массив
     */
    public function testGetRecordsOfContacts()
    {
        $contactService = $this->getContactDependency();

        $result = $contactService->getRecordsOfContacts();

        $this->assertIsArray($result);
        $this->arrayHasKey('contactRecords', $result);
    }

    /**
     * Получение зависимости ContactService
     * для тестирование функционлаа
     * @return IContactService
     */
    private function getContactDependency(): IContactService
    {
        return resolve(IContactService::class);
    }
}
