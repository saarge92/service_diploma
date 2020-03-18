<?php

namespace App\Services;

use App\ContactRequestTable;
use App\Interfaces\IContactService;

class ContactService implements IContactService
{

    public function getRecordsOfContacts(): array
    {
        $contactRecords = ContactRequestTable::orderBy('created_at', 'desc')->paginate(6);
        return [
            'contactRecords' => $contactRecords
        ];
    }

    public function deleteRecordContactInfo(int $id): bool
    {
        $result = false;
        $record = ContactRequestTable::find($id);
        if ($record) {
            $result = $record->delete();
        }
        return $result;
    }
}
