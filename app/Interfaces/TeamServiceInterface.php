<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Dto\TeamEditMemberDto;
use App\Dto\TeamMemberDto;
use App\Team;

interface TeamServiceInterface
{
    public function createMember(TeamMemberDto $teamMemberDto): Team;

    public function getMembers(): object;

    public function editMember(int $id, TeamEditMemberDto $teamMemberDto): Team;
}
