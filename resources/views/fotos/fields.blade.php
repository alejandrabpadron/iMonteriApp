<!-- Elementos Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('elementos_id', 'Elementos Id:') !!}
    {!! Form::select('elementos_id', $datos['elementos'], null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', $datos['fotos']->foto, ['class' => 'form-control']) !!}
	<img src="{{$datos['fotos']->foto}}" width="100">
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('fotos.index') !!}" class="btn btn-default">Cancelar</a>
</div>
