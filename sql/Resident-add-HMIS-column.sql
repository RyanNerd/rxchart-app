ALTER TABLE `RxChart`.`Resident`
    ADD COLUMN `HMIS` int NULL AFTER `Notes`,
    ADD COLUMN `EnrollmentId` int NULL DEFAULT NULL AFTER `HMIS`;
