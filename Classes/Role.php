<?php 

class Role
{
	public static function admin()
	{
		session_start();
		if( isset($_SESSION['user']) )
		{
			if( !($_SESSION['user']['role_id'] == '1') )
			{
				Redirect::to('../index');
			}
		}
		else
		{
			Redirect::to('../login', ['msg' => 'Please Login First']);
		}
	}

	public static function user()
	{
		session_start();
		if( isset($_SESSION['user']) )
		{
			if( !($_SESSION['user']['role_id'] == '2') )
			{
				Redirect::to('../index');
			}
		}
		else
		{
			Redirect::to('../login', ['msg' => 'Please Login First']);
		}
	}
}


?>