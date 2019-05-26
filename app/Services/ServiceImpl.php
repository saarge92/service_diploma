<?php

namespace App\Services;

use App\Interfaces\IService;
use App\Http\Requests\CreateServiceRequest;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Requests\EditServiceRequest;

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

    /**
     * Получение списка сервисов в панель-админке
     */
    public function getServices(Request $request)
    {
        $services = Service::paginate(6);
        return $services;
    }

    /**
     * Редактировние сервиса
     * @param EditServiceRequest $request Запрос с изменяемыми параметрами для сервиса
     * @return bool Возвращает результат успешного обновления
     */
    public function editService(EditServiceRequest $request): bool
    {
        $resultOperation = true;
        try {
            $id = $request->get('id');
            $serviceForEdit = Service::find($id);
            $newFileImage = $request->file('path');
            if (isset($newFileImage)) {
                if ($serviceForEdit->path != null) {
                    $delete_path = public_path() . '/storage/' . $serviceForEdit->path;
                    if (file_exists($delete_path)) {
                        unlink($delete_path);
                    }
                }
                $filename = $request->get('title') . '_' . date('Y_m_d H_i_s') . '.' . $newFileImage->getClientOriginalExtension();
                $destination = public_path() . '/storage/services/';
                $newFileImage->move($destination, $filename);
                $serviceForEdit->path = 'services/' . $filename;
            }
            $serviceForEdit->title = $request->get('title');
            $serviceForEdit->content = $request->get('content');
            $resultOperation = $serviceForEdit->save();
        } catch (\Exception $ex) {
            $resultOperation = false;
        }
        return $resultOperation;
    }

    /**
     * Удаление услуг по Id
     * @param int $id Id услуги
     */
    public function deleteService(int $id):bool
    {
        $resultDelete = false;
        $service = Service::find($id);
        if ($service) {
            $resultDelete = $service->delete();
        }
        return $resultDelete;
    }
}
