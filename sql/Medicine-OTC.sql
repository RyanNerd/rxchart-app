ALTER TABLE `RxChart`.`Medicine`
    DROP FOREIGN KEY `fk_Medicine_Resident`;
ALTER TABLE `RxChart`.`Medicine`
    ADD COLUMN `OTC` TINYINT NULL DEFAULT 0 AFTER `Notes`,
    CHANGE COLUMN `ResidentId` `ResidentId` INT(11) NULL ;
ALTER TABLE `RxChart`.`Medicine`
    ADD CONSTRAINT `fk_Medicine_Resident`
        FOREIGN KEY (`ResidentId`)
            REFERENCES `RxChart`.`Resident` (`Id`);
