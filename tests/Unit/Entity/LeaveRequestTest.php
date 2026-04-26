<?php

declare(strict_types=1);

namespace Ksf\Leave\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksf\Leave\Entity\LeaveRequest;

class LeaveRequestTest extends TestCase
{
    public function testCanCreateLeaveRequest(): void
    {
        $request = new LeaveRequest();
        $this->assertInstanceOf(LeaveRequest::class, $request);
    }

    public function testCanSetAndGetEmployeeId(): void
    {
        $request = new LeaveRequest();
        $request->setEmployeeId(1);
        $this->assertEquals(1, $request->getEmployeeId());
    }

    public function testCanSetAndGetLeaveType(): void
    {
        $request = new LeaveRequest();
        $request->setLeaveTypeId(5);
        $this->assertEquals(5, $request->getLeaveTypeId());
    }

    public function testCanSetStartAndEndDates(): void
    {
        $request = new LeaveRequest();
        $request->setStartDate('2024-07-01');
        $request->setEndDate('2024-07-05');
        $this->assertEquals('2024-07-01', $request->getStartDate());
        $this->assertEquals('2024-07-05', $request->getEndDate());
    }

    public function testCanCalculateDays(): void
    {
        $request = new LeaveRequest();
        $request->setStartDate('2024-07-01');
        $request->setEndDate('2024-07-05');
        $this->assertEquals(5, $request->getDays());
    }

    public function testCanSetStatus(): void
    {
        $request = new LeaveRequest();
        $request->setStatus(LeaveRequest::STATUS_PENDING);
        $this->assertEquals(LeaveRequest::STATUS_PENDING, $request->getStatus());
    }

    public function testCanCheckIfApproved(): void
    {
        $request = new LeaveRequest();
        $request->setStatus(LeaveRequest::STATUS_APPROVED);
        $this->assertTrue($request->isApproved());
        
        $request->setStatus(LeaveRequest::STATUS_REJECTED);
        $this->assertFalse($request->isApproved());
    }

    public function testCanCheckIfPending(): void
    {
        $request = new LeaveRequest();
        $request->setStatus(LeaveRequest::STATUS_PENDING);
        $this->assertTrue($request->isPending());
    }
}