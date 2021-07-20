ALTER TABLE `RxChart`.`Medicine`
    ADD COLUMN `OtherNames` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Other names that the Drug may go by' AFTER `Drug`;
