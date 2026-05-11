<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Entity;

class LeaveRequest
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_CANCELLED = 'cancelled';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $leaveTypeId = 0;
    private string $startDate = '';
    private string $endDate = '';
    private float $days = 0;
    private string $reason = '';
    private string $status = self::STATUS_DRAFT;
    private ?int $approverId = null;
    private ?string $approvedDate = null;
    private ?string $rejectionReason = null;
    private string $createdAt = '';
    private string $updatedAt = '';

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
    public function getDays(): float { return $this->days; }
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
    public function getCreatedAt(): string { return $this->createdAt; }
    public function setCreatedAt(string $createdAt): self { $this->createdAt = $createdAt; return $this; }
    public function getUpdatedAt(): string { return $this->updatedAt; }
    public function setUpdatedAt(string $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }
}