<?php

namespace App\Interfaces;


/**
 * Interface IContactService определяющий функционал по
 * работе с заявками пользователей на обратную связь
 * @package App\Interfaces
 */
interface IContactService
{
    function getRecordsOfContacts(): array;

    function deleteRecordContactInfo(int $id): bool;

    function addContactMe(array $contactInfo): bool;
}
