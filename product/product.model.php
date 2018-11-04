<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductModel
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

			$stm = $this->pdo->prepare("SELECT * FROM product");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$prod = new Product();

				$prod->__SET('product_id', $r->product_id);
				$prod->__SET('prod_name', $r->prod_name);
				$prod->__SET('prod_description', $r->prod_description);
                                $prod->__SET('prod_size', $r->prod_size);
                                $prod->__SET('prod_price', $r->prod_price);
                                $prod->__SET('prod_offerPrice', $r->prod_offerPrice);
                                $prod->__SET('prod_stock', $r->prod_stock);
                                $prod->__SET('prod_imgName', $r->prod_imgName);
                                $prod->__SET('prod_category_id', $r->prod_category_id);

				$result[] = $prod;
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
			          ->prepare("SELECT * FROM product WHERE product_id = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$prod = new Product();

			$prod->__SET('product_id', $r->product_id);
                        $prod->__SET('prod_name', $r->prod_name);
                        $prod->__SET('prod_description', $r->prod_description);
                        $prod->__SET('prod_size', $r->prod_size);
                        $prod->__SET('prod_price', $r->prod_price);
                        $prod->__SET('prod_offerPrice', $r->prod_offerPrice);
                        $prod->__SET('prod_stock', $r->prod_stock);
                        $prod->__SET('prod_imgName', $r->prod_imgName);
                        $prod->__SET('prod_category_id', $r->prod_category_id);

			return $prod;
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
			          ->prepare("DELETE FROM product WHERE product_id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Product $data)
	{
		try 
		{
			$sql = "UPDATE product SET 
                                                prod_name               = ?, 
						prod_description        = ?,
                                                prod_size               = ?,
                                                prod_price              = ?,
                                                prod_offerPrice         = ?,                                                
                                                prod_stock              = ?,
                                                prod_imgName            = ?,
                                                prod_category_id        = ?
				    WHERE product_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
                                        $data->__GET('prod_name'), 
					$data->__GET('prod_description'), 
                                        $data->__GET('prod_size'), 
                                        $data->__GET('prod_price'), 
                                        $data->__GET('prod_offerPrice'), 
                                        $data->__GET('prod_stock'),
                                        $data->__GET('prod_imgName'),
                                        $data->__GET('prod_category_id'),
                                    	$data->__GET('product_id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Product $data)
	{
		try 
		{
		$sql = "INSERT INTO product (prod_name, prod_description, prod_size, prod_price, prod_offerPrice, prod_stock, prod_imgName, prod_category_id) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
                                $data->__GET('prod_name'), 
                                $data->__GET('prod_description'), 
                                $data->__GET('prod_size'), 
                                $data->__GET('prod_price'), 
                                $data->__GET('prod_offerPrice'), 
                                $data->__GET('prod_stock'),
                                $data->__GET('prod_imgName'),
                                $data->__GET('prod_category_id')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}