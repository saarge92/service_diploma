<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IService;
use App\Http\Requests\CreateServiceRequest;

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
    public function getServices(Request $request)
    {
       $services = $this->serviceRepository->getServices($request);
       return view('admin.service.index',compact('services')); 
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
            $this->serviceRepository->createService($request);
            return redirect()->route('admin.services');
        }
        return redirect()->back();
    }


}
