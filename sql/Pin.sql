CREATE TABLE `RxChart`.`Pin` (
    `Id` INT NOT NULL AUTO_INCREMENT,
    `ResidentId` int NOT NULL,
    `UserId` INT NOT NULL,
    `PinValue` CHAR(6) NOT NULL,
    `Image` VARCHAR(6000) DEFAULT NULL,
    `Created` TIMESTAMP NULL DEFAULT NULL,
    `Updated` TIMESTAMP NULL DEFAULT NULL,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    CONSTRAINT `fk_Pin_User`
     FOREIGN KEY (`UserId`)
         REFERENCES `RxChart`.`User` (`Id`)
         ON DELETE NO ACTION
         ON UPDATE NO ACTION,
    CONSTRAINT `fk_Pin_Resident`
        FOREIGN KEY (`ResidentId`)
            REFERENCES `RxChart`.`Resident` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
);
