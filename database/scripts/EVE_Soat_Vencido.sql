DROP EVENT IF EXISTS EVE_VERIFICAR_SEGUROS;
DELIMITER $$
CREATE EVENT EVE_VERIFICAR_SEGUROS
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR
DO
BEGIN
	DECLARE cursor_List_isdone BOOLEAN DEFAULT FALSE;
    DECLARE cur_automovilId, cur_diferenciaDias INT;

    DECLARE cursor_List CURSOR FOR
		SELECT a.id, DATEDIFF(current_timestamp, a.AUT_Fecha_Vencimiento_Soat_Automovil)
		FROM TBL_Automovil as a;

   DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursor_List_isdone = TRUE;
   
   OPEN cursor_List;

	loop_List: LOOP
		FETCH cursor_List INTO cur_automovilId, cur_diferenciaDias;
      
		IF cursor_List_isdone THEN
			LEAVE loop_List;
		END IF;

		IF cur_diferenciaDias <= -8 THEN
			call taxmendez.PRD_ENVIAR_NOTIFICACION(cur_automovilId, 8);
		END IF;
        
        IF cur_diferenciaDias <= -3 THEN
			call taxmendez.PRD_ENVIAR_NOTIFICACION(cur_automovilId, 3);
		END IF;
        
        IF cur_diferenciaDias >= 0 THEN
			call taxmendez.PRD_ENVIAR_NOTIFICACION(cur_automovilId, 0);
		END IF;
	END LOOP loop_List;

	CLOSE cursor_List;
END $$