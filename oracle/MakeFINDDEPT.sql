CREATE OR REPLACE FUNCTION FINDDEPT(emp_id in VARCHAR2) RETURN VARCHAR2 IS
    department_name departments.department_name%type;
BEGIN
    SELECT department_name INTO department_name FROM departments d, employees e 
    WHERE e.employee_id = emp_id AND d.department_id = e.department_id;
    RETURN department_name;
END FINDDEPT;
/
SELECT last_name AS "]‹Æˆõ–¼" , FINDDEPT(employee_id) AS "Š‘®•”–¼"
FROM	employees;