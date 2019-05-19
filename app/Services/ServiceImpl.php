<?php

namespace App\Services;

use App\Interfaces\IService;
use App\Http\Requests\CreateServiceRequest;
use App\Service;

/**
 * Класс, реализующий работу интерфейса Iservice
 * Содержит бизнес-логику по работу с таблицей сервисы
 */
class ServiceImpl implements IService
{
    /**
     * Добавление услуги в БД
     * @param CreateServiceRequest $request Запрос на создание услуги
     * @return bool Возвращает булево значение, создана ли услуга в БД
     */
    public function createService(CreateServiceRequest $request): bool
    {
        $result = false;
        $file = $request->file('path');
        $newFileServiceName = 'unknow.png';
        if (isset($file)) {
            $filename = 'service' . '_' . date('Y_m_d H_i_s') . '.' . $file->getClientOriginalExtension();
            $destination = public_path() . '/storage/services/';
            $file->move($destination, $filename);
            $newFileServiceName = 'services/' . $filename;
        }
        $newService = Service::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'price' => $request->get('price'),
            'path' => $newFileServiceName
        ]);
        $result = $newService->save();
        return $result;
    }
}
