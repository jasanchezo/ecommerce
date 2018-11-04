<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductsListModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM productsList");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$prli = new ProductsList();

				$prli->__SET('productsList_id', $r->productsList_id);
                                $prli->__SET('prli_ts_session', $r->prli_ts_session);
				$prli->__SET('prli_product_id', $r->prli_product_id);
				$prli->__SET('prli_quantity', $r->prli_quantity);

				$result[] = $prli;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
        
        public function ListarTS()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT DISTINCT prli_ts_session FROM productsList");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$prli = new ProductsList();

				// $prli->__SET('productsList_id', $r->productsList_id);
                                $prli->__SET('prli_ts_session', $r->prli_ts_session);
				// $prli->__SET('prli_product_id', $r->prli_product_id);
				// $prli->__SET('prli_quantity', $r->prli_quantity);

				$result[] = $prli;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM productsList WHERE productsList_id = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$prli = new ProductsList();

			$prli->__SET('productsList_id', $r->productsList_id);
                        $prli->__SET('prli_ts_session', $r->prli_ts_session);
                        $prli->__SET('prli_product_id', $r->prli_product_id);
                        $prli->__SET('prli_quantity', $r->prli_quantity);

			return $prli;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM productsList WHERE productsList_id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(ProductsList $data)
	{
		try 
		{
			$sql = "UPDATE productsList SET 
                                                prli_ts_session               = ?,
                                                prli_product_id               = ?, 
						prli_quantity                 = ?
				    WHERE productsList_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
                                        $data->__GET('prli_ts_session'), 
                                        $data->__GET('prli_product_id'), 
					$data->__GET('prli_quantity'), 
                                        $data->__GET('productsList_id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(ProductsList $data)
	{
		try 
		{
		$sql = "INSERT INTO productsList (prli_ts_session, prli_product_id, prli_quantity) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
                                $data->__GET('prli_ts_session'),
                                $data->__GET('prli_product_id'), 
                                $data->__GET('prli_quantity')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}