ALTER TABLE `RxChart`.`MedHistory`
ADD COLUMN `UserId` INT NULL AFTER `MedicineId`;

ALTER TABLE `RxChart`.`Medicine`
ADD COLUMN `UserId` INT NULL AFTER `ResidentId`;

ALTER TABLE `RxChart`.`Resident`
ADD COLUMN `UserId` INT NULL AFTER `Id`;
COMMIT;

UPDATE `RxChart`.`MedHistory` SET UserId = 2 WHERE UserId IS NULL;
UPDATE `RxChart`.`Medicine` SET UserId = 2 WHERE UserId IS NULL;
UPDATE `RxChart`.`Resident` SET UserId = 2 WHERE UserId IS NULL;
COMMIT;

ALTER TABLE `RxChart`.`MedHistory`
CHANGE COLUMN `UserId` `UserId` INT NOT NULL ;
COMMIT;
ALTER TABLE `RxChart`.`MedHistory`
ADD CONSTRAINT `fk_MedHistory_User`
  FOREIGN KEY (`UserId`)
  REFERENCES `RxChart`.`User` (`Id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
COMMIT;

ALTER TABLE `RxChart`.`Medicine`
CHANGE COLUMN `UserId` `UserId` INT NOT NULL;
COMMIT;
ALTER TABLE `RxChart`.`Medicine`
ADD CONSTRAINT `fk_Medicine_User`
  FOREIGN KEY (`UserId`)
  REFERENCES `RxChart`.`User` (`Id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
COMMIT;


ALTER TABLE `RxChart`.`Resident`
CHANGE COLUMN `UserId` `UserId` INT NOT NULL ;
COMMIT;
ALTER TABLE `RxChart`.`Resident`
ADD CONSTRAINT `fk_Resident_User`
  FOREIGN KEY (`UserId`)
  REFERENCES `RxChart`.`User` (`Id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
COMMIT;
