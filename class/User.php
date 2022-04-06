<?php
require_once('config.php');

class User {

    private $idCliente;
    private $nomeCliente;
    private $emailCliente;
    private $senhaCliente;
    private $dtCadastroCliente;

    #GET AND SET OF THE ITENS
    #id
    public function getIdCliente(){
        return $this->idCliente;
    }
    public function setIdCliente($v){
         $this->idCliente = $v;
    }

    #nome
    public function getnomeCliente(){
        return $this->nomeCliente;
    }
    public function setnomeCliente($v){
         $this->nomeCliente = $v;
    }

    #email
    public function getemailCliente(){
        return $this->emailCliente;
    }
    public function setemailCliente($v){
         $this->emailCliente = $v;
    }

    #senha
    public function getsenhaCliente(){
        return $this->senhaCliente;
    }
    public function setsenhaCliente($v){
         $this->senhaCliente = $v;
    }

    #data cadastro
    public function getDtCadastroCliente(){
        return $this->dtCadastroCliente;
    }

    public function setDtCadastroCliente($v){
         $this->dtCadastroCliente = $v;
    }

    #lista os users
    public function getList(){
        #entrando no banco
        $db = new DBconnect("127.0.0.1","dbhcodephp","root","");

        #query select do DBconnect
        return $db->select("SELECT * FROM tb_cliente ORDER BY idCliente ASC");

    }

    #carrega um user
    function loadUser($id){
        #entrando no banco
        $db = new DBconnect("127.0.0.1","dbhcodephp","root","");

        $results = $db->select("SELECT * FROM tb_cliente WHERE idCliente = :ID",array(
            ":ID"=>$id
        ));

        try {
            
            if (isset($results[0])) {

                $linha = $results[0];
    
                $this->setIdCliente($linha['idCliente']);
                $this->setnomeCliente($linha['nomeCliente']);
                $this->setemailCliente($linha['emailCliente']);
                $this->setsenhaCliente($linha['senhaCliente']);
                $this->setDtCadastroCliente(new DateTime($linha['dtCadastroCliente']));
    
    
            }

        } catch (\PDOException $error) {
            echo "Usuário não encontrado!<br><br>";
            throw $error;
        }

    }

    #procurar usuario
    public function searchUsers($nome){
        #entrando no banco
        $db = new DBconnect("127.0.0.1","dbhcodephp","root","");

        $userFound = $db->select("SELECT * FROM tb_cliente WHERE nomeCliente LIKE :NOME ORDER BY nomeCliente ASC",array(
            ":NOME" => "%".$nome."%" #o comando "LIKE" do mysql precisa que haja % ao redor da var de procura
        ));

        return $userFound;
    }

    #login de usuario
    public function login($nome,$senha){
        $db = new DBconnect("127.0.0.1","dbhcodephp","root","");

        $userLogin = $db->select("SELECT * FROM tb_cliente WHERE nomeCliente = :NOME AND senhaCliente = :SENHA", array(
            ":NOME" => $nome,
            ":SENHA" => $senha
        ));

        if (count($userLogin) > 0) {
            
            $linha = $userLogin[0];
    
            $this->setIdCliente($linha['idCliente']);
            $this->setnomeCliente($linha['nomeCliente']);
            $this->setemailCliente($linha['emailCliente']);
            $this->setsenhaCliente($linha['senhaCliente']);
            $this->setDtCadastroCliente(new DateTime($linha['dtCadastroCliente']));

            return $userLogin;

        } else {
            #Excepcion - base de todas as exceções de usuário no PHP 7
            throw new Exception("Password or Login invalid.");
            
        }
        

        
    }

    public function __toString(){
        
        return json_encode(array(
            'ID' => $this->getIdCliente(),
            'NOME' => $this->getnomeCliente(),
            'EMAIL' => $this->getemailCliente(),
            'SENHA' => $this->getsenhaCliente(),
            'DATA DE CADASTRO' => $this->getDtCadastroCliente()->format("d/m/Y")
        ));

    }

}

?>