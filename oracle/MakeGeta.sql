CREATE OR REPLACE FUNCTION GETA(sal IN Number) RETURN NUMBER IS
BEGIN
    RETURN (sal + 15000);
END GETA;
/
SELECT last_name, salary AS "���󋋗^", GETA(salary) AS "���葝�����^" FROM employees;