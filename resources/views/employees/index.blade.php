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
                <h1 style="font-size: 40px; font-weight: bold">Funcionários</h1>
            </div>
            <div class="m-sm-4">
                <table id="tableCompanies" class="table table-responsive table-sm text-center table-hover border-primary" style="border-radius: 25px; height: auto; max-width: 100%; overflow: scroll">
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
        </div>
    </div>
@endsection
