
<form class="modal" id="modalAlterar" style="margin:80px auto;height:700px;" >
    <div class="modal-dialog" style="max-height:400px;">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="fecharModal()">×</button>
                <h4 class="modal-title">Alterar Imóvel</h4>
            </div>
            <!-- Fim do Cabeçalho -->
            <!-- Corpo do Modal -->
            <div class="modal-body" style="max-height:700px;">

                <!-- tela1 - Dados Pesoais-->
                <div id="tela1_a" >
                    <h3 style="text-align:center">Dados Pessoais</h3><br>
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input name="email_I" id="email_I" class="form-control" type="email" maxlength="60" value='<?php echo "$email_I" ?>' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input name="nome_I" id="nomeUsuario_I" class="form-control" type="text" value='<?php echo "$nome_I" ?>'>
                    </div>
                </div><!-- fim tela1 -->
                <!-- tela2 - Dados de Negociação-->
                <div id="tela2_a" class="invisivel" style="display:none">
                    <h3 style="text-align:center">Dados de Negociação</h3><br>
                    <div class="form-group">
                        <label class="control-label">Título do Anúncio</label>
                        <input name="tituloImovel_I" id="tituloImovel_I" class="form-control" type="text" maxlength="80" value=' <?php echo "$tituloImovel_I" ?>' required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de imóvel</label>
                        <select name="tipoImovel_I" class="form-control" required>

                            <option disabled>---------- Residencial ----------</option>
                            <!-- Exibindo os tipos de imóveisdo BD-->
                            <?php 
                                while( $row = mysqli_fetch_array($resultResidencial) )
                                {
                                    $option = $row['nome_tipoImovel'];
                                    $option = strtoupper(substr($option,0,1)) . substr($option,1) ;
                                    if($option == $tipoImovel_I)
                                    {
                                        echo "<option selected>$option</option>";
                                    }
                                    else
                                    {
                                        echo "<option>$option</option>";   
                                    }
                                }
                                    
                            ?>
                            <option disabled>---------- Comercial ----------</option>
                            <?php 
                                while( $row = mysqli_fetch_array($resultComercial) )
                                    $option = $row['nome_tipoImovel'];
                                    $option = strtoupper(substr($option,0,1)) . substr($option,1) ;
                                    if($option == $tipoImovel_I)
                                    {
                                        echo "<option selected>$option</option>";
                                    }
                                    else
                                    {
                                        echo "<option>$option</option>";   
                                    }
                            ?>
                            <option disabled>---------- Rural ----------</option>
                            <?php 
                                while( $row = mysqli_fetch_array($resultRural) )
                                     $option = $row['nome_tipoImovel'];
                                    $option = strtoupper(substr($option,0,1)) . substr($option,1) ;
                                    if($option == $tipoImovel_I)
                                    {
                                        echo "<option selected>$option</option>";
                                    }
                                    else
                                    {
                                        echo "<option>$option</option>";   
                                    }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Negócio</label>
                        <select name="tipoNegocio_I" class="form-control" required>

                            <!-- Selecionand o Tipo de Negócio -->
                            <?php
                                if($tipoNegocio_I == 'Venda')
                                    echo "<option selected> $tipoNegocio_I </option>";
                                else
                                    echo "<option> Venda </option>";

                                if($tipoNegocio_I == 'Locação')
                                    echo "<option selected> $tipoNegocio_I </option>";
                                else
                                    echo "<option> Locação </option>";

                                if($tipoNegocio_I == 'Venda e Locação')
                                    echo "<option selected> $tipoNegocio_I </option>";
                                else
                                    echo "<option> Venda e Locação </option>";

                                if($tipoNegocio_I == 'Troca')
                                    echo "<option selected> $tipoNegocio_I </option>";
                                else
                                    echo "<option> Troca </option>";

                                if($tipoNegocio_I == 'Imóvel na planta')
                                    echo "<option selected> $tipoNegocio_I </option>";
                                else
                                    echo "<option> Imóvel na planta </option>";
                                
                            ?>

                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Valor R$</label>
                        <input name="valorImovel_I" id="valorImovel_I" class="form-control" type="number" onKeyPress="if(this.value.length>7){alert('Preço Máximo:R$9.999.999,99');this.value=''}" required>
                    </div>
                </div><!-- fim tela2 -->
                <!-- tela3 - Localização-->
                <div id="tela3_a" class="invisivel" style="display:none">
                    <h3 style="text-align:center">Localização</h3><br>

                    <!-- linha 1 (Cidade,UF) -->
                    <div class="form-group">
                        
                        <div class="col-xs-8 doisCamposEsq">
                            <label class="control-label">Cidade</label>
                            <input name="cidadeImovel_I" id="cidadeImovel_I" class="form-control form-check-input" type="text" maxlength="40" required>    
                        </div>
                        
                        <div class="col-xs-4 doisCamposDir">
                            <label class="control-label">UF</label>
                            <select name="ufImovel_I" class="form-control form-check-input" required>

                                <option> ES </option>
                                <option>MG </option>
                                <option> RJ </option>
                                <option selected>SP</option>
                            
                            </select>  
                        </div>
                        
                        
                    </div><!-- fim linha 1 -->

                    <!-- linha 2 (Logradouro, Endereço) -->
                    <div class="form-group">
                        
                        <div class="col-xs-4 doisCamposEsq">
                            
                            <label class="control-label">Logradouro</label>
                            <select name="logradouroImovel_I" class="form-control form-check-input" required>

                                <option> Alameda </option>
                                <option>Avenida </option>
                                <option> Beco </option>
                                <option>Praça </option>
                                <option selected> Rua </option>
                                <option>Travessa </option>
                            
                            </select>   

                        </div>
                        
                        <div class="col-xs-8 doisCamposDir">
                            <label class="control-label">Endereço</label>
                            <input name="enderecoImovel_I" id="enderecoImovel_I" class="form-control form-check-input" type="text" maxlength="80" required>
                            
                        </div>

                    </div><!-- fim linha 2 -->

                    <!-- linha 3 (Número, Complemento) -->
                    <div class="form-group">
                        
                        <div class="col-xs-4 doisCamposEsq">
                            
                            <label class="control-label">Número</label>
                            <input name="numeroImovel_I" id="numeroImovel_I" class="form-control form-check-input" type="number" required min="1">
                            

                        </div>
                        
                        <div class="col-xs-8 doisCamposDir">
                            <label class="control-label">Complemento</label>
                            <input name="complementoImovel_I" id="complementoImovel_I" class="form-control form-check-input" type="text" maxlength="50" required>
                            
                        </div>

                    </div><!-- fim linha 3 -->

                    <!-- linha 4 (Bairro) -->
                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input name="bairroImovel_I" id="bairroImovel_I" class="form-control" type="text" style="width:100%" maxlength="50" required>
                    </div>
                </div><!-- fim tela3 -->
            </div>
            <!-- Fim do Corpo -->
            <!-- Botões do Modal -->
            <div class="modal-footer">
                <a class="btn btn-default" onclick="fecharModal()">Cancelar</a>
                <button type="button" class="btn btn-primary" onClick="voltar_a( 'tela1_a' , 'tela2_a', 'tela3_a')">
                    Voltar
                </button>
                <button type="button" class="btn btn-primary" onClick="proximo_a( 'tela1_a' , 'tela2_a', 'tela3_a')">
                    Próximo
                </button>
                <button class="btn btn-success" id="confirmaDeletar">Salvar Alterações</button>
           </div> 
           <!-- Fim Botões do Modal -->
        </div>
    </div>
</form>