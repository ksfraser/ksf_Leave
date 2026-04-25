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