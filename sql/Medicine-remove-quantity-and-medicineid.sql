ALTER TABLE `RxChart`.`Medicine`
    DROP FOREIGN KEY `fk_Pillbox`;
ALTER TABLE `RxChart`.`Medicine`
    DROP COLUMN `Quantity`,
    DROP COLUMN `MedicineId`,
    DROP INDEX `fk_Pillbox_idx` ;

