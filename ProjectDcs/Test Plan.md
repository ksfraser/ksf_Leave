# Test Plan - ksf_Leave

## Document Information
- **Module**: ksf_Leave
- **Version**: 1.0.0
- **Date**: 2026-05-11
- **Test Framework**: PHPUnit 10.x

## 1. Test Strategy

### 1.1 Coverage Target
- 100% line/branch coverage
- Exception classes excluded

### 1.2 Test Categories
- Entity validation tests
- Service tests with mocked dependencies

## 2. Test Structure

```
ksf_Leave/tests/
├── bootstrap.php
└── Unit/
    ├── Entity/
    │   ├── LeaveTypeTest.php
    │   ├── LeaveBalanceTest.php
    │   └── LeaveRequestTest.php
    └── Service/
        └── LeaveServiceTest.php
```

## 3. Test Cases

### 3.1 LeaveTypeTest

| Test | Description |
|------|-------------|
| testCreateLeaveType | Valid type created |
| testActivityCodeValidation | Unique codes |
| testAccrualRateValidation | Non-negative rate |

### 3.2 LeaveBalanceTest

| Test | Description |
|------|-------------|
| testCalculateAvailable | available = entitlement - used - pending |
| testDeductLeave | Used increases, available decreases |
| testRestoreLeave | Cancelled request restores balance |
| testPendingDeduction | Pending decreases available |
| testYearReset | New year, balance reset |

### 3.3 LeaveRequestTest

| Test | Description |
|------|-------------|
| testCreateRequest | Valid request created |
| testBusinessDaysCalculation | Correct day count |
| testDateValidation | End before start throws |
| testApproveRequest | Status → approved |
| testRejectRequest | Status → rejected |
| testCancelRequest | Status → cancelled |

### 3.4 LeaveServiceTest

| Test | Description |
|------|-------------|
| testSubmitLeaveRequest | Creates request, checks balance |
| testInsufficientBalance | ValidationException |
| testApproveLeave | Updates balance, status, emits event |
| testRejectLeave | Status updated, no balance change |
| testAccrualProcessing | Monthly accrual job |
| testEscalationCheck | Identifies overdue requests |

## 4. Integration with Other Modules

| Module | Mock |
|--------|------|
| ksf_HRM | EmployeeServiceInterface |
| ksf_Workflow | EventDispatcherInterface |
| ksf_Calendar | CalendarServiceInterface |

## 5. Quality Gates

- [ ] All unit tests pass
- [ ] Code coverage ≥ 80%
- [ ] phpstan level 8 passes
- [ ] phpcs passes PSR-12

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*