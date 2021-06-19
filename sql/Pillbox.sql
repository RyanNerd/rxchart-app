ALTER TABLE `RxChart`.`Medicine`
    ADD COLUMN `MedicineId` INT NULL DEFAULT NULL COMMENT 'Self referencing record when not null indicates it is a child of a pillbox parent record' AFTER `UserId`,
    ADD COLUMN `Pillbox` TINYINT NULL DEFAULT '0' COMMENT 'When true it indicates that this record is a parent pillbox and  If a pillbox the MedicineId MUST be NULL' AFTER `OTC`,
    ADD COLUMN `Quantity` TINYINT NULL COMMENT 'When a child of pillbox (MedicineId !== null) this indicates how many of the medicine is in the pillbox - typically 1 if populated.' AFTER `Pillbox`,
    ADD INDEX `fk_Pillbox_idx` (`MedicineId` ASC) VISIBLE;
;
ALTER TABLE `RxChart`.`Medicine`
    ADD CONSTRAINT `fk_Pillbox`
        FOREIGN KEY (`MedicineId`)
            REFERENCES `RxChart`.`Medicine` (`Id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;
