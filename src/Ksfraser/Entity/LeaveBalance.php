<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Entity;

class LeaveBalance
{
    private ?int $id = null;
    private int $employeeId = 0;
    private int $leaveTypeId = 0;
    private int $year = 0;
    private float $openingBalance = 0;
    private float $accrued = 0;
    private float $used = 0;
    private float $carriedForward = 0;
    private ?float $maxCarryForward = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getLeaveTypeId(): int { return $this->leaveTypeId; }
    public function setLeaveTypeId(int $leaveTypeId): self { $this->leaveTypeId = $leaveTypeId; return $this; }
    public function getYear(): int { return $this->year; }
    public function setYear(int $year): self { $this->year = $year; return $this; }
    public function getOpeningBalance(): float { return $this->openingBalance; }
    public function setOpeningBalance(float $openingBalance): self { $this->openingBalance = $openingBalance; return $this; }
    public function getAccrued(): float { return $this->accrued; }
    public function setAccrued(float $accrued): self { $this->accrued = $accrued; return $this; }
    public function getUsed(): float { return $this->used; }
    public function setUsed(float $used): self { $this->used = $used; return $this; }
    public function getCarriedForward(): float { return $this->carriedForward; }
    public function setCarriedForward(float $carriedForward): self { $this->carriedForward = $carriedForward; return $this; }
    public function getMaxCarryForward(): ?float { return $this->maxCarryForward; }
    public function setMaxCarryForward(?float $maxCarryForward): self { $this->maxCarryForward = $maxCarryForward; return $this; }

    public function getAvailable(): float
    {
        return $this->openingBalance + $this->accrued + $this->carriedForward - $this->used;
    }

    public function hasInsufficientFunds(float $daysRequested): bool
    {
        return $daysRequested > $this->getAvailable();
    }

    public function useDays(float $days): void
    {
        $this->used += $days;
    }

    public function addAccrual(float $days): void
    {
        $this->accrued += $days;
    }
}