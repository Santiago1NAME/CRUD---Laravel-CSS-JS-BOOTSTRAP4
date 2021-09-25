@extends('welcome');
@section('contenido')
<div class="container">
    <div class="card">
        <form class="p-4" action="/empleado/create" method="POST">
            @csrf
            <div class="alert alert-primary col" role="alert">
                Los campos con asteriscos (*) son obligatorios
            </div>
            <div class="form-group row">
                <label for="nombreC" class="col-sm-2 col-form-label">Nombre completo *</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre completo del empleado">
                  <small id="nombreCS" hidden="true" class="form-text text-muted">Por favor ingresar su nombre</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="correoE" class="col-sm-2 col-form-label">Correo electronico *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="correoE" id="correoE" placeholder="Correo electrónico">
                    <small id="correoES"  hidden="true" class="form-text text-muted">Por favor ingresar su correo electronico</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="sexo1" class="col-sm-2 col-form-label">Sexo *</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="M">
                        <label class="form-check-label" for="sexo1">
                          Masculino
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="F">
                        <label class="form-check-label" for="sexo2">
                          Femenino
                        </label>
                    </div>
                    <small id="sexoS" class="form-text text-muted">Por favor seleccione su sexo</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Área *</label>
                <div class="col-sm-10">
                    <select class="form-control form-control-lg" name="areaId" id="areaId">
                        <option value="">- Seleccione -</option>
                        @foreach ($areas as $key => $value)
                            <option value="{{ $value["id"] }}">{{ $value["nombre"] }}</option>
                        @endforeach
                    </select>
                    <small id="areaIdS" class="form-text text-muted">Por favor seleccione su área</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descripción *</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="descrip" id="descrip" placeholder="Descripción de la experiencia del empleado"></textarea>
                    <small id="descripS"  hidden="true" class="form-text text-muted">Por favor diligencia la descripción</small>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="deseoR" name="deseoR">
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
                    <button type="submit" class="btn btn-primary" disabled="true">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var nombreC = document.getElementById("nombreC");
    var nombreCS = document.getElementById("nombreCS");

    var correoF = document.getElementById("correoE");
    var correoFS = document.getElementById("correoES");

    var sexoF = document.getElementById("sexo");
    var sexoFS = document.getElementById("sexoS");

    var areaIdF = document.getElementById("areaId");
    var areaIdFS = document.getElementById("areaIdS");

    var descripF = document.getElementById("descrip");
    var descripFS = document.getElementById("descripS");
    var button = document.querySelector(".btn");

    nombreC.addEventListener('change', (event) => {
        if(nombreC.value == ""){
            nombreCS.hidden = false;
        }else{
            nombreCS.hidden = true;
        }
    });
    correoF.addEventListener('change', (event) => {
        if(correoF.value == ""){
            correoFS.hidden = false;
        }else{
            correoFS.hidden = true;
        }
    });
    /*sexoF.addEventListener('change', (event) => {
        if(nombreC.value == ""){
            sexoFS.hidden = false;
        }else{
            nombsexoFSreCS.hidden = true;
        }
    });
    areaIdF.addEventListener('change', (event) => {
        if(nombreC.value == ""){
            areaIdFS.hidden = false;
        }else{
            areaIdFS.hidden = true;
        }
    });*/
    descripF.addEventListener('change', (event) => {
        if(descripF.value == ""){
            descripFS.hidden = false;
        }else{
            descripFS.hidden = true;
        }
    });
</script>
@endsection