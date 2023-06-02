<?php 
CLASS Database
{
	public static $connection = null;
	public static function getConnection()
	{
		return self::$connection = mysqli_connect('localhost', 'root', '', 'the-thoughts');
	} 

	public static function query($query)
	{
		$data = [];
		$result = mysqli_query(self::$connection, $query);
		if ( is_object($result) )
		{
			if($result->num_rows > 0)
			{
				while ($Info = mysqli_fetch_assoc($result)) 
				{
					$data[] = $Info;
				}
			}
			return $data;
		}
		else
		{
			$queryResult = $result;
		}
	}
}
?>