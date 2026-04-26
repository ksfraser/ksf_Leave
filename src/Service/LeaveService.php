<?php

declare(strict_types=1);

namespace Ksf\Leave\Service;

use Ksf\Leave\Entity\LeaveRequest;
use Ksf\Leave\Entity\LeaveBalance;
use Ksf\Leave\Entity\LeaveType;

class LeaveService
{
    public function validateRequest(LeaveRequest $request, LeaveBalance $balance, LeaveType $leaveType): array
    {
        $errors = [];
        $warnings = [];

        // Check balance
        if ($request->getDays() > $balance->getAvailable()) {
            if (!$leaveType->isNegativeAllowed()) {
                $errors[] = 'Insufficient leave balance. Available: ' . $balance->getAvailable();
            } elseif ($request->getDays() > ($balance->getAvailable() + $leaveType->getMaxNegativeBalance())) {
                $errors[] = 'Request exceeds maximum negative balance allowed';
            } else {
                $warnings[] = 'Warning: This will create a negative balance';
            }
        }

        // Check future dating
        $today = new \DateTime();
        $startDate = new \DateTime($request->getStartDate());
        if ($startDate < $today) {
            $errors[] = 'Start date cannot be in the past';
        }

        // Check date range
        if ($request->getEndDate() < $request->getStartDate()) {
            $errors[] = 'End date must be after start date';
        }

        return ['valid' => empty($errors), 'errors' => $errors, 'warnings' => $warnings];
    }

    public function approveRequest(LeaveRequest $request, int $approverId): void
    {
        $request->setStatus(LeaveRequest::STATUS_APPROVED);
        $request->setApproverId($approverId);
        $request->setApprovedDate(date('Y-m-d'));
    }

    public function rejectRequest(LeaveRequest $request, int $approverId, string $reason): void
    {
        $request->setStatus(LeaveRequest::STATUS_REJECTED);
        $request->setApproverId($approverId);
        $request->setRejectionReason($reason);
    }

    public function calculateAccrual(LeaveType $leaveType, float $monthsWorked): float
    {
        if (!$leaveType->accrues()) {
            return 0;
        }

        $annualRate = $leaveType->getAnnualAllowance();
        $monthlyAccrual = $annualRate / 12;

        return $monthlyAccrual * $monthsWorked;
    }
}