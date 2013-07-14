<?php

class DB {

	private function connect() {

		$con = mysqli_connect("localhost","root","","melomanos");

		if (mysqli_connect_errno()) {
		 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		return $con;
	}

	public function new_user($username, $nombre, $apellido, $password) {

		$con = $this->connect();

		$sql = "INSERT INTO usuario(Nombre_Usuario, nombre, apellido, password) values ('$username', '$nombre', '$apellido', '$password')";
		$return = mysqli_query($con, $sql);

		mysqli_close($con);
	}

	public function login($username, $password) {

		$con = $this->connect();

		$sql = "SELECT COUNT(1) FROM usuario where Nombre_Usuario = '$username' and password = '$password'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_NUM);		

		return (int)$row[0] > 0;
	}

	public function session_start($username) {

		session_start(); 
		$_SESSION["username"] = $username;
	}

	public function createList($listName, $username) {

		$con = $this->connect();
		$sql = "INSERT INTO playlist (Nombre, User_Name) values ('$listName', '$username')";
		mysqli_query($con, $sql);

		$sql = "SELECT LAST_INSERT_ID()";

		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_NUM);

		return $row[0];
	}

	public function createSong($songName, $username) {

		$con = $this->connect();
		$sql = "INSERT INTO cancion (Nombre, User_Name) values ('$songName', '$username')";
		
		mysqli_query($con, $sql);
	}

	public function listSongs($username) {

		$con = $this->connect();		
		$sql = "SELECT * FROM cancion";
		$result = mysqli_query($con, $sql);		

		$songs = array();
		while ($row = mysqli_fetch_assoc($result)) {
        	$songs[] = $row;	
    	}

    	return $songs;
	}

	public function savePlaylist($songIds, $playListId) {

		$con = $this->connect();

		$sql = "DELETE FROM cancion_playlist WHERE ID_Playlist = $playListId";
		mysqli_query($con, $sql);

		foreach ($songIds as $songId) {
			
			$sql = "INSERT INTO cancion_playlist (ID_Cancion, ID_Playlist) values ('$songId', '$playListId')";
			$result = mysqli_query($con, $sql);
		}		
	}

	public function listPlayLists($username) {

		$con = $this->connect();
		
		$sql = "SELECT * FROM playlist where User_Name = '$username'";
		$result = mysqli_query($con, $sql);		
		
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        	$rows[] = $row;	
    	}

    	return $rows;
	}

	public function showPlaylist($ID_Playlist) {

		$con = $this->connect();

		$sql = "SELECT * FROM cancion_playlist 
				inner join cancion ON cancion_playlist.ID_Cancion = cancion.ID_Cancion
				where ID_Playlist = '$ID_Playlist'";
		$result = mysqli_query($con, $sql);		

		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
        	$rows[] = $row;	
    	}

    	return $rows;
	}

	public function deleteList($ID_Playlist) {

		$con = $this->connect();
		$sql = "DELETE FROM cancion_playlist WHERE ID_Playlist = $ID_Playlist";
		mysqli_query($con, $sql);

		$sql = "DELETE FROM playlist WHERE ID_Playlist = $ID_Playlist";
		mysqli_query($con, $sql);
	}

	public function deleteSong($ID_Song) {

		$con = $this->connect();
		$sql = "DELETE FROM cancion WHERE ID_Cancion = $ID_Song";
		mysqli_query($con, $sql);
	}
}

?>