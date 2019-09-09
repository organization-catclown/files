CREATE OR REPLACE FUNCTION LIFEDATE(hire_date in DATE) RETURN Number IS
BEGIN
    RETURN TRUNC((CURRENT_DATE() - hire_date));
END LIFEDATE;
/
SELECT last_name AS "従業員名", LIFEDATE(hire_date) AS "経過日数" FROM employees;