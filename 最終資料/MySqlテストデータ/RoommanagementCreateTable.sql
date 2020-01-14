DROP DATABASE RoomManagementSystem;
CREATE DATABASE RoomManagementSystem DEFAULT CHARACTER SET=utf8;
USE RoomManagementSystem;

CREATE TABLE Classes(
    ClassCode   TINYINT UNSIGNED PRIMARY KEY,
    ClassName   VARCHAR(30) NOT NULL
)DEFAULT CHARACTER SET=utf8;


CREATE TABLE Reasons(
    ReasonCode  TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    Reason      VARCHAR(20)
)DEFAULT CHARACTER SET=utf8;


CREATE TABLE Teachers(
    TeacherCode SMALLINT PRIMARY KEY,
    TeacherName VARCHAR(20) NOT NULL,
    ClassCode   TINYINT UNSIGNED,
    Email       VARCHAR(100),
    CONSTRAINT FK_Class FOREIGN KEY(ClassCode) REFERENCES Classes(ClassCode)
)DEFAULT CHARACTER SET=utf8;


CREATE TABLE Rooms(
    RoomCode		TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    RoomName    	VARCHAR(40) NOT NULL,
    AvailableClass      TINYINT UNSIGNED
)DEFAULT CHARACTER SET=utf8;


CREATE TABLE Students(
    StudentNumber INT PRIMARY KEY,
    SchoolYear    TINYINT UNSIGNED,
    ClassCode     TINYINT UNSIGNED,
    Name1         VARCHAR(40) NOT NULL,
    Name2         VARCHAR(50) NOT NULL,
    Flag          BOOLEAN DEFAULT FALSE,
    Expiration    DATE NOT NULL,
    CONSTRAINT FK_ClassCode FOREIGN KEY(ClassCode) REFERENCES Classes(ClassCode)
)DEFAULT CHARACTER SET=utf8;


CREATE TABLE RoomManagements(
    StudentNumber       INT,
    RoomCode            TINYINT UNSIGNED,
    EntryTeacherCode    SMALLINT,
    EntryTime           DATETIME,
    LeavingTeacherCode  SMALLINT,
    LeavingTime         TIME,
    ReasonCode          TINYINT UNSIGNED,
    EndDate		DATETIME,
    EndFlag             BOOLEAN,
    CONSTRAINT FK_StudentNumber FOREIGN KEY(StudentNumber) REFERENCES Students(StudentNumber),
    CONSTRAINT FK_RoomCode FOREIGN KEY(RoomCode) REFERENCES Rooms(RoomCode),
    CONSTRAINT FK_EntryTeacherCode FOREIGN KEY(EntryTeacherCode) REFERENCES Teachers(TeacherCode),
    CONSTRAINT FK_LeavingTeacherCode FOREIGN KEY(LeavingTeacherCode) REFERENCES Teachers(TeacherCode),
    CONSTRAINT FK_ReasonCode FOREIGN KEY(ReasonCode) REFERENCES Reasons(ReasonCode)
)DEFAULT CHARACTER SET=utf8;

CREATE TABLE KeyTable(
    KeyName	VARCHAR(20) PRIMARY KEY,
    UseKey      BOOLEAN
)DEFAULT CHARACTER SET=utf8;

