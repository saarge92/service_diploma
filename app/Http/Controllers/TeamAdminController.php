<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TeamEditMemberDto;
use App\Dto\TeamMemberDto;
use App\Http\Requests\TeamMemberCreateRequest;
use App\Http\Requests\TeamMemberEditRequest;
use App\Interfaces\TeamServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Session\Session;

class TeamAdminController extends Controller
{
    private TeamServiceInterface $teamService;

    public function __construct(TeamServiceInterface $teamService)
    {
        $this->teamService = $teamService;
    }

    public function getMembersList(): View
    {
        $teamMembers = $this->teamService->getMembers();
        return view('admin.team.list', ['teams' => $teamMembers]);
    }

    public function getCreateMemberListPage(): View
    {
        return view("admin.team.create");
    }

    public function createMemberTeam(TeamMemberCreateRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $teamDto = TeamMemberDto::initFromRequest($request);
            $this->teamService->createMember($teamDto);
            Session::flash('success', 'Успешное добавление члена команды');
            return redirect()->route("admin.teams");
        }
        return redirect()->back();
    }

    public function editMemberTeam(int $id, TeamMemberEditRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $teamDto = TeamEditMemberDto::initFromRequest($request);
            $this->teamService->editMember($id, $teamDto);
            Session::flash('success', 'Член команды успешно обновлен');
            return redirect()->route("admin.teams");
        }
        return redirect()->back();
    }
}
