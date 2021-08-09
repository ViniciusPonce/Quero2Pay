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
        function constructLine(employees){
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
                    line = constructLine(employees[i]);
                    $('#tableEmployees>tbody').append(line);
                }
            })
        }

        $(document).ready(function(){
            searchEmployeesTable()
        })
    </script>
@endsection
