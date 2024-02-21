DROP TABLE address;

CREATE TABLE `address` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `recID` int(10) NOT NULL,
  `block` int(10) NOT NULL,
  `lot` int(10) NOT NULL,
  `stat` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO address VALUES("48","1","1","10","1");
INSERT INTO address VALUES("49","2","2","10","1");
INSERT INTO address VALUES("50","3","3","10","1");
INSERT INTO address VALUES("51","4","4","10","1");
INSERT INTO address VALUES("52","5","5","10","0");
INSERT INTO address VALUES("53","6","6","10","1");
INSERT INTO address VALUES("54","7","7","10","1");
INSERT INTO address VALUES("55","8","8","10","0");
INSERT INTO address VALUES("56","9","9","10","1");
INSERT INTO address VALUES("57","10","10","10","1");
INSERT INTO address VALUES("58","7","1","12","1");
INSERT INTO address VALUES("59","2","2","1","1");
INSERT INTO address VALUES("60","11","9","1","1");



DROP TABLE admin_users;

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO admin_users VALUES("1","admin","admin","0","k@gmail.com","0","1");
INSERT INTO admin_users VALUES("2","ken","ken","1","kp@gmail.com","2147483647","1");
INSERT INTO admin_users VALUES("3","kyle","kyle","2","kyle.sanchez5@icloud.com","2147483647","1");
INSERT INTO admin_users VALUES("8","mic","mic","3","kennethpantonilla98@gmail.com","2147483647","1");



DROP TABLE homeowners;

CREATE TABLE `homeowners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO homeowners VALUES("34","kenneth","pantonilla");
INSERT INTO homeowners VALUES("35","jayrald","palmaria");
INSERT INTO homeowners VALUES("36","charlee","pantonilla");
INSERT INTO homeowners VALUES("37","kyle","sanchez");
INSERT INTO homeowners VALUES("38","alwyn","niones");
INSERT INTO homeowners VALUES("39","emmanuelle","salas");
INSERT INTO homeowners VALUES("40","marc","chelvin");
INSERT INTO homeowners VALUES("41","rollievert","gomez");
INSERT INTO homeowners VALUES("42","brian","bronosa");
INSERT INTO homeowners VALUES("43","james","astilla");
INSERT INTO homeowners VALUES("44","DANIELLA KATE","CRUZ");



DROP TABLE officers;

CREATE TABLE `officers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE payment;

CREATE TABLE `payment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Address` int(100) NOT NULL,
  `Month` varchar(225) NOT NULL,
  `Year` year(4) NOT NULL,
  `Amount` int(100) DEFAULT NULL,
  `Receipt` int(100) DEFAULT NULL,
  `CurrDate` date DEFAULT NULL,
  `stat` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1457 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO payment VALUES("1421","48","10","2023","100","321654987","2023-10-19","1");
INSERT INTO payment VALUES("1422","49","10","2023","100","32164897","2023-10-19","1");
INSERT INTO payment VALUES("1423","50","10","2023","100","321654987","2023-10-19","1");
INSERT INTO payment VALUES("1424","51","10","2023","100","321654987","2023-10-19","1");
INSERT INTO payment VALUES("1425","52","10","2023","100","321654987","2023-10-19","1");
INSERT INTO payment VALUES("1426","53","10","2023","100","321654987","2023-10-19","1");
INSERT INTO payment VALUES("1427","54","10","2023","100","32165987","2023-10-19","1");
INSERT INTO payment VALUES("1428","48","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1429","49","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1430","50","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1431","51","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1432","52","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1433","53","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1434","54","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1435","48","12","2023","100","123456789","2023-10-23","1");
INSERT INTO payment VALUES("1436","49","12","2023","100","103654897","2023-10-19","1");
INSERT INTO payment VALUES("1437","50","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1438","51","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1439","52","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1440","53","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1441","54","12","2023","100","9802312","2023-10-23","1");
INSERT INTO payment VALUES("1442","55","10","2023","100","2147483647","2023-10-23","1");
INSERT INTO payment VALUES("1443","56","10","2023","100","32156497","2023-10-19","1");
INSERT INTO payment VALUES("1444","57","10","2023","100","2147483647","2023-10-19","1");
INSERT INTO payment VALUES("1445","55","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1446","56","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1447","57","11","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1448","55","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1449","56","12","2023","300","1231237","2023-10-23","1");
INSERT INTO payment VALUES("1450","57","12","2023","","","2023-10-19","0");
INSERT INTO payment VALUES("1451","58","10","2023","","","2023-10-23","0");
INSERT INTO payment VALUES("1452","58","11","2023","","","2023-10-23","0");
INSERT INTO payment VALUES("1453","58","12","2023","","","2023-10-23","0");
INSERT INTO payment VALUES("1454","59","10","2023","100","2147483647","2023-10-25","1");
INSERT INTO payment VALUES("1455","59","11","2023","","","2023-10-25","0");
INSERT INTO payment VALUES("1456","59","12","2023","","","2023-10-25","0");



DROP TABLE records;

CREATE TABLE `records` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `stat` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO records VALUES("1","kenneth","pantonilla","j1a2y3r4a5l6d7@gmail.com","1");
INSERT INTO records VALUES("2","jayrald","palmaria","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("3","charlee","pantonilla","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("4","kyle","sanchez","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("5","alwyn","niones","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("6","emmanuelle","salas","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("7","marc","chelvin","j1a2y3r4a5l6d7@gmail.com","1");
INSERT INTO records VALUES("8","rollievert","gomez","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("9","jj","bronosa","j1a2y3r4a5l6d7@gmail.com","1");
INSERT INTO records VALUES("10","james","astilla","kennethpantonilla0@gmail.com","1");
INSERT INTO records VALUES("11","DANIELLA KATE","CRUZ","j1a2y3r4a5l6d7@gmail.com","1");



