<?php

class CRUD
{	
	public function select(string $table, array $column = ['*'], array $where = null) 
	{
		$selectColumn = '';
		$columnIs 	  = '';
		$data = [];

		/* === For Selecting COLUMNS === */
		foreach ($column as $key => $value) 
		{
			$selectColumn .= $value .", ";
		}
		$column = substr($selectColumn, 0, -2);

		/* === For WHERE Condition === */
		if($where === null )
		{
			$selectQuery = "SELECT $column FROM {$table};";
		}
		else
		{
			foreach ($where as $key => $value) 
			{
				$columnIs .= $key ."=". "'$value'"." AND "; 
			}
			$columnIs = substr($columnIs, 0, -5);
			$selectQuery = "SELECT $column FROM {$table} WHERE $columnIs;";
		}

		$queryResult = mysqli_query(Database::$connection, $selectQuery);
		if($queryResult->num_rows > 0)
		{
			while ($Info = mysqli_fetch_assoc($queryResult)) 
			{
				$data[] = $Info;
			}
		}
		else
		{
			$data = '';
		}
		return $data;
	}

	public function insert(string $table, array $column)
	{
		$values = implode("', '" , $column);
		$tableColumns = array_flip($column);
		$column = implode(' , ', $tableColumns);
		$query = "INSERT INTO ${table} ($column) VALUES ('$values')";
		return $queryResult = mysqli_query(Database::$connection, $query);
	}

	// FOR UPDTE assign 3rd parameter (WHERE) -> ['column-name', value1, value2, value3]
	public function update(string $table, array $set, $where)
	{	
		$valueIs = '';
		foreach ($where as $key => $value) 
		{
			if($value == $where[0])
				{	$columnIs = $value;
					continue;
				}
				$valueIs .= " '$value', ";
			}
			$valueIs = substr($valueIs, 0, -2);
			$updatedInformation = '';
			foreach ($set as $column => $value) 
			{
				$updatedInformation .= $column ." = '$value' , ";
			}
			$updatedInformation= substr($updatedInformation, 0, -2);
			$updatedInformation;
			$query = "UPDATE ${table} SET $updatedInformation WHERE $columnIs IN ($valueIs)";
			return mysqli_query(Database::$connection, $query);
	}

	public function delete(string $table, $where)
	{
			$query = "DELETE FROM ${table} WHERE $where";
			$queryResult = mysqli_query(Database::$connection, $query);
	}
}

?>