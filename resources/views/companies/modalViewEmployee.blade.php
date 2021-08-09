<!-- Modal View Employees -->
<div id="modalViewFuncionario" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">Dados</h5>
                <button  type="button" class="btn" onclick="closeModalViewEmployee()">×</button>
            </div>
            <div class="modal-body">
                <div class="w-100 p-5 justify-content-center">
                    <form class="form-group">
                        <!-- Text input -->
                        <div class="form mb-4">
                            <label class="form-label" for="nome">Nome</label>
                            <input type="text" id="modalViewNome" class="form-control border" disabled="true"/>
                        </div>

                        <!-- Text input -->
                        <div class="form mb-4">
                            <label class="form-label" for="cargo">Cargo</label>
                            <input type="text" id="modalViewCargo" class="form-control border" disabled="true"/>
                        </div>

                        <!-- Text input -->
                        <div class="form-group mb-4">
                            <label class="form-label maskMoney" for="salario">Salario</label>
                            <input type="text" id="modalViewSalario" class="form-control border" disabled="true"/>
                        </div>

                        <!-- Text input -->
                        <div class="form-group mb-4">
                            <label class="form-label" for="empresa">Empresa</label>
                            <input type="text" id="modalViewEmpresa" class="form-control border" disabled="true"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
