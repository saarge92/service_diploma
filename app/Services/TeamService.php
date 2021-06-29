<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\TeamMemberDto;
use App\Interfaces\FileServiceInterface;
use App\Interfaces\TeamServiceInterface;
use App\Team;

class TeamService implements TeamServiceInterface
{
    private FileServiceInterface $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function createMember(TeamMemberDto $teamMemberDto): Team
    {
        $team = new Team();
        $photoPath = $this->fileService->saveFile($teamMemberDto->getPhoto(), 'teams');
        $team['photo'] = $photoPath;
        $team['name'] = $teamMemberDto->getName();
        $team['position'] = $teamMemberDto->getPosition();
        $team['vk_url'] = $teamMemberDto->getVkUrl();
        $team['instagram_url'] = $teamMemberDto->getInstagramUrl();
        $team->save();
        return $team;
    }

    public function getMembers(): object
    {
        return Team::all();
    }
}
