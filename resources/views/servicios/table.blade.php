<table class="table table-responsive" id="servicios-table">
    <thead>
        <tr>
            <th>Tipo de Servicio</th>
        <th>Descripción</th>
        <th>Valor</th>
        <th>Icono</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($servicios as $servicios)
        <tr>
            <td>{!! $servicios->tipo_servicios_id !!}</td>
            <td>{!! $servicios->descripcion !!}</td>
            <td>{!! $servicios->valor !!}</td>
            <td>
            <img src="{{$servicios->icono}}" width="100"></td>
            <td>
                {!! Form::open(['route' => ['servicios.destroy', $servicios->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('servicios.show', [$servicios->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('servicios.edit', [$servicios->id]) !!}" class='btn btn-default btn-xl'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xl', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>