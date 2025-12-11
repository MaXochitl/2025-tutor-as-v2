<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS ReporteGeneral;

            CREATE PROCEDURE ReporteGeneral(IN p_periodo_id BIGINT, IN p_carrera_id BIGINT)
            BEGIN
                SELECT
                    (
                        SELECT COUNT(DISTINCT asg.tutor_id)
                        FROM asignacion_tutor asg
                        INNER JOIN tutores t ON t.id = asg.tutor_id
                        WHERE asg.periodo_id = p_periodo_id
                          AND asg.semestre <> 0
                          AND LOWER(asg.grupo) <> 'sin asignar'
                          AND t.carrera_id = p_carrera_id
                    ) AS cantidad_tutores,

                    (
                        SELECT COUNT(DISTINCT pt.alumno_id)
                        FROM periodo_tutorado pt
                        INNER JOIN alumnos a ON a.id = pt.alumno_id
                        INNER JOIN tutores t ON t.id = pt.tutor_id
                        WHERE pt.periodo_id = p_periodo_id
                          AND a.carrera_id = p_carrera_id
                          AND t.carrera_id = p_carrera_id
                    ) AS tutoria_grupal;
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ReporteGeneral;");
    }
};
