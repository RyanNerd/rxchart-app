CREATE TABLE `RxChart`.`Pillbox`
(
    `Id`          INT          NOT NULL AUTO_INCREMENT,
    `UserId`      INT          NOT NULL,
    `ResidentId`  INT          NOT NULL,
    `Description` VARCHAR(100) NOT NULL,
    `Created`     TIMESTAMP    NULL DEFAULT NULL,
    `Updated`     TIMESTAMP    NULL DEFAULT NULL,
    `deleted_at`  TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (`Id`),
    INDEX `fk_Pillbox_user` (`UserId`) VISIBLE,
    INDEX `fk_Pillbox_resident` (`ResidentId` ASC) VISIBLE,
    CONSTRAINT `fk_Pillbox_User`
        FOREIGN KEY (`UserId`)
            REFERENCES `RxChart`.`User` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_Pillbox_Resident`
        FOREIGN KEY (`ResidentId`)
            REFERENCES `RxChart`.`Resident` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
);
