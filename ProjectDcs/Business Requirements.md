# Business Requirements - ksf_Leave

## Project Overview
Leave request and approval system that integrates with Calendar.

## Problem Statement
- Employees need to request time off
- Managers need to approve/reject
- Leave balance tracking needed
- Calendar should show approved leave
- Must integrate with Timesheets for reporting

## Stakeholders
- Employees
- Managers
- HR
- Payroll

## Scope

### In Scope
1. **Leave Request**
   - Submit request for dates and type
   - Add notes/reason
   - Link to calendar event

2. **Approval Workflow**
   - Submit to manager
   - Manager approve/reject with comments
   - Escalation rules (if manager unavailable)

3. **Balance Tracking**
   - Vacation days earned/used
   - Sick days earned/used
   - Personal days earned/used
   - Accrual calculation (e.g., 1.67 days/month)

4. **Calendar Integration**
   - Approved leave shows on calendar
   - Blocked time for scheduling

### Out of scope
- Payroll direct integration (timesheet does this)
- Benefits enrollment

## Activity Code Mapping
- V01: Vacation (generates V01 liability)
- S01: Sick
- P01: Personal
- B01: Bereavement

## Approval Rules
- Self-service: employee submits
- Manager: approves/rejects
- HR: can override
- Escalation: after X days auto-escalate

## Integration Dependencies

### Provided To
| Module | Data Provided |
|--------|---------------|
| ksf_Calendar | Approved leave events |
| ksf_Timesheets | Leave hours for reporting |
| ksf_HRM | Leave balance updates |
| ksf_Workflow | Leave approval workflow |

### Consumed From
| Module | Data Consumed |
|--------|---------------|
| ksf_HRM | Employee data, manager relationships |
| ksf_Workflow | Approval routing, escalations |
| ksf_Calendar | Event display, conflict checking |

### Reference Comparisons
- OrangeHRM: Leave Management (request, approval, balance)
- Odoo: Time Off (leave types, allocation, approval)
- SuiteCRM: None (external integration needed)
- vtiger: None (external integration needed)

## Success Metrics
- Leave requests processed within 48 hours
- Zero double-booking of employees
- 100% balance accuracy
- SLA compliance > 95%

## Timeline
- Phase 1: Leave requests and basic approval
- Phase 2: Balance tracking, accrual
- Phase 3: Calendar integration, escalation
- Phase 4: Advanced reporting, policy enforcement

*Document Version: 1.1.0*
*Last Updated: 2026-05-11*