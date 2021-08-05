@extends('layouts.front')

@section('content')
    <div class="card" style="top: 120px">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-dark btn-sm" style="border-radius: 15px" onclick="history.go(-1);">
                        <i class="bi bi-arrow-left-short"></i>
                        Voltar
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <h1 style="font-size: 40px; font-weight: bold">Informações da Empresa</h1>
            </div>
            <div class="w-100 p-5 justify-content-center">
                <form class="form-group" id="formEmpresa">
                    <!-- Text input -->
                    <div class="form mb-4">
                        <label class="form-label" for="nome">Nome da Empresa</label>
                        <input type="text" id="nome" class="form-control border"  disabled="true"/>
                    </div>

                    <!-- Text input -->
                    <div class="form-group mb-4">
                        <label class="form-label" for="form6Example3">CEP</label>
                        <input type="text" id="cep" class="form-control border" disabled="true"/>
                    </div>

                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="form6Example1">Rua</label>
                                <input type="text" id="rua" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="form6Example2 ">Numero</label>
                                <input type="text" id="numero" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                    </div>

                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="form6Example1">Cidade</label>
                                <input type="text" id="cidade" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="form6Example2">Estado</label>
                                <input type="text" id="uf" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                    </div>

                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-group ">
                                <label class="form-label" for="bairro">Bairro</label>
                                <input type="text" id="bairro" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label" for="telefone">Telefone</label>
                                <input type="text" id="telefone" class="form-control border" disabled="true"/>
                            </div>
                        </div>
                    </div>
                    <!-- Message input -->
                    <div class="form-group mb-4 ">
                        <label class="form-label" for="complemento">Complemento do Endereço</label>
                        <textarea class="form-control border" id="complemento" rows="4" disabled="true"></textarea>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a class="btn btn-sm" style="border-radius: 15px; background-color: #4682B4;color: white" role="button" aria-pressed="true" data-toggle="modal" data-target="#modalFuncionario">
                                <i class="bi bi-plus-lg"></i>
                                Novo Funcionário
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h1 style="font-size: 40px; font-weight: bold">Funcionários</h1>
                    </div>
                    <div class="m-sm-4">
                        <table id="tableEmployees" class="table table-responsive table-sm text-center table-hover border-primary" style="border-radius: 25px; height: auto; max-width: 100%; overflow: scroll">
                            <thead>
                            <tr style="font-size: 15px">
                                <th scope="col">Código</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Salário</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </form>
                <div id="modalFuncionario" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h5 class="modal-title">Dados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="w-100 p-5 justify-content-center">
                                    <form class="form-group">
                                        <!-- Text input -->
                                        <div class="form mb-4">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="text" id="modalNome" class="form-control border" />
                                        </div>

                                        <!-- Text input -->
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="form6Example3">Cargo</label>
                                            <input type="text" id="modalCargo" class="form-control border" />
                                        </div>

                                        <!-- Text input -->
                                        <div class="form-group mb-4">
                                            <label class="form-label maskMoney" for="form6Example3">Salario</label>
                                            <input type="text" id="modalSalario" class="form-control border" />
                                        </div>

                                        <!-- Text input -->
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="form6Example3">Empresa</label>
                                            <input type="text" id="modalEmpresa" class="form-control border" disabled="true"/>
                                        </div>
                                    </form>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="createEmployee()" style="border-radius: 18px; background-color: #4682B4;" >Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function showCompany(){
        var url = location.href;
        var id = Number(url.replace(/^.*\//g, ''));
        $.getJSON('/api/companies/' + id, function(companies){
            $('#nome').val(companies.data.nome)
            $('#cep').val(companies.data.cep)
            $('#rua').val(companies.data.rua)
            $('#numero').val(companies.data.numero)
            $('#cidade').val(companies.data.cidade)
            $('#uf').val(companies.data.estado)
            $('#bairro').val(companies.data.bairro)
            $('#telefone').val(companies.data.telefone)
            $('#complemento').val(companies.data.complemento)
            $('#modalEmpresa').val(companies.data.id + ' - ' + companies.data.nome)
        })
    }

    function constructLine(employees){
        console.log(employees)
        var line = `<tr style="font-size: 15px">` +
            `<td>` + `${employees.id}` + `</td>` +
            `<td>` + `${employees.nome}` + `</td>` +
            `<td>` + `${employees.cargo}` + `</td>` +
            `<td>` + `${employees.salario}` + `</td>` +
            "</tr>";
        return line;
    }

    function searchEmployees(){
        var url = location.href;
        var id = Number(url.replace(/^.*\//g, ''));
        $.getJSON('/api/employees/show/' + id, function(employees){
            for(i=0; i < employees.length; i++){
                // console.log(employees.length)
                line = constructLine(employees[i]);
                $('#tableEmployees>tbody').append(line);
            }
        })
    }

    $(function(){
        $("#modalSalario").maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            thousands: '.',
            decimal: ','
        });
    });

    function createEmployee(){
        var url = location.href;
        var id = Number(url.replace(/^.*\//g, ''));
        if ($("#modalNome").val() === "" || $('#modalSalario').val()=== "") {
            Swal.fire({
                title: 'Oops!',
                text: 'Preencha os campos',
                icon: 'warning',
                showConfirmButton: false,
                timer: 2000
            })
            location.stop();
        }
        var value = $("#modalSalario").maskMoney('unmasked')[0]
        employee = {
            nome: $('#modalNome').val(),
            cargo: $('#modalCargo').val(),
            salario: value,
            empresa_id: id,
        };
        console.log(id);
        $.ajax({
            type: 'POST',
            url: '/api/employees',
            data: employee,
        }).done(function(data){
            if (data.success){
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Funcionario cadastrado com sucesso',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
                // location.reload();
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }else{
                Swal.fire({
                    title: 'Oops!',
                    text: 'Verifique os dados e tente novamente',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }).fail(function(){
            Swal.fire({
                title: 'Erro!',
                text: 'Houve um erro no processo',
                icon: 'error',
                showConfirmButton: false,
                timer: 2000
            })
        });
    };


    $(document).ready(function(){
        showCompany()
        searchEmployees()
    })

</script>
@endsection
