<div class="row row-tutor">
    <div class="col d-flex flex-column flex-shrink-0" style="padding: 20px;">

        <p class="fw-bold mb-3">Listado de actividades</p>

        <div class="overflow-scroll table-responsive">
            <table class="table table-bordered text-start table-striped" style="font-size: 12px">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">N° DE SESIÓN</th>
                        <th scope="col">TEMA</th>
                        <th scope="col">DESCRIPCIÓN DE LA ACTIVIDAD</th>
                        <th scope="col">FECHA</th>
                        <th scope="col">TIEMPO</th>
                        <th scope="col">RECURSOS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($actividades as $index => $actividad)
                        <tr>
                            <th class="text-center">{{ $index + 1 }}</th>
                            <td>{{ ucfirst($actividad->tema) }}</td>
                            <td>{{ ucfirst($actividad->descripcion_actividad) }}</td>
                            <td>{{ $actividad->fecha->format('d/m/Y') }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($actividad->tiempo)->format('H:i') }} hrs
                            </td>
                            <td>{{ ucfirst($actividad->recursos) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No hay actividades registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>