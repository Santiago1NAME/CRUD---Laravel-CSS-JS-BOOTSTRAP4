@extends('welcome');
@section('contenido')
    <h1>Empleados</h1>
    <br>
    <a href="/empleado" class="btn btn-primary">Agregar</a>
    <br>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-success text-center" role="alert">
            {!! Session::get('message') !!}
        </div>
    @endif
    @if(Session::has('delete'))
        <div class="alert alert-danger text-center" role="alert">
            {!! Session::get('delete') !!}
        </div>
    @endif
    @if(Session::has('update'))
        <div class="alert alert-success text-center" role="alert">
            {!! Session::get('update') !!}
        </div>
    @endif
    <br>
    <br>
    <table class="table table-striped" id="empleados">
        <thead  class="text-center">
            <tr>
                <th><i class="fas fa-user"></i> Nombre</th>
                <th><i class="fas fa-at"></i> Email</th>
                <th><i class="fas fa-venus-mars"></i> Sexo</th>
                <th><i class="fas fa-toolbox"></i> Área</th>
                <th><i class="fas fa-envelope"></i> Boletin</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody  class="text-center">
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->nombres }}</td>
                <td>{{ $empleado->email }}</td>
                @if ($empleado->sexo === "M")
                    <td>Masculino</td>
                @else
                    <td>Femenino</td>
                @endif
                <td>{{ $empleado->nombre }}</td>
                @if ($empleado->boletin === 1)
                    <td>Si</td>
                @else
                    <td>No</td>
                @endif
                <td class="text-center"><a href="/empleado/{{ $empleado->id }}"><i class="fas fa-edit" style="color: black"></i></a></td>
                <form action="/empleado/{{ $empleado->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <td class="text-center"><button type="submit" class=" btn fas fa-trash-alt" style="color: black"></button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection