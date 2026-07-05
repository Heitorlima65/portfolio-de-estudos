<!DOCTYPE html>
<html lang="en">
    <?php
        require("ses_start.php") 
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>pessoa - cadastrar</title>
        <style>
            #p{
                display: block;
            }
        </style>
        <script>
            function adEmail(){
                const container = document.getElementById('emails');
                const novoParagrafo = document.createElement('p');
                const novoInput = document.createElement('input');
                novoInput.required = true;
                novoInput.type = 'email';
                novoInput.maxLength = 100;
                novoInput.name = 'emails[]';
                novoInput.placeholder = 'email@gmail.com';
                novoParagrafo.appendChild(novoInput);
                const botao = document.createElement('button');
                botao.type = 'button';
                botao.className = 'bnt-remover';
                botao.innerHTML = '✖';
                botao.onclick = function(){
                    novoParagrafo.remove();
                };
                novoParagrafo.appendChild(botao);
                container.appendChild(novoParagrafo);
            }
            function valida(){
                return true;
            }
            function adTelefone(){
                const container = document.getElementById('telefones');
                const novoParagrafoTel = document.createElement('p');
                const novoInputTel = document.createElement('input');
                novoInputTel.required = true;
                novoInputTel.type = 'tel';
                novoInputTel.maxLength = 11;
                novoInputTel.name = 'telefones[]';
                novoInputTel.placeholder = '(99) 99999-9999';
                novoParagrafoTel.appendChild(novoInputTel);
                const botaoTel = document.createElement('button');
                botaoTel.type = 'button';
                botaoTel.className = 'bnt-removerTelefones';
                botaoTel.innerHTML = '✖';
                botaoTel.onclick = function(){
                    novoParagrafoTel.remove();
                };
                novoParagrafoTel.appendChild(botaoTel);
                container.appendChild(novoParagrafoTel);
            }
            function adEndereco(){
                const container = document.getElementById('enderecos');
                const novoParagrafoEnderecosb = document.createElement('p');
                const novoInputEnderecosb = document.createElement('input');
                novoInputEnderecosb.required = true;
                novoInputEnderecosb.type = 'text';
                novoInputEnderecosb.maxLength = 40;
                novoInputEnderecosb.name = 'bairro[]';
                novoInputEnderecosb.id = 'bairro';
                novoInputEnderecosb.placeholder = 'bairro';
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosb);

                const novoInputEnderecosr = document.createElement('input');
                novoInputEnderecosr.required = true;
                novoInputEnderecosr.type = 'text';
                novoInputEnderecosr.maxLength = 60;
                novoInputEnderecosr.name = 'rua[]';
                novoInputEnderecosr.id = 'rua';
                novoInputEnderecosr.placeholder = 'rua';
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosr);

                const novoInputEnderecosn = document.createElement('input');
                novoInputEnderecosn.required = true;
                novoInputEnderecosn.type = 'text';
                novoInputEnderecosn.maxLength = 10;
                novoInputEnderecosn.name = 'numero[]';
                novoInputEnderecosn.id = 'numero';
                novoInputEnderecosn.placeholder = 'numero';
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosn);

                const novoInputEnderecosc = document.createElement('input');
                novoInputEnderecosc.required = true;
                novoInputEnderecosc.type = 'text';
                novoInputEnderecosc.maxLength = 40;
                novoInputEnderecosc.name = 'cidade[]';
                novoInputEnderecosc.id = 'cidade';
                novoInputEnderecosc.placeholder = 'cidade';
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosc);

                const novoInputEnderecosu = document.createElement('input');
                novoInputEnderecosu.required = true;
                novoInputEnderecosu.type = 'text';
                novoInputEnderecosu.maxLength = 60;
                novoInputEnderecosu.name = 'uf[]';
                novoInputEnderecosu.id = 'uf';
                novoInputEnderecosu.placeholder = 'estado';
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosu);

                const novoInputEnderecosce = document.createElement('input');
                novoInputEnderecosce.required = true;
                novoInputEnderecosce.type = 'text';
                novoInputEnderecosce.maxLength = 10;
                novoInputEnderecosce.name = 'cep[]';
                novoInputEnderecosce.id = 'cep';
                novoInputEnderecosce.placeholder = 'cep';
                novoInputEnderecosce.addEventListener('blur', function() {
                    pesquisacep(this.value);
                });
                novoParagrafoEnderecosb.appendChild(novoInputEnderecosce);

                const botaoEnderecos = document.createElement('button');
                botaoEnderecos.type = 'button';
                botaoEnderecos.className = 'bnt-removerEnderecosn';
                botaoEnderecos.innerHTML = '✖';
                botaoEnderecos.onclick = function(){
                    novoParagrafoEnderecosb.remove();
                };
                novoParagrafoEnderecosb.appendChild(botaoEnderecos);
                container.appendChild(novoParagrafoEnderecosb);
            }
            function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
            document.getElementById('ibge').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
        </script>
    </head>
    <body>
        <form name="cadPes01.php" action="cadPes02.php" method="POST" onsubmit = "return valida()">
            <fieldset>
                <legend>dados pessoais</legend>
                CPF:<br>
                <input type="text" name="CPFPessoa" value=""maxlength="11" required><br>
                nome completo:<br>
                <input type="text" name="nomePessoa" value="" maxlength="100" required><br>
                <br>
                Senha:<br>
                <input type="password" name="senha1" value="" maxlength="50" required><br>
                Confirme a senha:<br>
                <input type="password" name="senha2" value="" maxlength="50" required><br>
                <br>
                <div id="emails">

                </div>
                <input type="button" name="btnAdEmail" onclick="adEmail()" value="adicionar email">
                <br>
                <br>
                <div id="telefones">

                </div>
                <input type="button" name="btnAdTelefone" onclick="adTelefone()" value="adicionar telefone">
                <br>
                <br>
                <div id="enderecos">

                </div>
                <input type="button" name="btnAdEndereco" onclick="adEndereco()" value="adicionar endereço">
                <input type="submit" name="btnEnviar" value="enviar dados pessoais">
            </fieldset>
        </form>
    </body>
</html>