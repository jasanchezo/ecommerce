<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SaleModel
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

			$stm = $this->pdo->prepare("SELECT * FROM sale");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$sale = new Sale();

				$sale->__SET('sale_id', $r->sale_id);
				$sale->__SET('sale_prli_ts_session', $r->sale_prli_ts_session);
				$sale->__SET('sale_status', $r->sale_status);
                                $sale->__SET('sale_people_id', $r->sale_people_id);

				$result[] = $sale;
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
			          ->prepare("SELECT * FROM sale WHERE sale_id = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$sale = new Sale();

			$sale->__SET('sale_id', $r->sale_id);
                        $sale->__SET('sale_prli_ts_session', $r->sale_prli_ts_session);
                        $sale->__SET('sale_status', $r->sale_status);
                        $sale->__SET('sale_people_id', $r->sale_people_id);

			return $sale;
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
			          ->prepare("DELETE FROM sale WHERE sale_id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Sale $data)
	{
		try 
		{
			$sql = "UPDATE sale SET 
						sale_prli_ts_session               = ?, 
						sale_status        = ?,
                                                sale_people_id           = ?
				    WHERE sale_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('sale_prli_ts_session'), 
					$data->__GET('sale_status'), 
					$data->__GET('sale_people_id'),
                                        $data->__GET('sale_id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Sale $data)
	{
		try 
		{
		$sql = "INSERT INTO sale (sale_prli_ts_session, sale_status, sale_people_id) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('sale_prli_ts_session'), 
                                $data->__GET('sale_status'), 
                                $data->__GET('sale_people_id')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}