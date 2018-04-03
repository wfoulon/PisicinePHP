INSERT INTO ft_table(`login`, `group`, `creation_date`)
    SELECT `last_name` AS login, 'other', `birthdate` AS creation_date FROM user_card
    WHERE LENGTH(`last_name`) < 9 AND `last_name` LIKE '%a%'
    ORDER BY last_name ASC
    LIMIT 10
;
