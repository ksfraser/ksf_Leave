<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Entity;

class LeaveRequest
{
    public const STATUS_PENDING = 'Pending';
    public const STATUS_APPROVED = 'Approved';
    public const STATUS_REJECTED = 'Rejected';
    public const STATUS_CANCELLED = 'Cancelled';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $leaveTypeId = 0;
    private string $startDate = '';
    private string $endDate = '';
    private float $days = 0;
    private string $reason = '';
    private string $status = self::STATUS_PENDING;
    private ?int $approverId = null;
    private ?string $approvedDate = null;
    private ?string $rejectionReason = null;
    private ?int $replacesEmployeeId = null;
    private string $createdAt = '';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getLeaveTypeId(): int { return $this->leaveTypeId; }
    public function setLeaveTypeId(int $leaveTypeId): self { $this->leaveTypeId = $leaveTypeId; return $this; }
    public function getStartDate(): string { return $this->startDate; }
    public function setStartDate(string $startDate): self { $this->startDate = $startDate; return $this; }
    public function getEndDate(): string { return $this->endDate; }
    public function setEndDate(string $endDate): self { $this->endDate = $endDate; return $this; }
    public function getDays(): float { 
        return $this->days > 0 ? $this->days : $this->calculateDays(); 
    }
    public function setDays(float $days): self { $this->days = $days; return $this; }
    public function getReason(): string { return $this->reason; }
    public function setReason(string $reason): self { $this->reason = $reason; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getApproverId(): ?int { return $this->approverId; }
    public function setApproverId(?int $approverId): self { $this->approverId = $approverId; return $this; }
    public function getApprovedDate(): ?string { return $this->approvedDate; }
    public function setApprovedDate(?string $approvedDate): self { $this->approvedDate = $approvedDate; return $this; }
    public function getRejectionReason(): ?string { return $this->rejectionReason; }
    public function setRejectionReason(?string $rejectionReason): self { $this->rejectionReason = $rejectionReason; return $this; }
    public function getReplacesEmployeeId(): ?int { return $this->replacesEmployeeId; }
    public function setReplacesEmployeeId(?int $replacesEmployeeId): self { $this->replacesEmployeeId = $replacesEmployeeId; return $this; }
    public function getCreatedAt(): string { return $this->createdAt; }
    public function setCreatedAt(string $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function isPending(): bool { return $this->status === self::STATUS_PENDING; }
    public function isApproved(): bool { return $this->status === self::STATUS_APPROVED; }
    public function isRejected(): bool { return $this->status === self::STATUS_REJECTED; }
    public function isCancelled(): bool { return $this->status === self::STATUS_CANCELLED; }

    public function calculateDays(): float
    {
        if (empty($this->startDate) || empty($this->endDate)) {
            return 0;
        }
        $start = new \DateTime($this->startDate);
        $end = new \DateTime($this->endDate);
        return (float)($end->diff($start)->days + 1);
    }
}