<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IService;
use App\Http\Requests\CreateServiceRequest;
use App\Service;
use App\Http\Requests\EditServiceRequest;
use Illuminate\Support\Facades\Session;

/**
 * Контроллер для обработки запросов при работе с таблицей "Услуги"
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ServiceController extends Controller
{
    private $serviceRepository;

    /**
     * Внедрение зависимостей
     * Внедрение функционала класса ServiceImpl
     */
    public function __construct(IService $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Get-запрос на получение списка услуг
     * с постраничным отображением
     * @param Request $request - Http-запрос
     */
    public function getServices()
    {
        $services = $this->serviceRepository->getServices();
        return view('admin.service.index', compact('services'));
    }

    /**
     * Get-запрос на
     * Генерацию страницы на создание сервиса
     */
    public function getCreateService()
    {
        return view('admin.service.createService');
    }

    /**
     * Post-запрос на создание услуги в базе
     * @param CreateServiceRequest $request Post-запрос с параметрами
     */
    public function postCreateService(CreateServiceRequest $request)
    {
        if ($request->validated()) {
            $this->serviceRepository->createService($request->all());
            return redirect()->route('admin.services');
        }
        return redirect()->back();
    }

    /**
     * Get-запрос на редактирование сервиса
     * @param int $id Номер сервиса
     */
    public function getEditService(int $id)
    {
        $service = Service::find($id);
        return view('admin.service.editService', compact('service'));
    }

    /**
     * POST-запрос на редактирование сервиса
     * @param $id Id Редактируемой услуги
     * @param EditServiceRequest $request Post-запрос с параметрами
     */
    public function postEditService(int $id, EditServiceRequest $request)
    {
        if ($request->validated()) {
            $resultUpdate = $this->serviceRepository->editService($id, $request->all());
            $resultUpdate ? Session::flash('success', 'Успешное обновление сервиса') : Session::flash('error', 'Ошибка обновления');
            return redirect()->route('admin.services');
        }
        return redirect()->back();
    }

    /**
     * POST-запрос на удаление сервиса
     * @param int $id Id удаляемой услуги
     * @return string Название маршрута для перенаправления
     */
    public function deleteService(int $id): string
    {
        $result = $this->serviceRepository->deleteService($id);
        $result ? Session::flash('success', 'Успешное удаления сервиса') : Session::flash('error', 'Ошибка удаления');
        $routeRedirect = route('admin.services');
        return $routeRedirect;
    }
}
