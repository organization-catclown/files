CREATE OR REPLACE FUNCTION LIFEDATE(hire_date in DATE) RETURN Number IS
BEGIN
    RETURN TRUNC((CURRENT_DATE() - hire_date));
END LIFEDATE;
/
SELECT last_name AS "�]�ƈ���", LIFEDATE(hire_date) AS "�o�ߓ���" FROM employees;