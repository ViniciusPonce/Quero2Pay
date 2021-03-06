@extends('layouts.front')

@section('content')
    <div class="card" style="top: 60px">
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
                <h1 style="font-size: 40px; font-weight: bold">Cadastro da Empresa</h1>
            </div>
            <div class="w-100 p-5 justify-content-center">
            <form class="form-group" id="formEmpresa">
                <!-- Text input -->
                <div class="form mb-4">
                    <label class="form-label" for="nome">Nome da Empresa</label>
                    <input type="text" id="nome" class="form-control border" />
                </div>

                <!-- Text input -->
                <div class="form-group mb-4">
                    <label class="form-label" for="form6Example3">CEP</label>
                    <input type="text" id="cep" class="form-control border" />
                </div>

                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label" for="form6Example1">Rua</label>
                            <input type="text" id="rua" class="form-control border" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label" for="form6Example2 ">Numero</label>
                            <input type="text" id="numero" class="form-control border" />
                        </div>
                    </div>
                </div>

                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label" for="form6Example1">Cidade</label>
                            <input type="text" id="cidade" class="form-control border" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label" for="form6Example2">Estado</label>
                            <input type="text" id="uf" class="form-control border" />
                        </div>
                    </div>
                </div>

                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-group ">
                            <label class="form-label" for="bairro">Bairro</label>
                            <input type="text" id="bairro" class="form-control border" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label" for="telefone">Telefone</label>
                            <input type="text" id="telefone" class="form-control border telefone" />
                        </div>
                    </div>
                </div>
                <!-- Message input -->
                <div class="form-group mb-4 ">
                    <label class="form-label" for="complemento">Complemento do Endere??o</label>
                    <textarea class="form-control border" id="complemento" rows="4"></textarea>
                </div>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="border-radius: 18px; background-color: #4682B4;">Cadastrar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    jQuery("input.telefone")
        .mask("(99) 9999-9999?9").focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });

    $(document).ready(function() {

        function cleanForm() {
            // Limpa valores do formul??rio de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
        }
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova vari??vel "cep" somente com d??gitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Express??o regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado n??o foi encontrado.
                                cleanForm();
                                alert("CEP n??o encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep ?? inv??lido.
                        cleanForm();
                        alert("Formato de CEP inv??lido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formul??rio.
                    cleanForm();
                }
            });
        });
    function createCompany(){
        if ($("#nome").val() === "" || $("#cep").val() === "") {
            Swal.fire({
                title: 'Oops!',
                text: 'Preencha os campos',
                icon: 'warning',
                showConfirmButton: false,
                timer: 2000,
            })
            location.stop();
        }
        company = {
            nome: $("#nome").val(),
            cep: $("#cep").val(),
            rua: $("#rua").val(),
            bairro: $("#bairro").val(),
            cidade: $("#cidade").val(),
            estado: $("#uf").val(),
            numero: $("#numero").val(),
            complemento: $("#complemento").val(),
            telefone: $("#telefone").val()
        };

        $.ajax({
            type: 'POST',
            url: '/api/companies',
            data: company,
        }).done(function(data){
            if (data.success){
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Empresa cadastrada com sucesso',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                })
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

    $('#formEmpresa').submit( function(event){
        event.preventDefault();
        createCompany();
    })
</script>
@endsection
