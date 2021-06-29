<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TeamMemberDto;
use App\Http\Requests\TeamMemberCreateRequest;
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
}
