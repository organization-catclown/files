CREATE OR REPLACE FUNCTION LIFEDATE(hire_date in DATE) RETURN Number IS
BEGIN
    RETURN TRUNC((CURRENT_DATE() - hire_date));
END LIFEDATE;
/
SELECT last_name AS "è]ã∆àıñº", LIFEDATE(hire_date) AS "åoâﬂì˙êî" FROM employees;