<?php

namespace App\Services;

use App\Interfaces\IService;
use App\Service;

/**
 * Класс, реализующий работу интерфейса Iservice
 * Содержит бизнес-логику по работу с таблицей сервисы
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ServiceImpl implements IService
{
    /**
     * Добавление услуги в БД
     * @param array $createParams Список инициализируемых параметров
     * @return Service Созданный сервис
     */
    public function createService(array $createParams): Service
    {
        $newFileServiceName = 'services/unknow.png';
        if (isset($createParams['path'])) {
            $file = $createParams['path'];
            $filename = 'service' . '_' . date('Y_m_d H_i_s') . '.' . $file->getClientOriginalExtension();
            $destination = public_path() . '/storage/services/';
            $file->move($destination, $filename);
            $newFileServiceName = 'services/' . $filename;
        }
        $newService = Service::create([
            'title' => $createParams['title'],
            'content' => $createParams['content'],
            'price' => $createParams['price'],
            'path' => $newFileServiceName
        ]);
        $newService->save();
        return $newService;
    }

    /**
     * Получение списка сервисов в панель-админке
     */
    public function getServices()
    {
        return Service::paginate(6);
    }

    /**
     * Редактировние сервиса
     * @param int $id Id услуги
     * @param array $editParams Параметры редактирования
     * @return Service Возвращает результат успешного обновления
     */
    public function editService(int $id, array $editParams): Service
    {
        $serviceForEdit = Service::find($id);
        if (isset($editParams['path'])) {
            $newFileImage = $editParams['path'];
            if ($serviceForEdit->path != null) {
                $delete_path = public_path() . '/storage/' . $serviceForEdit->path;
                if (file_exists($delete_path)) {
                    unlink($delete_path);
                }
            }
            $filename = $editParams['title'] . '_' . date('Y_m_d H_i_s') . '.' . $newFileImage->getClientOriginalExtension();
            $destination = public_path() . '/storage/services/';
            $newFileImage->move($destination, $filename);
            $serviceForEdit->path = 'services/' . $filename;
        }
        $serviceForEdit->title = $editParams['title'];
        $serviceForEdit->content = $editParams['content'];
        $serviceForEdit->save();
        return $serviceForEdit;
    }

    /**
     * Удаление услуг по Id
     * @param int $id Id услуги
     * @return bool Удалена ли услуга
     */
    public function deleteService(int $id): bool
    {
        $resultDelete = false;
        $service = Service::find($id);
        if ($service) {
            $resultDelete = $service->delete();
        }
        return $resultDelete;
    }
}
