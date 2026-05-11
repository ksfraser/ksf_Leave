<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Leave\Entity;

use Ksfraser\Leave\Entity\LeaveRequest;
use PHPUnit\Framework\TestCase;

class LeaveRequestTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $request = new LeaveRequest();

        $this->assertNull($request->getId());
        $this->assertSame(0, $request->getEmployeeId());
        $this->assertSame(0, $request->getLeaveTypeId());
        $this->assertSame('', $request->getStartDate());
        $this->assertSame('', $request->getEndDate());
        $this->assertSame(0.0, $request->getDays());
        $this->assertSame('', $request->getReason());
        $this->assertSame(LeaveRequest::STATUS_DRAFT, $request->getStatus());
        $this->assertNull($request->getApproverId());
        $this->assertNull($request->getApprovedDate());
        $this->assertNull($request->getRejectionReason());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setEmployeeId
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getEmployeeId
     */
    public function testSetEmployeeId(): void
    {
        $request = new LeaveRequest();
        $result = $request->setEmployeeId(456);

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame(456, $request->getEmployeeId());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setStatus
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getStatus
     */
    public function testStatusConstants(): void
    {
        $this->assertSame('draft', LeaveRequest::STATUS_DRAFT);
        $this->assertSame('pending', LeaveRequest::STATUS_PENDING);
        $this->assertSame('approved', LeaveRequest::STATUS_APPROVED);
        $this->assertSame('rejected', LeaveRequest::STATUS_REJECTED);
        $this->assertSame('cancelled', LeaveRequest::STATUS_CANCELLED);
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setStartDate
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getStartDate
     */
    public function testSetStartDate(): void
    {
        $request = new LeaveRequest();
        $result = $request->setStartDate('2026-06-01');

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame('2026-06-01', $request->getStartDate());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setDays
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getDays
     */
    public function testSetDays(): void
    {
        $request = new LeaveRequest();
        $result = $request->setDays(5.0);

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame(5.0, $request->getDays());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setApproverId
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getApproverId
     */
    public function testSetApproverId(): void
    {
        $request = new LeaveRequest();
        $result = $request->setApproverId(789);

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame(789, $request->getApproverId());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setApprovedDate
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getApprovedDate
     */
    public function testSetApprovedDate(): void
    {
        $request = new LeaveRequest();
        $result = $request->setApprovedDate('2026-05-15');

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame('2026-05-15', $request->getApprovedDate());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveRequest::setRejectionReason
     * @covers Ksfraser\Leave\Entity\LeaveRequest::getRejectionReason
     */
    public function testSetRejectionReason(): void
    {
        $request = new LeaveRequest();
        $result = $request->setRejectionReason('Insufficient coverage');

        $this->assertInstanceOf(LeaveRequest::class, $result);
        $this->assertSame('Insufficient coverage', $request->getRejectionReason());
    }
}