<?php


namespace App\repository;

use App\Core\abstract\AbstractRepository;
 

class TransactionRepository extends AbstractRepository{
    private string $tableUser='users';
    private string $tableCompte='compte';
    private string $tableNumerotel='numerotelephone';
    private string $transaction='transactions';
    private static ?TransactionRepository $instance=null;
 
    public function __construct(){
        parent::__construct();
        
    }

    public static function getInstance(){
    if(self::$instance===null){
        self::$instance=new static();
    }
    return self::$instance;   
}
    
    public function selectAll(){}
    public function insert(array $data){}
    public function update(){}
    public function delete(){}
    public function selectById($id){}
    public function selectBy(array $filter){}
    public function selectTransactionUser($id):array|null{
        $request=" SELECT $this->tableUser.prenom, $this->tableUser.nom , $this->tableCompte.solde, $this->transaction.id,$this->transaction.date,$this->transaction.montant,$this->transaction.typetransaction from $this->tableCompte inner join $this->tableNumerotel on $this->tableCompte.id=$this->tableNumerotel.compte_id inner join  $this->tableUser on  $this->tableUser.id=$this->tableNumerotel.user_id inner join $this->transaction on $this->tableCompte.id= $this->transaction.compte_id where  $this->tableUser.id=:id";
        $prepar=$this->pdo->prepare($request);
        $prepar->execute([
            'id'=>$id
        ]);
        $resultat=$prepar->fetchAll();
        if ($resultat){
            return $resultat;
        }
        return  null;
    }

}

