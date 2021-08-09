@extends('layouts.front')

@section('content')
    <div class="card" style="top: 60px">
        <div class="card-body ">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-dark btn-sm" style="border-radius: 15px" onclick="history.go(-1);">
                        <i class="bi bi-arrow-left-short"></i>
                        Voltar
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <h1 style="font-size: 40px; font-weight: bold">Lista de Funcionários - Geral</h1>
            </div>
            <div class="row">
                <div class="col">
                    <form class="form-group" id="formEmployeeId">
                        <div class="form-group mb-3">
                            <label>Digite o ID da empresa</label>
                            <input type="number" class="form-control" id="inputIdEmployee" placeholder="ID">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3" style="border-radius: 20px; background-color: #4682B4;color: white" >Pesquisar</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form class="form-group" id="formEmployeeName">
                        <div class="form-group mb-3">
                            <label>Digite o nome da empresa</label>
                            <input type="text" class="form-control" id="inputNameEmployee" placeholder="Nome">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3" style="border-radius: 20px; background-color: #4682B4;color: white">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <p>Limpar buscas personalizadas</p>
                <button type="button" class="btn btn-primary mb-3" onclick="location.reload()" style="border-radius: 20px; background-color: #4682B4;color: white" >X</button>
            </div>
            <div class="m-sm-4 table-responsive">
                <table id="tableEmployees" class="table table-sm text-center table-hover">
                    <thead>
                    <tr style="font-size: 15px">
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Salário</th>
                        <th scope="col">Empresa</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function constructLineFilter(employees){
            var line = `<tr style="font-size: 15px">` +
                `<td>` + `${employees.id}` + `</td>` +
                `<td>` + `${employees.nome_funcionario}` + `</td>` +
                `<td>` + `${employees.cargo}` + `</td>` +
                `<td>` + `${employees.salario.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'})}` + `</td>` +
                `<td>` + `${employees.nome}` + `</td>` +
                "</tr>";
            return line;
        }

        function searchEmployeesTable(){
            $.getJSON('/api/employees/list/all', function(employees){
                console.log(employees)
                for(i=0; i < employees.length; i++){
                    line = constructLineFilter(employees[i]);
                    $('#tableEmployees>tbody').append(line);
                }
            })
        }

        function searchInputIDFilter() {
            $('#formEmployeeName')[0].reset();
            $.ajax({
                type: 'GET',
                url: '/api/employees/' + Number($("#inputIdEmployee").val())
            }).done(function (employees) {
                if (employees.success) {
                    console.log(employees.data)
                    if ($('#tableEmployees>tbody>tr').text() !== "") {
                        $('#tableEmployees>tbody>tr').remove();
                    }
                    line = constructLineFilter(employees.data);
                    $('#tableEmployees>tbody').append(line);
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Encontrado com sucesso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Funcionário não encontrado',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }).fail(function () {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Houve um erro no processo',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                })
            })
        }

        function searchInputNameFilter() {
            $('#formEmployeeId')[0].reset();
            $.ajax({
                type: 'GET',
                url: '/api/employees/name/' + $("#inputNameEmployee").val()
            }).done(function (employees) {
                if (employees.success) {
                    if ($('#tableEmployees>tbody>tr').text() !== "") {
                        $('#tableEmployees>tbody>tr').remove();
                    }
                    for (i = 0; i < employees.data.length; i++) {
                        line = constructLineFilter(employees.data[i]);
                        $('#tableEmployees>tbody').append(line);
                    }
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Encontrado com sucesso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Funcionario não encontrado',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }).fail(function () {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Houve um erro no processo',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                })
            })
        }

        $('#formEmployeeId').submit( function(event){
            event.preventDefault();
            searchInputIDFilter();
        })

        $('#formEmployeeName').submit( function(event){
            event.preventDefault();
            searchInputNameFilter();
        })

        $(document).ready(function(){
            searchEmployeesTable()
        })
    </script>
@endsection
