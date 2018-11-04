<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PeopleModel
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

			$stm = $this->pdo->prepare("SELECT * FROM people");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$peop = new People();

				$peop->__SET('people_id', $r->people_id);
				$peop->__SET('peop_email', $r->peop_email);
				$peop->__SET('peop_firstName', $r->peop_firstName);
                                $peop->__SET('peop_lastName', $r->peop_lastName);

				$result[] = $peop;
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
			          ->prepare("SELECT * FROM people WHERE people_id = ?");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$peop = new People();

			$peop->__SET('people_id', $r->people_id);
                        $peop->__SET('peop_email', $r->peop_email);
                        $peop->__SET('peop_firstName', $r->peop_firstName);
                        $peop->__SET('peop_lastName', $r->peop_lastName);

			return $peop;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
        
        public function ObtenerPorEmail($email)
	{
		try 
		{
			/* $stm = $this->pdo
			          ->prepare("SELECT * FROM people WHERE peop_email LIKE '?'"); */
                        $stm = $this->pdo
			          ->query("SELECT * FROM people WHERE peop_email LIKE '" . $email . "';");
			          
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$peop = new People();

			$peop->__SET('people_id', $r->people_id);
                        $peop->__SET('peop_email', $r->peop_email);
                        $peop->__SET('peop_firstName', $r->peop_firstName);
                        $peop->__SET('peop_lastName', $r->peop_lastName);

			return $peop;
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
			          ->prepare("DELETE FROM people WHERE people_id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(People $data)
	{
		try 
		{
			$sql = "UPDATE people SET 
						peop_email               = ?, 
						peop_firstName        = ?,
                                                peop_lastName           = ?
				    WHERE people_id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('peop_email'), 
					$data->__GET('peop_firstName'), 
					$data->__GET('peop_lastName'),
                                        $data->__GET('people_id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(People $data)
	{
		try 
		{
		$sql = "INSERT INTO people (peop_email, peop_firstName, peop_lastName) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('peop_email'), 
				$data->__GET('peop_firstName'),
                                $data->__GET('peop_lastName')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}