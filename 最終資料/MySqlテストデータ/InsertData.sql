#Classesテーブル
INSERT INTO Classes(ClassCode,ClassName)
VALUES (1,"IT学科"),(2,"電子学科"),(4,"ゲーム学科"),(8,"CG学科"),
(16,"エアライン学科"),(32,"エアポート学科"),(64,"パイロット学科"),(128,"航空整備士学科");

#Reasonsテーブル
INSERT INTO Reasons(Reason)
VALUES ("就活"),("補講"),("自習"),("その他");

#Roomsテーブル
INSERT INTO Rooms(RoomName,AvailableClass)
VALUES ("412",15),("413",15),("414",15),("415",15),("416",15);

#Studentsテーブル
INSERT INTO Students(StudentNumber,SchoolYear,ClassCode,Name1,Name2,Flag,Expiration)
VALUES (1201715021,3,1,"中山 大和","ナカヤマ ヤマト",FALSE,"2020-4-1"),
(1201715022,3,1,"林 永遠","ハヤシ トワ",FALSE,"2020-4-1");

#Teachersテーブル
INSERT INTO Teachers(TeacherCode,TeacherName,ClassCode,Email)
VALUES (10001,"酒井 正人",1,"sakai@aaaa.com"),
       (10002,"田上 貴之",1,"tanoue@sugarcheesetoast.com");





