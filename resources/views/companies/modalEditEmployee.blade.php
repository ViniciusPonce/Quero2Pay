<!-- Modal Edit Employees -->
<div id="modalEditFuncionario" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">Dados</h5>
                <button  type="button" class="btn" onclick="closeModalViewEmployee()">×</button>
            </div>
            <div class="modal-body">
                <div class="w-100 p-5 justify-content-center">
                    <form class="form-group">
                        <input type="hidden" id="modalEditId" class="form-control border" />
                        <!-- Text input -->
                        <div class="form mb-4">
                            <label class="form-label" for="nome">Nome</label>
                            <input type="text" id="modalEditNome" class="form-control border" />
                        </div>

                        <!-- Text input -->
                        <div class="form-group">
                            <label>Cargo</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="selectEditCargo">

                                </select>
                            </div>
                        </div>

                        <!-- Text input -->
                        <div class="form-group mb-4">
                            <label class="form-label maskMoney" for="salario">Salario</label>
                            <input type="text" id="modalEditSalario" class="form-control border"/>
                        </div>

                        <!-- Text input -->
                        <div class="form-group mb-4">
                            <label class="form-label" for="empresa">Empresa</label>
                            <input type="text" id="modalEditEmpresa" class="form-control border" disabled="true"/>
                        </div>
                    </form>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="updateEmployee()" style="border-radius: 18px; background-color: #4682B4;" >Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
