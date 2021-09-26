@extends('welcome');
@section('contenido')
<div class="container">
    <div class="card">
        <form class="p-4" action="/empleado/create" method="POST" id="formC">
            @csrf
            <div class="alert alert-primary col" role="alert">
                Los campos con asteriscos (*) son obligatorios
            </div>
            <div class="form-group row">
                <label for="nombreC" class="col-sm-2 col-form-label">Nombre completo *</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nombreC" id="nombreC" placeholder="Nombre completo del empleado" value="{{ old('nombreC') }}">
                  @error('nombreC')
                    <small id="nombreCS" class="form-text text-muted">{{ $message }}</small>
                  @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="correoE" class="col-sm-2 col-form-label">Correo electronico *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="correoE" placeholder="Correo electrónico" value="{{ old('email') }}">
                    @error('email')
                        <small id="emailS" class="form-text text-muted">{{ $message }}</small>
                    @enderror
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
                    @error('sexo')
                        <small id="sexo" class="form-text text-muted">{{ $message }}</small>
                    @enderror
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
                    @error('areaId')
                        <small id="areaId" class="form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Descripción *</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="descrip" id="descrip" placeholder="Descripción de la experiencia del empleado" value="{{ old('descrip') }}"></textarea>
                    @error('descrip')
                        <small id="descripS" class="form-text text-muted">{{ $message }}</small>
                    @enderror
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
                                <input class="form-check-input checkboxD" type="checkbox" id="rol{{ $value["id"] }}" name="rolF[]" value="{{ $value["id"] }}">
                                <label class="form-check-label" for="rol{{ $value["id"] }}">{{ $value["nombre"] }}</label>
                            </div>
                        @endforeach
                    <button type="submit" class="btn btn-primary" disabled id="btnSubmit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

    //Validamos los eventos keyup y click para ejecutar la función validarForm()
    window.addEventListener("keyup", validarForm);
    window.addEventListener("click", validarForm);

    var nombreC = document.getElementById("nombreC");
    var nombreCS = document.getElementById("nombreCS");

    var correoF = document.getElementById("correoE");
    var correoFS = document.getElementById("emailS");

    var descripF = document.getElementById("descrip");
    var descripFS = document.getElementById("descripS");


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
    descripF.addEventListener('change', (event) => {
        if(descripF.value == ""){
            descripFS.hidden = false;
        }else{
            descripFS.hidden = true;
        }
    });
    /*
        Función que nos permite validar si los campos (input, textarea, radio, select) estan diligenciados
    */
    function validarForm() {

        //Consultamos los campos inputs
        var inputs = document.getElementsByTagName("input");
        //Consultamos los campos textareas
        var textareas = document.getElementsByTagName("textarea");
        var camposLlenos = true;
        var checkR = false;
        var chex = false;

        for (var i = 0; i < inputs.length; i++) {
            //Validamos que los campos input de tipo text esten diligenciados
            if (inputs[i].type === "text" && !inputs[i].value) {
                camposLlenos = false;
            }

            //Validamos que los campos input de tipo radio esten diligenciados
            if (inputs[i].type === "radio" && inputs[i].checked) {
                checkR = true;
            }

            //Validamos que los campos input de tipo checkbox esten diligenciados
            if (inputs[i].type === "checkbox" && inputs[i].checked) {
                chex = true;
            }

        }

        if (!checkR) {
            camposLlenos = false;
        }

        if (!chex) {
            camposLlenos = false;
        }

        for (var j = 0; j < textareas.length; j++) {
            if (!textareas[j].value) {
                camposLlenos = false;
            }
        }

        if (camposLlenos) {
            document.getElementById("btnSubmit").disabled = false;
        } else {
            document.getElementById("btnSubmit").disabled = true;
        }
    }
</script>
@endsection