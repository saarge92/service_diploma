<?php

namespace App\Services;

use App\ContactRequestTable;
use App\Interfaces\IContactService;

/**
 * Class ContactService, содержащий бизнес-логику по работе с
 * заявками пользователей на обратную связь
 *
 * @package App\Services
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ContactService implements IContactService
{

    /**
     * Получаем список записей на обратную связь в базе
     * @return array Ответ в виде массива заявок на соединение
     */
    public function getRecordsOfContacts(): array
    {
        $contactRecords = ContactRequestTable::orderBy('created_at', 'desc')->paginate(6);
        return [
            'contactRecords' => $contactRecords
        ];
    }

    /**
     * Удаление записи об обратной свзяи
     * @param int $id Id удаляемой записи
     * @return bool Удалена ли запись
     */
    public function deleteRecordContactInfo(int $id): bool
    {
        $result = false;
        $record = ContactRequestTable::find($id);
        if ($record) {
            $result = $record->delete();
        }
        return $result;
    }

    /**
     * Добавление в базе заявки пользователя на обратную связь
     * @param array $contactInfo
     * @return bool Добавлена ли заявка в базу
     */
    public function addContactMe(array $contactInfo): bool
    {
        return ContactRequestTable::create([
            'name' => $contactInfo['name'],
            'phone' => $contactInfo['phone'],
            'comments' => $contactInfo['comments']
        ])->save();
    }
}
