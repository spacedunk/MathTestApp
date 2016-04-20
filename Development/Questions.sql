DELIMITER //
CREATE PROCEDURE Question_Insert
(
	IN p_type 			varchar(10),
	IN p_title			varchar(500),
	IN p_author			int(6),
	IN p_description 	text,
	IN p_text			text,
	IN p_answer			varchar(250)
)
BEGIN
	INSERT INTO Questions
	(
		`TYPE`,
		`TITLE`,
		`AUTHOR`,
		`DESCRIPTION`,
		`TEXT`,
		`ANSWER`
	)
	VALUES 
	(
		p_type,
		p_title,
		p_author,
		p_description,
		p_text,
		p_answer
	);
END  //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE Question_Update
(
	IN p_id 			int(11)
	IN p_type 			varchar(10),
	IN p_title			varchar(500),
	IN p_author			int(6),
	IN p_description 	text,
	IN p_text			text,
	IN p_answer			varchar(250)
)
BEGIN
	UPDATE Questions
	SET `TYPE` 			= p_type,
		`TITLE` 		= p_title,
		`AUTHOR` 		= p_author,
		`DESCRIPTION` 	= p_description,
		`TEXT` 			= p_text,
		`ANSWER`		= p_answer
	WHERE 
		'ID' 			= p_id; 
END  //
DELIMITER ;


