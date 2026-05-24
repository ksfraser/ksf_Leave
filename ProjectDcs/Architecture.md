# Architecture - ksf_Leave

## Document Information
- **Module**: ksf_Leave
- **Version**: 1.0.0
- **Date**: 2026-05-24
- **Status**: Draft
- **Author**: KSFII Development Team

---

## 1. Module Overview

ksf_Leave provides leave request management, approval workflows, balance tracking, and accrual processing for employee time-off management.

### 1.1 Namespace
```php
Ksfraser\Leave\
```

### 1.2 Layer Pattern
```
ksf_Leave/                   → Business Logic
    ├── Entity/              → Domain entities
    ├── Service/             → Business services
    ├── Repository/          → Data access interfaces
    └── Exception/           → Domain exceptions
```

---

## 2. Core Entities

### 2.1 LeaveRequest
```php
class LeaveRequest {
    private string $id;
    private string $employeeId;
    private string $leaveTypeId;
    private \DateTime $startDate;
    private \DateTime $endDate;
    private LeaveStatus $status;         // pending, approved, rejected, cancelled
    private ?string $reason;
    private ?string $approverId;
    private ?\DateTime $approvedAt;
    private ?string $approverNotes;
    private ?string $medicalCertificateUrl;
}
```

### 2.2 LeaveBalance
```php
class LeaveBalance {
    private string $id;
    private string $employeeId;
    private int $year;
    private string $leaveTypeId;
    private float $total;
    private float $used;
    private float $remaining;
}
```

### 2.3 LeaveAccrual
```php
class LeaveAccrual {
    private string $id;
    private string $employeeId;
    private string $leaveTypeId;
    private \DateTime $accrualDate;
    private float $amount;
    private string $source;              // monthly_accrual, carryover, adjustment
}
```

---

## 3. RBAC Integration (ksfraser/rbac)

### 3.1 Module Registration

ksf_Leave registers with ksfraser/rbac:
- record_types: 'leave_request', 'leave_balance'
- projections: 'public' (dates, type, status), 'full' (all fields including reason, medical_certificate, approver_notes)
- allow_invite: false

### 3.2 Entity Projections

| Entity | PUBLIC Fields | FULL Fields |
|--------|---------------|-------------|
| LeaveRequest | start_date, end_date, leave_type, status | + reason, medical_certificate, approver_notes, approver_id, approved_at, comments |
| LeaveBalance | year, leave_type, total, used, remaining | + accrual_history, adjustment_log, carryover_details |

### 3.3 Access Model

- **Employee**: Create own requests, view own requests at PROJECTION_FULL, view own balance
- **Manager**: View team leave requests at PROJECTION_FULL, approve/reject
- **HR**: View all leave requests at PROJECTION_FULL, override approvals, manage balances
- **Payroll**: View approved leave for pay calculation (PROJECTION_PUBLIC on balance)

### 3.4 SQL Enforcement

Standard RBAC JOIN pattern for leave_request and leave_balance queries.

### 3.5 Soft Delete

- Leave requests use soft delete: cancelled requests set deleted=1, deleted_by, deleted_at
- Hard delete is super-admin only
- Leave balance records are never deleted (audit requirement)

### 3.6 Calendar Integration

Approved leave automatically creates calendar events via PSR-14 event (`leave.approved`). Calendar visibility is gated by ksf_Calendar's RBAC.

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-24*
