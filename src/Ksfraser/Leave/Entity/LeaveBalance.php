<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Entity;

class LeaveBalance
{
    private ?int $id = null;
    private int $employeeId = 0;
    private int $leaveTypeId = 0;
    private float $annualAllocation = 0;
    private float $used = 0;
    private float $pending = 0;
    private float $accrued = 0;
    private string $yearStart = '';
    private string $yearEnd = '';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getLeaveTypeId(): int { return $this->leaveTypeId; }
    public function setLeaveTypeId(int $leaveTypeId): self { $this->leaveTypeId = $leaveTypeId; return $this; }
    public function getAnnualAllocation(): float { return $this->annualAllocation; }
    public function setAnnualAllocation(float $annualAllocation): self { $this->annualAllocation = $annualAllocation; return $this; }
    public function getUsed(): float { return $this->used; }
    public function setUsed(float $used): self { $this->used = $used; return $this; }
    public function getPending(): float { return $this->pending; }
    public function setPending(float $pending): self { $this->pending = $pending; return $this; }
    public function getAccrued(): float { return $this->accrued; }
    public function setAccrued(float $accrued): self { $this->accrued = $accrued; return $this; }
    public function getAvailable(): float { return $this->annualAllocation - $this->used - $this->pending; }
    public function getYearStart(): string { return $this->yearStart; }
    public function setYearStart(string $yearStart): self { $this->yearStart = $yearStart; return $this; }
    public function getYearEnd(): string { return $this->yearEnd; }
    public function setYearEnd(string $yearEnd): self { $this->yearEnd = $yearEnd; return $this; }
}