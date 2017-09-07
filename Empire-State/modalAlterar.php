
<form class="modal" id="modalAlterar" style="margin:80px auto;height:700px;" enctype="multipart/form-data" method="POST" action="alteraImovel.php">
    <div class="modal-dialog" id="mDialogAlterar" style="max-height:400px;">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="fecharModal()">×</button>
                <h4 class="modal-title">Alterar Imóvel - Código: <?php echo $alteraImovel ?>
                    <label style="float:right;margin-right:2% ">
                    <?php
                        // Se o imóvel estiver ativo, checa a Checkbox de Ativo
                        if($situacao_I)
                            echo "<input name=\"situacaoImovel_I\" type=\"checkbox\" checked>Ativo";
                        else
                            echo "<input name=\"situacaoImovel_I\" type=\"checkbox\">Ativo";
                    ?>
                    </label>
                </h4>
            </div>
            <!-- Fim do Cabeçalho -->
            <!-- Corpo do Modal -->
            <div class="modal-body">

                <!-- tela1 - Dados Pesoais-->
                <div id="tela1_a" >
                    <h3 style="text-align:center">Dados Pessoais</h3><br>
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input name="email_I" id="emailUsuario_I" class="form-control" type="email" maxlength="60" value='<?php echo "$email_I" ?>' readonly>
                    </div>
                    <div class="form-group">
                        <!-- Código do usuário não é exibido -->
                        <input type="hidden" name="codImovel_I" value="<?php echo $alteraImovel ?>" />
                        <label class="control-label">Nome</label>
                        <input name="nome_I" id="nomeUsuario_I" class="form-control" type="text" value='<?php echo "$nome_I" ?>' readonly>
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
                                // Deixando a 1° letra do tipo de imóvel maiúscula
                                $tipoImovel_I = mb_strtoupper(substr($tipoImovel_I,0,1)) . substr($tipoImovel_I,1) ;
                                while( $row = mysqli_fetch_array($resultResidencialA) )
                                {
                                    $option = $row['nome_tipoImovel'];
                                    $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
                                    if($option == $tipoImovel_I )
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
                                while( $row = mysqli_fetch_array($resultComercialA) )
                                {
                                    $option = $row['nome_tipoImovel'];
                                    $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
                                    if($option == $tipoImovel_I )
                                    {
                                        echo "<option selected>$option</option>";
                                    }
                                    else
                                    {
                                        echo "<option>$option</option>";   
                                    }
                                }
                            ?>
                            <option disabled>---------- Rural ----------</option>
                            <?php 
                                while( $row = mysqli_fetch_array($resultRuralA) )
                                {
                                    $option = $row['nome_tipoImovel'];
                                    $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
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

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Negócio</label>
                        <select name="tipoNegocio_I" class="form-control" required>

                            <!-- Selecionand o Tipo de Negócio -->
                            <?php
                                // foreach não funcionou aqui :(
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
                        <input name="valorImovel_I" id="valorImovel_I" class="form-control" type="number" onKeyPress="if(this.value.length>7){alert('Preço Máximo:R$9.999.999,99');this.value=''}" value='<?php echo "$valor_I"?>' required>
                    </div>
                </div><!-- fim tela2 -->
                <!-- tela3 - Localização-->
                <div id="tela3_a" class="invisivel" style="display:none">
                    <h3 style="text-align:center">Localização</h3><br>

                    <!-- linha 1 (Cidade,UF) -->
                    <div class="form-group">
                        
                        <div class="col-xs-8 doisCamposEsq">
                            <label class="control-label">Cidade</label>
                            <input name="cidadeImovel_I" id="cidadeImovel_I" class="form-control form-check-input" type="text" maxlength="40" value='<?php echo "$cidade_I"?>' required>    
                        </div>
                        
                        <div class="col-xs-4 doisCamposDir">
                            <label class="control-label">UF</label>
                            <select name="ufImovel_I" class="form-control form-check-input" required>

                                <!-- Selecionando a Uf  -->
                                <?php
                                    $ufArray = array('ES','MG','RJ','SP');
                                    foreach($ufArray as $d)
                                    {
                                        if($d == $ufI)
                                            echo "<option selected> $d </option>";
                                        else
                                            echo "<option> $d </option>";
                                    }
                                ?>
                            
                            </select>  
                        </div>
                        
                        
                    </div><!-- fim linha 1 -->

                    <!-- linha 2 (Logradouro, Endereço) -->
                    <div class="form-group">
                        
                        <div class="col-xs-4 doisCamposEsq">
                            
                            <label class="control-label">Logradouro</label>
                            <select name="logradouroImovel_I" class="form-control form-check-input" required>

                                <!-- Selecionando a Uf  -->
                                <?php
                                    $logradouroArray = array('Alameda','Avenida','Beco','Praça','Rua','Travessa');
                                    foreach($logradouroArray as $d)
                                    {
                                        if($d == $logradouro_I)
                                            echo "<option selected> $d </option>";
                                        else
                                            echo "<option> $d </option>";
                                    }
                                ?>
                            
                            </select>   

                        </div>
                        
                        <div class="col-xs-8 doisCamposDir">
                            <label class="control-label">Endereço</label>
                            <input name="enderecoImovel_I" id="enderecoImovel_I" class="form-control form-check-input" type="text" maxlength="80" value='<?php echo"$endereco_I" ?>' required>
                            
                        </div>

                    </div><!-- fim linha 2 -->

                    <!-- linha 3 (Número, Complemento) -->
                    <div class="form-group">
                        
                        <div class="col-xs-4 doisCamposEsq">
                            
                            <label class="control-label">Número</label>
                            <input name="numeroImovel_I" id="numeroImovel_I" class="form-control form-check-input" type="number" required min="1" value='<?php echo"$numero_I" ?>'>
                            

                        </div>
                        
                        <div class="col-xs-8 doisCamposDir">
                            <label class="control-label">Complemento</label>
                            <input name="complementoImovel_I" id="complementoImovel_I" class="form-control form-check-input" type="text" maxlength="50" value='<?php echo"$complemento_I" ?>'>
                            
                        </div>

                    </div><!-- fim linha 3 -->

                    <!-- linha 4 (Bairro) -->
                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input name="bairroImovel_I" id="bairroImovel_I" class="form-control" type="text" style="width:100%" maxlength="50" value='<?php echo"$bairro_I" ?>' required>
                    </div>
                </div><!-- fim tela3 -->

                <!-- tela4 - Dados do imóvel-->
                <div id="tela4_a" class="invisivel" style="display:none">
                    <h3 style="text-align:center">Dados do imóvel</h3><br>

                    <!-- Área Total, Útil -->
                    <div class="form-group">
                        
                        <div class="col-xs-6 doisCamposEsq">
                            <label class="control-label">Área Total</label>
                            <input name="areaTotalImovel_I" id="areaTotalImovel_I" class="form-control form-check-input" type="number" placeholder="m²" maxlength="10" onKeyPress="if(this.value.length>6){alert('Área Máxima: 999.999 m²');this.value=''}" value='<?php echo"$areaTotal_I" ?>' required>    
                        </div>
                        
                        <div class="col-xs-6 doisCamposDir">
                            <label class="control-label">Área Útil</label>
                            <input name="areaUtilImovel_I" id="areaUtilImovel_I" type="number" class="form-control form-check-input" placeholder="m²" maxlength="10" onKeyPress="if(this.value.length>6){alert('Área Máxima: 999.999 m²');this.value=''}" value='<?php echo"$areaUtil_I" ?>' required>

                                
                        </div>                                            
                        
                    </div><!-- fim área total, Útil -->

                    <!-- Dormitórios, Banheiros e Garagens -->
                    <div class="form-group">
                        
                        <div class="col-xs-4 doisCamposEsq">
                            <label class="control-label">Dormitórios</label>
                            <input name="dormitoriosImovel_I" id="dormitoriosImovel_I" class="form-control form-check-input" type="number" min="0" value='<?php echo"$dormitorios_I" ?>' required>    
                        </div>
                        
                        <div class="col-xs-4">
                            <label class="control-label">Banheiros</label>
                            <input name="banheirosImovel_I" id="banheirosImovel_I" type="number" class="form-control form-check-input" min="0" value='<?php echo"$banheiros_I" ?>' required>     
                        </div>

                        <div class="col-xs-4 doisCamposDir">
                            <label class="control-label">Garagem</label>
                            <input name="garagemImovel_I" id="garagemImovel_I" type="number" class="form-control form-check-input" min="0" value='<?php echo"$garagem_I" ?>' required>     
                        </div>
                        
                        
                    </div><!-- fim dormitórios, banheiros e garagens -->

                    <!-- Descrição, Situação -->
                    <div class="form-group">
                        
                        
                            <label class="control-label">Descrição</label>
                            <textarea name="descricaoImovel_I" id="descricaoImovel_I" class="form-control form-check-input" placeholder="Liste itens ou informações adicionais. Máximo de 500 caracteres" maxlength="500" required><?php echo"$descricao_I" ?></textarea>    
                        
                    </div><!-- fim descrição,situação -->


                </div><!-- fim tela4 -->

                <!-- tela5 - Imagens-->
                <div id="tela5_a" class="invisivel" style="display:none">
                    <div class="row">
                    
                
                    <div class="col-xs-6">
                        <h3 style="text-align:center">Imagens</h3><br>

                            <!-- VERIFICANDO AS IMAGENS -->
                            <input type="hidden" name="codImg1_I" value="<?php echo $codImg1_I ?>" />
                            <input type="hidden" name="codImg2_I" value="<?php echo $codImg2_I ?>" />
                            <input type="hidden" name="codImg3_I" value="<?php echo $codImg3_I ?>" />
                            <input type="hidden" name="codImg4_I" value="<?php echo $codImg4_I ?>" />
                            <?php
                                if($img[1][2] == 'vazio')
                                    echo"
                                    <input type=\"file\" name=\"myimage1_I\" id=\"img1_I\" >
                                    <label for=\"img1_I\">
                                        <div tabindex=\"0\" name=\"div1_I\" id=\"div1_I\" onblur=\"carregaImg('img1_I','div1_I', 'btCancelarImg1')\" onmouseout=\"carregaImg('img1_I','div1_I', 'btCancelarImg1_I')\">+</div>
                                    </label>";
                                else
                                {
                                    echo"
                                    <input type=\"file\" name=\"myimage1_I\" id=\"img1_I\" disabled>
                                    <label for=\"img1_I\">
                                        <div tabindex=\"0\" name=\"div1_I\" id=\"div1_I\" onblur=\"carregaImg('img1_I','div1_I', 'btCancelarImg1')\" onmouseout=\"carregaImg('img1_I','div1_I', 'btCancelarImg1_I')\"
                                        \"
                                        style=\"font-size:14px\">".$img[1][2]."
                                        </div>
                                    </label>";
                                }
                            ?>

                            <?php
                                if($img[2][2] == 'vazio')
                                    echo"
                                    <input type=\"file\" name=\"myimage2_I\" id=\"img2_I\">
                                    <label for=\"img2_I\">
                                        <div tabindex=\"0\" name=\"div2_I\" id=\"div2_I\" onblur=\"carregaImg('img2_I','div2_I', 'btCancelarImg2')\" onmouseout=\"carregaImg('img2_I','div2_I', 'btCancelarImg2_I')\">+</div>
                                    </label>";
                                else
                                {
                                    echo"
                                    <input type=\"file\" name=\"myimage2_I\" id=\"img2_I\" disabled>
                                    <label for=\"img2_I\">
                                        <div tabindex=\"0\" name=\"div2_I\" id=\"div2_I\" onblur=\"carregaImg('img2_I','div2_I', 'btCancelarImg2')\" onmouseout=\"carregaImg('img2_I','div2_I', 'btCancelarImg2_I')\"
                                        style=\"font-size:14px\">".$img[2][2]."
                                        </div>
                                    </label>";
                                }
                            ?>

                            <?php
                                if($img[3][2] == 'vazio')
                                    echo"
                                    <input type=\"file\" name=\"myimage3_I\" id=\"img3_I\" >
                                    <label for=\"img3_I\">
                                        <div tabindex=\"0\" name=\"div3_I\" id=\"div3_I\" onblur=\"carregaImg('img3_I','div3_I', 'btCancelarImg3')\" onmouseout=\"carregaImg('img3_I','div3_I', 'btCancelarImg3_I')\">+</div>
                                    </label>";
                                else
                                {
                                    echo"
                                    <input type=\"file\" name=\"myimage3_I\" id=\"img3_I\" disabled>
                                    <label for=\"img3_I\">
                                        <div tabindex=\"0\" name=\"div3_I\" id=\"div3_I\" onblur=\"carregaImg('img3_I','div3_I', 'btCancelarImg3')\" onmouseout=\"carregaImg('img3_I','div3_I', 'btCancelarImg3_I')\"style=\"font-size:14px\">".$img[3][2]."
                                        </div>
                                    </label>";
                                }
                            ?>

                            
                        
                        

                        <!-- Botões de Cancelar -->
                        <div class="form-group" style="overflow:auto">

                            <?php

                                // Se a imagem for 'vazia', não mostra o botão de cancelar
                                if($img[1][2] == 'vazio')
                                    echo ' <button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg1_I" onClick="apaga_a(\'img1_I\', \'div1_I\',\'btCancelarImg1_I\')">Cancelar imagem 1</button>';
                                else
                                    echo "<button type=\"button\" class=\"btn btn-success botaoImg\" id=\"btCancelarImg1_I\" onClick=\"apaga_a('img1_I', 'div1_I','btCancelarImg1_I','".$img[1][2]."')\">Cancelar imagem 1</button>";

                                if($img[2][2] == 'vazio')
                                    echo '<button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg2_I" onClick="apaga_a(\'img2_I\', \'div2_I\',\'btCancelarImg2_I\')">Cancelar imagem 2</button>';
                                else
                                    echo "<button type=\"button\" class=\"btn btn-success botaoImg\" id=\"btCancelarImg2_I\" onClick=\"apaga_a('img2_I', 'div2_I','btCancelarImg2_I','".$img[2][2]."')\">Cancelar imagem 2</button>";

                                if($img[3][2] == 'vazio')
                                    echo '<button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg3_I" onClick="apaga_a(\'img3_I\', \'div3_I\',\'btCancelarImg3_I\')">Cancelar imagem 3</button>';
                                else
                                    echo "<button type=\"button\" class=\"btn btn-success botaoImg\" id=\"btCancelarImg3_I\" onClick=\"apaga_a('img3_I', 'div3_I','btCancelarImg3_I','".$img[3][2]."')\">Cancelar imagem 3</button>";
                            ?>


                            

                        </div>
                        <!-- FIM DA VERIFICAÇÃO -->
                    </div>

                    <div class="col-xs-6" >
                        <h3 style="text-align:center">Planta</h3><br>
                        <!-- Verificando a imagem da planta -->
                        <?php
                                if($img[4][2] == 'vazio')
                                    echo"
                                    <input type=\"file\" name=\"myimage4_I\" id=\"img4_I\" >
                                    <label for=\"img4_I\">
                                        <div tabindex=\"0\" name=\"div4_I\" id=\"div4_I\" onblur=\"carregaImg('img4_I','div4_I', 'btCancelarImg4')\" onmouseout=\"carregaImg('img4_I','div4_I', 'btCancelarImg4_I')\">+</div>
                                    </label>";
                                else
                                {
                                    echo"
                                    <input type=\"file\" name=\"myimage4_I\" id=\"img4_I\" disabled>
                                    <label for=\"img4_I\">
                                        <div tabindex=\"0\" name=\"div4_I\" id=\"div4_I\" onblur=\"carregaImg('img4_I','div4_I', 'btCancelarImg4')\" onmouseout=\"carregaImg('img4_I','div4_I', 'btCancelarImg4_I')\"
                                        \"
                                        style=\"font-size:14px\">".$img[4][2]."
                                        </div>
                                    </label>";
                                }
                            ?>
                        <div class="form-group" style="overflow:auto;">  
                            <?php
                                // Se a imagem for 'vazia', não mostra o botão de cancelar
                                if($img[4][2] == 'vazio')
                                    echo ' <button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg4_I" onClick="apaga_a(\'img4_I\', \'div4_I\',\'btCancelarImg4_I\')">Cancelar imagem 4</button>';
                                else
                                    echo "<button type=\"button\" class=\"btn btn-success botaoImg\" id=\"btCancelarImg4_I\" onClick=\"apaga_a('img4_I', 'div4_I','btCancelarImg4_I','".$img[4][2]."')\">Cancelar imagem 4</button>";
                            ?>
                        </div>
                    </div>
                </div>
                    
    

                </div><!-- fim tela5 -->
            </div>
            <!-- Fim do Corpo -->

            <!-- Botões do Modal -->
            <div class="modal-footer">
                <a class="btn btn-default" onclick="fecharModal()">Cancelar</a>
                <button type="button" class="btn btn-primary" onClick="voltar_a( 'tela1_a' , 'tela2_a', 'tela3_a', 'tela4_a','tela5_a','mDialogAlterar')">
                    Voltar
                </button>
                <button type="button" class="btn btn-primary" onClick="proximo_a( 'tela1_a' , 'tela2_a', 'tela3_a', 'tela4_a','tela5_a','mDialogAlterar')">
                    Próximo
                </button>
                <button class="btn btn-success" id="confirmaDeletar">Salvar Alterações</button>
           </div> 
           <!-- Fim Botões do Modal -->

        </div>
    </div>
</form>