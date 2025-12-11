<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS ReportesCarrera;

            CREATE PROCEDURE ReportesCarrera(IN p_periodo_id BIGINT, IN p_carrera_id BIGINT)
            BEGIN
                SELECT 
                    t.id AS tutor_id,
                    CONCAT(t.nombre, ' ', t.ap_paterno, ' ', t.ap_materno) AS tutor_nombre,
                    CONCAT(asg.semestre, '° ', asg.grupo) AS grupo,
                
                    COALESCE((
                        SELECT COUNT(DISTINCT pt.alumno_id)
                        FROM periodo_tutorado pt
                        INNER JOIN alumnos a 
                            ON a.id = pt.alumno_id
                        WHERE pt.periodo_id = p_periodo_id
                        AND pt.tutor_id = t.id
                        AND pt.semestre = asg.semestre
                        AND pt.tipo = 1        
                        AND a.grupo = asg.grupo           
                        AND a.carrera_id = p_carrera_id
                    ), 0) AS tutorias_grupales
                    
                FROM tutores t
                INNER JOIN asignacion_tutor asg  
                    ON asg.tutor_id = t.id 
                    AND asg.periodo_id = p_periodo_id
                    AND asg.semestre <> 0
                    AND LOWER(asg.grupo) <> 'sin asignar'
                WHERE t.carrera_id = p_carrera_id
                ORDER BY asg.semestre ASC, asg.grupo ASC, tutor_nombre ASC;
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ReportesCarrera;");
    }
};
