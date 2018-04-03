SELECT REVERSE(SUBSTRING(`phone_number`, 2)) AS 'enohpelet'
FROM `distrib`
WHERE `phone_number` LIKE '05%';
