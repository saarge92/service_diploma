<?php

namespace Tests\Unit;

use App\ContactRequestTable;
use App\Interfaces\IContactService;
use Faker\Factory;
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
     * Тестирование удаления заявки на сотрудничество из базы
     * Тестирование метода deleteRecordContactInfo
     */
    public function testDeleteRecordsContactInfo()
    {
        $contactService = $this->getContactDependency();
        $randomRequest = ContactRequestTable::orderByRaw("RAND()")->first();
        if ($randomRequest) {
            $result = $contactService->deleteRecordContactInfo($randomRequest['id']);
            $this->assertEquals($result, true);
        }

    }

    /**
     * Тестирование добавления заявки на обратную связь
     * Должен вернуть либо true / false в случае успешного добавления
     */
    public function testAddContactMe()
    {
        $contactService = $this->getContactDependency();
        $faker = Factory::create('ru-RU');
        $contactInfo = [
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'comments' => $faker->text
        ];

        $result = $contactService->addContactMe($contactInfo);

        $this->assertIsBool($result);
        $this->assertSame($result, true);
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
