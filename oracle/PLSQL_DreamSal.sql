CREATE OR REPLACE PROCEDURE Dream_sal(sal IN Number) AS
    CURSOR emp_cur IS SELECT last_name, salary FROM Employees;
    Name Employees.last_name%TYPE;
    DSal Employees.salary%TYPE;
BEGIN
    FOR emp IN emp_cur LOOP
        Name := emp.last_name;
        DSal := emp.salary + sal;
        DBMS_OUTPUT.PUT_LINE(Name || 'Ç≥ÇÒÇÃñ≤ÇÃããó^ÇÕ' || DSal || 'Ç≈Ç∑ÅB');
    END LOOP;
END;