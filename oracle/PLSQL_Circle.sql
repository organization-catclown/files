CREATE OR REPLACE PROCEDURE PLSQL_Circle(r in Number, area out Number) IS
BEGIN
    area := r * r * 3.141592;
END;

