<?php

declare(strict_types=1);

namespace App\Dto\Orders;


class OrderCreateDto
{
    private ?int $statusId;

    private int $userId;

    private int $totalQty;

    private float $totalPrice;

    public function __construct(?int $statusId, int $userId, int $totalQty, float $totalPrice)
    {
        $this->statusId = $statusId;
        $this->userId = $userId;
        $this->totalQty = $totalQty;
        $this->totalPrice = $totalPrice;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTotalQty(): int
    {
        return $this->totalQty;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}
