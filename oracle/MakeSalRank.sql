CREATE OR REPLACE FUNCTION SalRank(salary in Number) RETURN VARCHAR2 AS
    CURSOR emp_cur IS SELECT salary FROM employees;
    rank number := 1;
BEGIN
    FOR cur IN emp_cur LOOP
        IF cur.salary > salary THEN
            rank := rank + 1;
        END IF;
    END LOOP;
    RETURN rank;
END SalRank;
/
SELECT   last_name AS "è]ã∆àıñº" , SALRANK(salary) AS "ããó^èáà "
FROM	 employees
ORDER BY 2;