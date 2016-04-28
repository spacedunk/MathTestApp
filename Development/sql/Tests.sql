DELIMITER //
CREATE PROCEDURE Test_Insert
(
	IN p_title					varchar(500),
	IN p_author					int(6),
	IN p_class					varchar(100),
	IN p_description 			text,
	IN p_creation_date			date
)
BEGIN
	INSERT INTO Tests
	(
		`TITLE`,
		`AUTHOR`,
		`CLASS`,
		`DESCRIPTION`,
		`CREATION_DATE`
	)
	VALUES 
	(
		 p_title,
		 p_author,
		 p_class,
		 p_description,
		 p_creation_date
	);
END  //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE Test_Update
(
	IN p_id 					int(11),
	IN p_title					varchar(500),
	IN p_author					int(6),
	IN p_class					varchar(100),
	IN p_description 			text,
	IN p_creation_date			date
)
BEGIN
	UPDATE Tests
	SET `TITLE` 				= p_title,
		`AUTHOR`				= p_author,
		`CLASS`					= p_class,
		`DESCRIPTION`			= p_description,
		`CREATION_DATE`			= p_creation_date
	WHERE 
		'ID' 					= p_id; 
END  //
DELIMITER ;


