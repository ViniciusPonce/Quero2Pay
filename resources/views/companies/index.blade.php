@extends('layouts.front')

@section('content')

<div class="card" style="top: 60px; border-radius: 5px;" >
    <div class="card-body">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-dark btn-sm" style="border-radius: 15px" onclick="history.go(-1);">
                    <i class="bi bi-arrow-left-short"></i>
                    Voltar
                </button>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{url('companies-register')}}" class="btn btn-sm" style="border-radius: 15px; background-color: #4682B4;color: white" role="button" aria-pressed="true">
                    <i class="bi bi-plus-lg"></i>
                    Nova Empresa
                </a>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <h1 style="font-size: 40px; font-weight: bold">Empresas</h1>
        </div>
        <div class="text-center">
            <h4>Busca Personalizada</h4>
        </div>
        <div class="row">
            <div class="col">
                <form class="form-group" id="formCompanyId">
                    <div class="form-group mb-3">
                        <label>Digite o ID da empresa</label>
                        <input type="number" class="form-control" id="inputIdCompany" placeholder="ID">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mb-3" style="border-radius: 20px; background-color: #4682B4;color: white" >Pesquisar</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <form class="form-group" id="formCompanyName">
                    <div class="form-group mb-3">
                        <label>Digite o nome da empresa</label>
                        <input type="text" class="form-control" id="inputNameCompany" placeholder="Nome">
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
            <table id="tableCompanies" class="table table-sm text-center table-hover" style="border-radius: 25px; height: auto; max-width: 100%; overflow: scroll">
                <thead>
                <tr style="font-size: 15px">
                    <th scope="col">C??digo</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endere??o</th>
                    <th scope="col">Telefone</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <nav id="paginator">
                    <ul class="pagination">

                    </ul>
                </nav>
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

    function constructLine(companies){
        var line = `<tr style="font-size: 15px">` +
            `<td>` + `${companies.id}` + `</td>` +
            `<td>` + `${companies.nome}` + `</td>` +
            `<td>` + `${companies.rua}` + ' - ' + `${companies.bairro}` + ' - ' + `${companies.cidade}` + ' - ' + `${companies.estado}` + `</td>` +
            `<td>` + `${companies.telefone}` + `</td>` +
            `<td>` +
            '<button type="button" title="Visualizar" class="btn btn-flat btn-sm pull-right" ' + ' onclick="showCompanies('+ companies.id +')" style="background-color: #2d995b; color: white">' + '<i class="fa fa-list" aria-hidden="true"></i>' + '</button>' +
            '<button type="button" title="Excluir" class="btn btn-flat btn-sm btn-danger pull-right" ' + ' onclick="deleteCompanies('+ companies.id +')" >' + '<i class="fa fa-trash " aria-hidden="true"></i>' + '</button>' +
            `</td>` +
            "</tr>";
        return line;
    }

    function getItemProximo(data){
        i = data.current_page + 1;
        if ( data.last_page == data.current_page){
            line = '<li class="page-item disabled">'
        }else {
            line = '<li class="page-item">'
            line += '<a class="page-link"  ' + 'pagina="' + i +'" href="#">Pr??ximo</a></li>'
        }
        return line;
    }

    function getItemAnterior(data){
        i = data.current_page - 1;
        if ( 1 == data.current_page)
            line = '<li class="page-item disabled">'
        else
            line = '<li class="page-item">'
            line += '<a class="page-link"  ' + 'pagina="' + i +'" href="#">Anterior</a></li>'

        return line;
    }

    function getItem(data, i){
        if (i == data.current_page)
            line = '<li class="page-item active">'
        else
            line = '<li class="page-item">'
            line += '<a class="page-link" ' + 'pagina="' + i +'"  href="#">' + i +'</a></li>'

        return line;
    }

    function constructPaginator(data){
        $("#paginator>ul>li").remove();
        $("#paginator>ul").append(getItemAnterior(data))
        n = 10
        if (data.current_page - n/2 <= 1)
            start = 1;
        else if (data.last_page - data.current_page < n)
            start = data.last_page - n + 1;
        else
            start = data.current_page - n/2;

        end = start + n - 1;
        for(i=start; i<=end;i++){
            line = getItem(data, i);
            $('#paginator>ul').append(line)
        }
        $("#paginator>ul").append(getItemProximo(data))
    }

    function constructTable(companies){
        $("#tableCompanies>tbody>tr").remove();
            for(i=0; i < companies.data.length; i++){
                line = constructLine(companies.data[i]);
                $('#tableCompanies>tbody').append(line);
            }
    }

    function searchCompanies(pagina){
        $.getJSON('/api/companies',{page:pagina}, function(companies){
            constructTable(companies);
            constructPaginator(companies)
            $("#paginator>ul>li>a").click(function(){
                searchCompanies($(this).attr('pagina'))
            })
        })
    }

    function deleteCompanies(id){
            Swal.fire({
                title: 'Deletar Empresa?',
                text: 'Ap??s deletar esta empresa os funcion??rios tambem ser??o deletados',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#006400',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/companies/' + id,
                    }).done(function(data){
                        if (data.success) {
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Empresa deletada com sucesso',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
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
                }
            })
    }

    function constructLineFilter(companies){
        var line = `<tr style="font-size: 15px">` +
            `<td>` + `${companies.id}` + `</td>` +
            `<td>` + `${companies.nome}` + `</td>` +
            `<td>` + `${companies.rua}` + ' - ' + `${companies.bairro}` + ' - ' + `${companies.cidade}` + ' - ' + `${companies.estado}` + `</td>` +
            `<td>` + `${companies.telefone}` + `</td>` +
            `<td>` +
            '<button type="button" title="Visualizar" class="btn btn-flat btn-sm pull-right" ' + ' onclick="showCompanies('+ companies.id +')" style="background-color: #2d995b; color: white">' + '<i class="fa fa-list" aria-hidden="true"></i>' + '</button>' +
            '<button type="button" title="Excluir" class="btn btn-flat btn-sm btn-danger pull-right" ' + ' onclick="deleteCompanies('+ companies.id +')" >' + '<i class="fa fa-trash " aria-hidden="true"></i>' + '</button>' +
            `</td>` +
            "</tr>";
        return line;
    }

    function searchInputIDFilter() {
        $('#formCompanyName')[0].reset();
        $.ajax({
            type: 'GET',
            url: '/api/companies/' + Number($("#inputIdCompany").val())
        }).done(function (companies) {
            if (companies.success) {
                console.log(companies.data)
                $('#paginator').remove();
                if ($('#tableCompanies>tbody>tr').text() !== "") {
                    $('#tableCompanies>tbody>tr').remove();
                }
                line = constructLineFilter(companies.data);
                $('#tableCompanies>tbody').append(line);
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
                    text: 'Empresa n??o cadastrada',
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
        $('#formCompanyId')[0].reset();
        $.ajax({
            type: 'GET',
            url: '/api/companies/name/' + $("#inputNameCompany").val()
        }).done(function (data) {
            if (data.success) {
                $('#paginator').remove();
                if ($('#tableCompanies>tbody>tr').text() !== "") {
                    $('#tableCompanies>tbody>tr').remove();
                }
                for (i = 0; i < data.data.length; i++) {
                    line = constructLineFilter(data.data[i]);
                    $('#tableCompanies>tbody').append(line);
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
                    text: 'Empresa n??o cadastrada',
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

    function showCompanies(id){
        $.getJSON('/api/companies/' + id, function(companies){
            location.href = 'companies-show/' + id;
        })

    }

    $('#formCompanyId').submit( function(event){
        event.preventDefault();
        searchInputIDFilter();
    })

    $('#formCompanyName').submit( function(event){
        event.preventDefault();
        searchInputNameFilter();
    })

    $(document).ready(function(){
        searchCompanies();
    })
</script>
@endsection
