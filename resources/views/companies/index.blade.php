@extends('layouts.front')

@section('content')
<div class="card" style="top: 120px; border-radius: 5px" >
    <div class="card-body">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-dark btn-sm" style="border-radius: 15px" onclick="history.go(-1);">
                    <i class="bi bi-arrow-left-short"></i>
                    Voltar
                </button>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{url('seller-register')}}" class="btn btn-sm" style="border-radius: 15px; background-color: #4682B4;color: white" role="button" aria-pressed="true">
                    <i class="bi bi-plus-lg"></i>
                    Nova Empresa
                </a>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <h1 style="font-size: 40px; font-weight: bold">Empresas</h1>
        </div>
        <div class="m-sm-4">
            <table id="tableCompanies" class="table table-responsive table-sm text-center table-hover border-primary" style="border-radius: 25px">
                <thead>
                <tr style="font-size: 15px">
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Funcionários</th>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function constructLine(companies){
        var line = `<tr>` +
            `<td>` + `${companies.nome}` + `</td>` +
            `<td>` + `${companies.rua}` + ' - ' + `${companies.bairro}` + ' - ' + `${companies.cidade}` + ' - ' + `${companies.estado}` + `</td>` +
            `<td>` + `${companies.telefone}` + `</td>` +
            `<td>` + 'teste' + `</td>` +
            `<td>` +
            `<button class="btn btn-sm btn-primary">` + 'ver mais' + `</button>` +
            `</td>` +
            "</tr>";
        return line;
    }

    function searchCompanies(){
        $.getJSON('/api/companies', function(companies){
            // console.log(companies)
            for(i=0; i < companies.length; i++){
                // console.log(companies[i])
                line = constructLine(companies[i]);
                $('#tableCompanies>tbody').append(line);
            }
        })
    }

    $(document).ready(function(){
        searchCompanies()
    })
</script>
@endsection
