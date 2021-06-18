CREATE TABLE `RxChart`.`PillboxItem`
(
    `Id`         INT NOT NULL AUTO_INCREMENT,
    `UserId`     INT NOT NULL,
    `PillboxId`  INT NOT NULL,
    `MedicineId` INT NOT NULL,
    `ResidentId` INT NOT NULL,
    PRIMARY KEY (`Id`),
    INDEX `fk_Pillbox_User` (`UserId`) VISIBLE,
    INDEX `fk_PillboxItem_Pillbox_idx` (`PillboxId` ASC) VISIBLE,
    INDEX `fk_PillboxItem_Medicine_idx` (`MedicineId` ASC) VISIBLE,
    INDEX `fk_PillboxItem_Resident_idx` (`ResidentId` ASC) VISIBLE,
    CONSTRAINT `fk_PillboxItem_User`
        FOREIGN KEY (`UserId`)
            REFERENCES `RxChart`.`User` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_PillboxItem_Pillbox`
        FOREIGN KEY (`PillboxId`)
            REFERENCES `RxChart`.`Pillbox` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_PillboxItem_Medicine`
        FOREIGN KEY (`MedicineId`)
            REFERENCES `RxChart`.`Medicine` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_PillboxItem_Resident`
        FOREIGN KEY (`ResidentId`)
            REFERENCES `RxChart`.`Resident` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
);
