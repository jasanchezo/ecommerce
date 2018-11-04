<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CategoryModel
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

			$stm = $this->pdo->prepare("SELECT * FROM category");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$cate = new Category();

				$cate->__SET('category_id', $r->category_id);
				$cate->__SET('cate_name', $r->cate_name);
				$cate->__SET('cate_description', $r->cate_description);

				$result[] = $cate;
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
			          ->prepare("SELECT * FROM category WHERE category_id = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$cate = new Category();

			$cate->__SET('category_id', $r->category_id);
			$cate->__SET('cate_name', $r->cate_name);
			$cate->__SET('cate_description', $r->cate_description);

			return $cate;
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
			          ->prepare("DELETE FROM category WHERE category_id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Category $data)
	{
		try 
		{
			$sql = "UPDATE category SET 
						cate_name               = ?, 
						cate_description        = ?
				    WHERE category_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('cate_name'), 
					$data->__GET('cate_description'), 
					$data->__GET('category_id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Category $data)
	{
		try 
		{
		$sql = "INSERT INTO category (cate_name, cate_description) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('cate_name'), 
				$data->__GET('cate_description')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}