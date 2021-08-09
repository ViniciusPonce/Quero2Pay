<!-- Modal New Employee -->
<div id="modalFuncionario" class="modal fade" tabindex="-1">
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
                        <div class="form-group">
                            <label>Cargo</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="selectCargo">

                                </select>
                            </div>
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
