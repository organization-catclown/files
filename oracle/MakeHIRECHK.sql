CREATE OR REPLACE FUNCTION HIRECHK(hire_date in DATE) RETURN VARCHAR2 AS
    year number;
BEGIN
    year := (LIFEDATE(hire_date) / 365);
    IF year >= 20 THEN
        RETURN '’Bl';
    ELSIF year >= 15 THEN
        RETURN 'n—û';
    ELSIF year >= 10 THEN 
        RETURN 'ã‹‰';
    ELSIF year >= 5 THEN 
        RETURN 'ˆê”Ê';
    ELSE 
        RETURN 'Œ©K‚¢';
    END IF;
END HIRECHK;
/
SELECT last_name AS "]‹Æˆõ–¼", HIRECHK(hire_date) AS "E‹ÆƒŒƒxƒ‹"
FROM employees;