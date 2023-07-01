<?php

use function PHPSTORM_META\type;

    class FavouritesModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function getAllFavourites($idClient){
            try{
                $command = $this->db->prepare("
                SELECT `id_product`
                FROM `favourites`
                WHERE `id_client`=:idClient
                ORDER BY id_product DESC
                ");
                $command->bindParam(':idClient', $idClient);
                $command->execute();
                return $command->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) { echo $e->getMessage();}
            
        }

        public function addToFavorietes($clientId, $productId){
            $command = $this->db->prepare('
                INSERT INTO favourites(id_client, id_product)
                VALUES (:clientId, :productId)');
            $clientId = (int)$clientId;
            $productId = (int)$productId;
            $command->bindParam(':clientId', $clientId);
            $command->bindParam(':productId', $productId);
            if ($command->execute()){
                return array('result' => true, 'action' => 'update');
            }
        }

        public function deleteToFavorietes($clientId, $productId){
            $command = $this->db->prepare('
                DELETE FROM favourites
                WHERE id_client=:clientId AND id_product=:productId');
            $clientId = (int)$clientId;
            $productId = (int)$productId;
            $command->bindParam(':clientId', $clientId);
            $command->bindParam(':productId', $productId);
            if ($command->execute()){
                return array('result' => true, 'action' => 'delete');
            } 
        }

    }
?>