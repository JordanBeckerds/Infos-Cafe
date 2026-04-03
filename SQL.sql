-- Users table (was User_Info)
CREATE TABLE `Users` (
    `Id`                    BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `FirstName`             VARCHAR(100)    NOT NULL,
    `LastName`              VARCHAR(100)    NOT NULL,
    `Email`                 VARCHAR(255)    NOT NULL UNIQUE,
    `Password`              VARCHAR(255)    NOT NULL,
    `Phone`                 VARCHAR(30)     NOT NULL,
    `PostalCode`            VARCHAR(20)     NOT NULL,
    `Address`               VARCHAR(255)    NOT NULL,
    `is_verified`              TINYINT(1)      NOT NULL DEFAULT 0,
    `Token`                 VARCHAR(255)    NULL,
    `SubscribedToAI`        TINYINT(1)      NOT NULL DEFAULT 0,
    `SubscribedToMaintenance` TINYINT(1)    NOT NULL DEFAULT 0,
    `CreatedAt`             TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt`             TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Admins table
CREATE TABLE `Admins` (
    `Id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Username`   VARCHAR(100)    NOT NULL UNIQUE,
    `Email`      VARCHAR(255)    NOT NULL UNIQUE,
    `Phone`      VARCHAR(30)     NOT NULL,
    `Password`   VARCHAR(255)    NOT NULL,
    `CreatedAt`  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt`  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Price reference table
CREATE TABLE `PriceChart` (
    `Id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Type`       VARCHAR(100)    NOT NULL UNIQUE,
    `Price`      DECIMAL(12,2)   NOT NULL DEFAULT 0.00,
    `IsActive`   TINYINT(1)      NOT NULL DEFAULT 1,
    `CreatedAt`  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt`  TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Tracking / follow-up / history table (was Suivi)
CREATE TABLE `FollowUp` (
    `Id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `UserId`      BIGINT UNSIGNED NOT NULL,
    `Type`        VARCHAR(100)    NOT NULL,
    `PriceAtTime` DECIMAL(12,2)   NULL,                    -- snapshot of the price when the event happened
    `OccurredAt`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `CreatedAt`   TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP,
    `UpdatedAt`   TIMESTAMP       NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX `Idx_User_Type`       (`UserId`, `Type`),
    INDEX `Idx_Type_OccurredAt` (`Type`, `OccurredAt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Foreign Keys
ALTER TABLE `FollowUp`
    ADD CONSTRAINT `Fk_FollowUp_User`
        FOREIGN KEY (`UserId`) REFERENCES `Users` (`Id`)
            ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `FollowUp`
    ADD CONSTRAINT `Fk_FollowUp_Type`
        FOREIGN KEY (`Type`) REFERENCES `PriceChart` (`Type`)
            ON DELETE RESTRICT ON UPDATE CASCADE;