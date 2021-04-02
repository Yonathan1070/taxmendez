DROP PROCEDURE IF EXISTS PRD_ENVIAR_NOTIFICACION;
DELIMITER $$
CREATE PROCEDURE PRD_ENVIAR_NOTIFICACION(IN automovilId INT, IN cantidad INT)
BEGIN
	DECLARE cursor_List_isdone BOOLEAN DEFAULT FALSE;
    DECLARE cur_usuarioId, cur_propietarioId, cur_empresaId INT;
    DECLARE cur_canalHabilitado BOOLEAN;
    DECLARE cur_mensajeNotificacion TEXT;

    DECLARE cursor_List CURSOR FOR
		SELECT u.id, u.USR_Empresa_Id, cnt.CNT_Habilitado_Canal_Notificacion
		FROM TBL_Usuario as u
        JOIN TBL_Automovil_Propietario as ap ON ap.AUT_PRP_Propietario_Id = u.id
        LEFT JOIN TBL_Usuario_Canal_Notificacion as ucn on ucn.USR_CNT_Usuario_Id = u.id
        LEFT JOIN TBL_Canal_Notificacion as cnt on cnt.id = ucn.USR_CNT_Canal_Id
		WHERE cnt.CNT_Nombre_Canal_Notificacion like '%web%'
			AND ap.AUT_PRP_Automovil_Id = automovilId;

   DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursor_List_isdone = TRUE;

	OPEN cursor_List;

	loop_List: LOOP
		FETCH cursor_List INTO cur_propietarioId, cur_empresaId, cur_canalHabilitado;
      
		set cur_usuarioId = (SELECT u.id FROM TBL_Usuario as u
		JOIN TBL_Rol_Usuario as ru on ru.USR_RL_Usuario_Id = u.id
		JOIN TBL_Rol as r on r.id = ru.USR_RL_Rol_Id
		WHERE r.RL_Nombre_Rol like 'administrador%' OR r.RL_Slug_Rol like 'administrador%'
			AND USR_Empresa_Id = cur_empresaId
		LIMIT 1);
      
		IF cursor_List_isdone THEN
			LEAVE loop_List;
		END IF;

		IF cur_canalHabilitado = 1 THEN
			IF cantidad = 8 THEN
				SET cur_mensajeNotificacion = 'SoatPrevExpires';
            END IF;
            IF cantidad = 3 THEN
				SET cur_mensajeNotificacion = 'SoatPrevUnoExpires';
            END IF;
            IF cantidad = 0 THEN
				SET cur_mensajeNotificacion = 'SoatExpires';
            END IF;
			INSERT INTO TBL_Notificacion values(
				null,
				cur_usuarioId,
				cur_propietarioId,
				'mdi mdi-calendar',
				'SoatExpires',
				cur_mensajeNotificacion,
				'get',
				'automoviles',
				null,
				null,
				null,
				0,
                current_timestamp(),
                current_timestamp()
			);
		END IF;
	END LOOP loop_List;

	CLOSE cursor_List;
END
$$
