CREATE OR REPLACE FUNCTION HIRECHK(hire_date in DATE) RETURN VARCHAR2 AS
    year number;
BEGIN
    year := (LIFEDATE(hire_date) / 365);
    IF year >= 20 THEN
        RETURN '�B�l';
    ELSIF year >= 15 THEN
        RETURN '�n��';
    ELSIF year >= 10 THEN 
        RETURN '�㋉';
    ELSIF year >= 5 THEN 
        RETURN '���';
    ELSE 
        RETURN '���K��';
    END IF;
END HIRECHK;
/
SELECT last_name AS "�]�ƈ���", HIRECHK(hire_date) AS "�E�ƃ��x��"
FROM employees;