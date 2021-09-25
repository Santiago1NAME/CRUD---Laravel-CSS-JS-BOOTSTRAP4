@extends('welcome');
@section('contenido')
<div class="container">
    <div class="card">
        <form class="p-4" action="/empleado/{{ $empleado[0]["id"] }}/edit" method="POST">
            @csrf
            @method('PUT')
            <div class="alert alert-primary col" role="alert">
                Los campos con asteriscos (*) son obligatorios
            </div>
            <div class="form-group row">
                <label for="nombreC" class="col-sm-2 col-form-label">Nombre completo *</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre completo del empleado" value="{{ $empleado[0]["nombres"] }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="correoE" class="col-sm-2 col-form-label">Correo electronico *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="correoE" id="correoE" placeholder="Correo electrónico" value="{{ $empleado[0]["email"] }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="sexo1" class="col-sm-2 col-form-label">Sexo *</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M" {{ $empleado[0]["sexo"] == 'M' ? 'checked': ''}}>
                        <label class="form-check-label" for="sexo1">
                          Masculino
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F" {{ $empleado[0]["sexo"] == 'F' ? 'checked': ''}}>
                        <label class="form-check-label" for="sexo2">
                          Femenino
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Área *</label>
                <div class="col-sm-10">
                    <select class="form-control form-control-lg" name="areaId" id="areaId">
                        <option value="">- Seleccione -</option>
                        @foreach ($areas as $key => $value)
                            <option value="{{ $value["id"] }}" {{ $value["id"] == $empleado[0]["area_id"] ? "selected" : "" }}>{{ $value["nombre"] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descripción *</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="descrip" id="descrip" placeholder="Descripción de la experiencia del empleado">{{ $empleado[0]["descripcion"] }}</textarea>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="deseoR" name="deseoR" {{ $empleado[0]["boletin"] == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="deseoR">Deseo recibir boletín informativo</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Roles *</label>
                <div class="col-sm-10">
                        @foreach ($roles as $key => $value)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rol{{ $value["id"] }}" name="rolF" value="{{ $value["id"] }}">
                                <label class="form-check-label" for="rol{{ $value["id"] }}">{{ $value["nombre"] }}</label>
                            </div>
                        @endforeach
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

</script>
@endsection