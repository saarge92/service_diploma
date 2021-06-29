<?php

declare(strict_types=1);

namespace App\Dto;

use App\Http\Requests\TeamMemberCreateRequest;
use Illuminate\Http\UploadedFile;

class TeamMemberDto
{
    private string $name;

    private UploadedFile $photo;

    private string $position;

    private ?string $vkUrl;

    private ?string $instagramUrl;

    public static function initFromRequest(TeamMemberCreateRequest $request): self
    {
        return new static(
            $request->get("name"), $request->get("photo"), $request->get("position"),
            $request->get("vk_url"), $request->get("instagram_url")
        );
    }

    private function __construct(
        string $name,
        UploadedFile $photo,
        string $position,
        ?string $vkUrl,
        ?string $instagramUrl
    ) {
        $this->name = $name;
        $this->photo = $photo;
        $this->position = $position;
        $this->vkUrl = $vkUrl;
        $this->instagramUrl = $instagramUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoto(): UploadedFile
    {
        return $this->photo;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getVkUrl(): ?string
    {
        return $this->vkUrl;
    }

    public function getInstagramUrl(): ?string
    {
        return $this->instagramUrl;
    }
}
