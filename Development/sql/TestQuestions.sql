DELIMITER //
CREATE PROCEDURE Add_Question_to_Test
(
	IN p_tid 			int(11),
	IN p_qid			int(11),
	IN p_QNum			int(3)
)
BEGIN
	INSERT INTO TEST_QUESTIONS
	(
		`T_ID`,
		`Q_ID`,
		`QuestionNumber`
	)
	VALUES 
	(
		 p_tid,
		 p_qid,
		 p_QNum			
	);
END  //

CREATE PROCEDURE Update_Question_Number
(
	IN p_tid 			int(11),
	IN p_qid			int(11),
	IN p_QNum			int(3)
)
BEGIN
	UPDATE TEST_QUESTIONS
	SET	QuestionNumber = p_QNum
	WHERE T_ID = p_tid and Q_ID = p_qid;
END  //

CREATE PROCEDURE Remove_Question_from_Test
(
	IN p_tid 			int(11),
	IN p_qid			int(11)
)
BEGIN
	DELETE FROM TEST_QUESTIONS WHERE T_ID = p_tid and Q_ID = p_qid; 
END  //

CREATE PROCEDURE Get_Test_Questions
(
	IN p_tid 			int(11)
)
BEGIN
	SELECT QuestionNumber,Title,Description from Questions AS Q INNER JOIN TEST_QUESTIONS AS TQ ON TQ.Q_ID = Q.ID WHERE TQ.T_ID = p_tid; 
END  //
DELIMITER ;


