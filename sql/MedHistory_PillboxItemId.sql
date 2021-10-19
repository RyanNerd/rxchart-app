ALTER TABLE `RxChart`.`MedHistory`
    ADD COLUMN `PillboxItemId` INT NULL DEFAULT NULL AFTER `MedicineId`,
    ADD INDEX `fk_MedHistory_PillboxItem_idx` (`PillboxItemId` ASC) VISIBLE;
;
ALTER TABLE `RxChart`.`MedHistory`
    ADD CONSTRAINT `fk_MedHistory_PillboxItem`
        FOREIGN KEY (`PillboxItemId`)
            REFERENCES `RxChart`.`PillboxItem` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;
