@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Valores Conceptos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($valoresConceptos, ['route' => ['valoresConceptos.update', $valoresConceptos->id], 'method' => 'patch']) !!}

                        @include('valores_conceptos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection