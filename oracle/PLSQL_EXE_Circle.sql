DECLARE
    r Number;
    area Number;
BEGIN
    r := &Hankei;
    PLSQL_CIRCLE(r,area);
    DBMS_OUTPUT.PUT_LINE('îºåa' || r || 'ÇÃâ~ÇÃñ êœÇÕ' || area || 'Ç≈Ç∑ÅB');
END;