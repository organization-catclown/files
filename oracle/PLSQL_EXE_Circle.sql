DECLARE
    r Number;
    area Number;
BEGIN
    r := &Hankei;
    PLSQL_CIRCLE(r,area);
    DBMS_OUTPUT.PUT_LINE('���a' || r || '�̉~�̖ʐς�' || area || '�ł��B');
END;