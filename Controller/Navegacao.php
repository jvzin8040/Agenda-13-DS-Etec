<?php




switch ($_POST) {
    //Caso a variavel seja nula mostrar tela de login
    case isset($_POST[null]):
        include_once "../View/login.php";
        break;

    //---Login--//
    case isset($_POST["btnLogin"]):
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
            include_once "../View/principal.php";
        } else {
            include_once "../View/cadastroNaoRealizado.php";
        }
        break;


    //---Primeiro Acesso--//
    case isset($_POST["btnPrimeiroAcesso"]):
        include_once "../View/primeiroAcesso.php";
        break;

    //---Cadastrar--//
    case isset($_POST["btnCadastrar"]):
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->inserir(
            $_POST["txtNome"],
            $_POST["txtCPF"],
            date("Y-m-d", strtotime($_POST["DataNascimento"])), 
            $_POST["txtEmail"],
            $_POST["txtSenha"]
        )) {
            include_once "../View/cadastroRealizado.php";
        } else {
            include_once "../View/cadastroNaoRealizado.php";
        }
        break;

    //--Atualizar--//
    case isset($_POST["btnAtualizar"]):
        require_once "../Controller/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->atualizar(
            $_POST["txtID"],
            $_POST["txtCPF"],
            $_POST["txtNome"],
            $_POST["txtEmail"],
            date("Y-m-d", strtotime($_POST["txtData"]))
        )) {
            include_once "../View/atualizacaoRealizada.php";
        } else {
            include_once "../View/operacaoNaoRealizada.php";
        }
        break;

    //--Adicionar Formacao--//
    case isset($_POST["btnAddFormacao"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if (
            $fController->inserir(
                date("Y-m-d", strtotime($_POST["txtInicioFA"])),
                date("Y-m-d", strtotime($_POST["txtFimFA"])),
                $_POST["txtDescFA"],
                unserialize($_SESSION["Usuario"])->getID()
            ) != false
        ) {
            include_once "../View/cadastroRealizado.php";
        } else {
            include_once "../View/cadastroNaoRealizado.php";
        }
        break;

    //--Excluir Formacao-//
    case isset($_POST["btnExcluirFA"]):
        require_once "../Controller/FormacaoAcadController.php";
        include_once "../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if ($fController->remover($_POST["id"]) == true) {
            include_once "../View/informacaoExcluida.php";
        } else {
            include_once "../View/operacaoNaoRealizda.php";
        }
        break;

    //-Cadastro Raalizado -- //
    case isset($_POST["btnCadRealizado"]):
        include_once "../View/principal.php";
        break;

    //-Cadastro Nao Realizado -- //
    case isset($_POST["btnCadNaoRealizado"]):
        include_once "../View/primeiroAcesso.php";
        break;
}
