# Functional Requirements - ksf_Leave

## Document Information
- **Module**: ksf_Leave
- **Version**: 1.0.0
- **Date**: 2026-05-11
- **Status**: Proposed
- **Author**: KSFII Development Team

## 1. Overview

### 1.1 Purpose
ksf_Leave provides leave request management, approval workflows, and balance tracking.

### 1.2 Scope
- Leave request submission
- Manager approval
- Balance tracking
- Accrual calculation
- Calendar integration

## 2. Core Entities

### 2.1 LeaveType

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| code | string | Yes | V01, S01, P01, B01 |
| name | string | Yes | Vacation, Sick, Personal, Bereavement |
| accrual_rate | float | No | Days per month |
| max_carryover | int | No | Max days to carry over |
| requires_document | bool | Yes | Default false |
| is_active | bool | Yes | Default true |

### 2.2 LeaveBalance

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| leave_type_id | string | Yes | FK to LeaveType |
| year | int | Yes | Year |
| entitlement | float | Yes | Days allocated |
| used | float | Yes | Days used |
| pending | float | Yes | Days pending |
| available | float | Yes | Computed: entitlement - used - pending |

### 2.3 LeaveRequest

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| leave_type_id | string | Yes | FK to LeaveType |
| start_date | Date | Yes | Start date |
| end_date | Date | Yes | End date |
| days | float | Yes | Number of days |
| reason | string | No | Reason for leave |
| status | string | Yes | pending/approved/rejected/cancelled |
| approver_id | string | No | User who approved |
| approved_at | DateTime | No | Approval timestamp |
| comments | string | No | Approval comments |
| created_at | DateTime | Yes | Auto |
| updated_at | DateTime | Yes | Auto |

### 2.4 LeaveEntitlement

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| id | string | Yes | UUID |
| employee_id | string | Yes | FK to Employee |
| leave_type_id | string | Yes | FK to LeaveType |
| year | int | Yes | Year |
| entitlement | float | Yes | Days entitled |
| effective_date | Date | Yes | When entitlement starts |

## 3. Functional Requirements

### FR-LV-001: Leave Request
**Requirement**: System shall allow employees to submit leave requests.

**Features**:
- Select leave type
- Enter date range
- Calculate business days
- Add notes/reason
- Check balance availability
- Auto-create calendar event (tentative)

### FR-LV-002: Leave Approval
**Requirement**: System shall route leave requests for approval.

**Features**:
- Route to manager (from HRM/OrgChart)
- Manager approve/reject with comments
- HR can override
- Escalation after timeout

### FR-LV-003: Balance Tracking
**Requirement**: System shall track leave balances.

**Features**:
- Per-employee, per-type, per-year
- Real-time available calculation
- Pending deduction
- History of changes

### FR-LV-004: Accrual Processing
**Requirement**: System shall process leave accruals.

**Features**:
- Monthly accrual calculation
- Based on employment type and tenure
- Automatic balance updates
- Annual carryover processing

### FR-LV-005: Calendar Integration
**Requirement**: System shall integrate with calendar.

**Features**:
- Approved leave on calendar
- Block employee's time
- Conflict detection

## 4. Activity Codes

| Code | Name | Rate | Liability |
|------|------|------|-----------|
| V01 | Vacation | 1.0× | Vacation Liability |
| S01 | Sick | 1.0× | Sick Liability |
| P01 | Personal | 1.0× | Personal Liability |
| B01 | Bereavement | 1.0× | Payable |

## 5. Integration Events (PSR-14)

| Event | Trigger |
|-------|---------|
| `leave.requested` | New request submitted |
| `leave.approved` | Request approved |
| `leave.rejected` | Request rejected |
| `leave.cancelled` | Request cancelled |
| `leave.escalation` | Request escalated |

## 6. Composer Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| ksfraser/exceptions | ^1.3 | Exception hierarchy |
| psr/event-dispatcher | ^2.0 | PSR-14 events |

---

*Document Version: 1.1.0*
*Last Updated: 2026-05-11*