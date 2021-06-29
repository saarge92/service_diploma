<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Dto\TeamMemberDto;
use App\Team;

interface TeamServiceInterface
{
    public function createMember(TeamMemberDto $teamMemberDto): Team;

    public function getMembers(): object;
}
