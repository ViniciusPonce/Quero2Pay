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
                <a href="{{url('seller-register')}}" class="btn btn-success btn-sm" style="border-radius: 15px" role="button" aria-pressed="true">
                    <i class="bi bi-plus-lg"></i>
                    Nova Empresa
                </a>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <h1 style="font-size: 40px; font-weight: bold">Empresas</h1>
        </div>
        <div class="m-sm-4">
            <table class="table table-responsive table-sm text-center table-hover border-primary" style="border-radius: 25px">
                <thead>
                <tr style="font-size: 18px">
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

@endsection
