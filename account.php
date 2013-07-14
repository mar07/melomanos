<?php
require "database.php";
session_start(); 
?>

<html>
<meta charset="utf-8">

<head>
<style type="text/css">
.song-selector {
	cursor: pointer;
}
#main-list {
	width: 400px;
}
#playlist-songs {
	width: 400px;
}
.logo {
	width: 100px;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script type="text/javascript">

var musicPlayer = null;
var playList = null;
var selectedPlaylist = null;

$(function() {

	musicPlayer = $("#music-player");
	playList = $("#playlist-songs");
	
	$(".song-selector").dblclick(function() {

		var li = $(this);
		appendSong(li.find("span").text(), li.attr("data-id"));
	});

	musicPlayer.bind("ended", nextSong);
})

function appendSong(text, dataId) {

	var song = text;
	var option = $("<option>");
	option.text(song);
	option.attr("data-id", dataId);

	option.click(function() {

		changeSong(song);
	});

	playList.append(option);		
} 

function nextSong() {

	var currentSong = playList.find(":selected");
	var nextSong = currentSong.next();
	currentSong.attr('selected', false);
	nextSong.attr('selected', true);
	changeSong(nextSong.text());
}

function changeSong(song) {

	$("#current-song").attr("src", "repo/" + song);	

    musicPlayer.load();
    musicPlayer.get(0).play();
}

function createList() {

	selectedPlaylist = null;

	var name = $("#list-name").val();
	$.post("createlist.php", {"list-name": name}, function(response) {

		$("#createPlaylist").attr("data-id", response);
		$("#createPlaylist").attr("data-name", name);
		$("#createPlaylist").show();
		$("#playlist-songs").html("");
	});
}

function savePlaylist() {

	var playListId = $("#createPlaylist").attr("data-id");
	var playListName = $("#createPlaylist").attr("data-name");
	var options = $("#playlist-songs option");
	var songIds = "";

	for (var i=0; i < options.length; i++) {
		
		songIds += $(options[i]).attr("data-id") + ",";
	};
	songIds = songIds.substr(0, songIds.length - 1);

	$.post("savePlaylist.php", {"playListId": playListId, "songIds": songIds}, function(response) {

		if (selectedPlaylist) {
			alert("guardado ok")
			return;	
		}

		var li = $("<li>", {
			"id": "playList-" + playListId
		});

		var anchor = $("<a>", {
			"href": "javascript:showPlaylist(" + playListId + ")"
		}).text($("#list-name").val());
		li.append(anchor);

		var button = $("<button>", {
			"onclick": "deletePlaylist(" + playListId + ")"
		}).text("Borrar");		
		li.append(button);

		$("#playlist-list").append(li);
	});
}

function showPlaylist(ID_Playlist) {

	selectedPlaylist = ID_Playlist;
	$("#createPlaylist").attr("data-id", selectedPlaylist);

	$.post("showPlaylist.php", {"ID_Playlist": ID_Playlist}, function(response) {

		var songs = JSON.parse(response);

		$("#createPlaylist").show();
		$("#playlist-songs").html("");
		for (var i=0; i < songs.length; i++) {
			appendSong(songs[i].Nombre, songs[i].ID_Cancion);
		}
	});
}

function deletePlaylist(ID_Playlist) {

	$.post("deletePlaylist.php", {"ID_Playlist": ID_Playlist}, function(response) {

		$("#playList-" + ID_Playlist).remove();
	});
}

function deleteSong(ID_Song) {

	$.post("deleteSong.php", {"ID_Song": ID_Song}, function(response) {

		$("#song-" + ID_Song).remove();
	});
}

</script>
</head>			
<body>
<div class="contenedor">
<h1><img src="img/melomanos.jpg" class="logo"></h1>
<div>Bienvenido <?php echo $_SESSION["username"] ?></div>

<div>
<a href="upload_music.php">Subir Música</a>
</div>

<ul id="main-list">
<?php 

$db = new DB();
$songs = $db->listSongs($_SESSION["username"]);

foreach($songs as $song) {
	
	$songName = $song["Nombre"];
	$songId = $song["ID_Cancion"];

    echo "<li id='song-$songId' data-id='$songId' class='song-selector'><span>".$songName."</span><button onclick='deleteSong(".$songId.")'>Borrar</button></li>";
}
?>
</ul>

<div>Mis Playlists

<ul id="playlist-list">
<?php

$playLists = $db->listPlayLists($_SESSION["username"]);

foreach ($playLists as $playList) {

	echo "<li id='playList-".$playList["ID_Playlist"]."'><a href='javascript:showPlaylist(".$playList["ID_Playlist"].")'>".$playList["Nombre"]."</a><button onclick='deletePlaylist(".$playList["ID_Playlist"].")'>Borrar</button></li>";
}

?>
</ul>
</div>

<input id="list-name" type="text">
<button onclick="createList()">Crear Playlist</button>

<div id="createPlaylist" style="display: none">
Mi Playlist
<div>
	<select id="playlist-songs" size="8">
	</select>
</div>

<button onclick="savePlaylist()">Guardar</button>

</div>

<button onclick="nextSong()">Siguiente</button>
<div>
Actualmente Escuchando: <span id="current-song-name"></span>
</div>

<audio id="music-player" controls>
  	<source id="current-song" src="" type="audio/mpeg">
</audio>

<br>


</div>


</body>
</html>