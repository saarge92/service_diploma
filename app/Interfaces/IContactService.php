<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface IContactService определяющий функционал по
 * работе
 * @package App\Interfaces
 */
interface IContactService
{
    function getRecordsOfContacts(): array;

    function deleteRecordContactInfo(int $id): bool;
}
