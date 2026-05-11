<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Leave\Service;

use Ksfraser\Leave\Entity\LeaveRequest;
use Ksfraser\Leave\Entity\LeaveBalance;
use Ksfraser\Leave\Entity\LeaveType;
use Ksfraser\Leave\Service\LeaveService;
use PHPUnit\Framework\TestCase;

class LeaveServiceTest extends TestCase
{
    private LeaveService $service;

    protected function setUp(): void
    {
        $this->service = new LeaveService();
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::validateRequest
     */
    public function testValidateRequestInsufficientBalance(): void
    {
        $request = new LeaveRequest();
        $request->setDays(10.0);

        $balance = new LeaveBalance();
        $balance->setAnnualAllocation(25.0);
        $balance->setUsed(20.0);
        $balance->setPending(0.0);

        $leaveType = new LeaveType();
        $leaveType->setNegativeAllowed(false);

        $result = $this->service->validateRequest($request, $balance, $leaveType);

        $this->assertFalse($result['valid']);
        $this->assertNotEmpty($result['errors']);
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::validateRequest
     */
    public function testValidateRequestExceedsMaxNegative(): void
    {
        $request = new LeaveRequest();
        $request->setDays(15.0);

        $balance = new LeaveBalance();
        $balance->setAnnualAllocation(25.0);
        $balance->setUsed(20.0);

        $leaveType = new LeaveType();
        $leaveType->setNegativeAllowed(true);
        $leaveType->setMaxNegativeBalance(3.0);

        $result = $this->service->validateRequest($request, $balance, $leaveType);

        $this->assertFalse($result['valid']);
        $this->assertNotEmpty($result['errors']);
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::validateRequest
     */
    public function testValidateRequestNegativeWarning(): void
    {
        $request = new LeaveRequest();
        $request->setDays(8.0);

        $balance = new LeaveBalance();
        $balance->setAnnualAllocation(25.0);
        $balance->setUsed(20.0);

        $leaveType = new LeaveType();
        $leaveType->setNegativeAllowed(true);
        $leaveType->setMaxNegativeBalance(5.0);

        $result = $this->service->validateRequest($request, $balance, $leaveType);

        $this->assertTrue($result['valid']);
        $this->assertNotEmpty($result['warnings']);
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::approveRequest
     */
    public function testApproveRequest(): void
    {
        $request = new LeaveRequest();
        $request->setStatus(LeaveRequest::STATUS_PENDING);

        $this->service->approveRequest($request, 999);

        $this->assertSame(LeaveRequest::STATUS_APPROVED, $request->getStatus());
        $this->assertSame(999, $request->getApproverId());
        $this->assertNotNull($request->getApprovedDate());
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::rejectRequest
     */
    public function testRejectRequest(): void
    {
        $request = new LeaveRequest();
        $request->setStatus(LeaveRequest::STATUS_PENDING);

        $this->service->rejectRequest($request, 999, 'Not approved');

        $this->assertSame(LeaveRequest::STATUS_REJECTED, $request->getStatus());
        $this->assertSame(999, $request->getApproverId());
        $this->assertSame('Not approved', $request->getRejectionReason());
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::calculateAccrual
     */
    public function testCalculateAccrualDoesNotAccrue(): void
    {
        $leaveType = new LeaveType();
        $leaveType->setAnnualAllowance(24.0);
        $leaveType->setAccrues(false);

        $result = $this->service->calculateAccrual($leaveType, 6.0);

        $this->assertSame(0.0, $result);
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::calculateAccrual
     */
    public function testCalculateAccrualMonthly(): void
    {
        $leaveType = new LeaveType();
        $leaveType->setAnnualAllowance(12.0);
        $leaveType->setAccrues(true);

        $result = $this->service->calculateAccrual($leaveType, 1.0);

        $this->assertSame(1.0, $result);
    }

    /**
     * @covers Ksfraser\Leave\Service\LeaveService::calculateAccrual
     */
    public function testCalculateAccrualSixMonths(): void
    {
        $leaveType = new LeaveType();
        $leaveType->setAnnualAllowance(24.0);
        $leaveType->setAccrues(true);

        $result = $this->service->calculateAccrual($leaveType, 6.0);

        $this->assertSame(12.0, $result);
    }
}