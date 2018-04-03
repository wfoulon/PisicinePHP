SELECT `film`.`title` AS 'Title', `film`.`summary` AS 'Summary', `film`.`prod_year`
FROM `film`
INNER JOIN `genre` ON `genre`.`name` = 'erotic'
WHERE `film`.`id_genre` = `genre`.`id_genre`
ORDER BY `prod_year` DESC;
