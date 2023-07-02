<?php
    class CartModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function updateToCartProduct($idUser, $idProduct, $countProduct){
            $command = $this->db->prepare('
                    UPDATE cart
                    SET count_product=:countProduct
                    WHERE id_client=:idUser AND id_product=:idProduct
            ');

            $command->bindParam(':idUser', $idUser);
            $command->bindParam(':idProduct', $idProduct);
            $command->bindParam(':countProduct', $countProduct);

            $command->execute();
            $data = array(
                'result_query' => true,
                'count_product' => $countProduct
            );
            return $data; 
        }
        public function initToCartProduct($idUser, $idProduct, $countProduct) {
            $command = $this->db->prepare('
                    INSERT INTO cart (id_client, id_product, count_product)
                    VALUES (:idUser, :idProduct, :countProduct)
            ');

            $command->bindParam(':idUser', $idUser);
            $command->bindParam(':idProduct', $idProduct);
            $command->bindParam(':countProduct', $countProduct);

            $command->execute();
            $data = array(
                'result_query' => true,
                'count_product' => $countProduct
            );
            return $data;
                
        }

        

        public function getCountProduct($idUser, $idProduct){
            $command = $this->db->prepare('
                SELECT count_product
                FROM cart
                WHERE id_client=:idUser AND id_product=:idProduct;
            ');
            $command->bindParam(':idUser', $idUser);
            $command->bindParam(':idProduct', $idProduct);
            if ($command->execute()){
                return $command->fetchColumn();
            } 
        }
    }
?>