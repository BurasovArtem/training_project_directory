<?php require "php/db_link.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Электронный справочник</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="robots" content="index,follow" />
		<meta name="author" content="Shine Squad">
		<link rel="stylesheet" type="text/css" href="./css/styles.css">
		<script type="text/javascript" src="./js/scripts.js"></script>
		<script type="text/javascript">
			// window.onload = () => {
			// 	make_XHR("GET", "php/CREATE_DB.php", true, "", console.log);
			// }
		</script>
	</head>
	<body>
		<header>
			<h1 class="title">
				<a href="index.php">Справочный электронный ресурс</a>
			</h1>
			<ul class="nav">
				<li class="item"><a href="?discipline=development">Разработка</a></li>
				<li class="item"><a href="?discipline=design">Дизайн</a></li>
				<li class="item"><a href="?discipline=projection">Проектирование</a></li>
			</ul>
		</header>
		<main>
			<form class="search">
				<p><input type="search" name="search" placeholder="Поиск по сайту"> 
				<input type="submit" value="Найти"></p>
			</form>
			<div class="directory">
					<?php
						if (isset($_GET['search'])) {
							$search = $_GET['search'];
   							$request_count = "	SELECT COUNT(*) FROM  `concepts`
												WHERE `title` LIKE '%$search%'";
							$request = "SELECT * FROM  `concepts`
										WHERE `title` LIKE '%$search%'";
							$count = mysqli_query($conn, $request_count);
							$result = mysqli_query($conn, $request);
							echo "
									<div class='back'>
										<a href='index.php' class='text'>Назад</a>
									</div>
								";
						}
						elseif (isset($_GET['discipline'])) {
							$discipline = $_GET['discipline'];
							$count = mysqli_query($conn, "SELECT COUNT(*) FROM `concepts` WHERE discipline_section='$discipline'");
							$result = mysqli_query($conn, "SELECT * FROM `concepts` WHERE discipline_section='$discipline'");
							echo "
									<div class='back'>
										<a href='index.php' class='text'>Назад</a>
									</div>
								";
						} else {
							$count = mysqli_query($conn, "SELECT COUNT(*) FROM `concepts`");
							$result = mysqli_query($conn, "SELECT * FROM `concepts`");
						}
						$row = mysqli_fetch_row($count);
						echo "<p class='count'>Всего определений было найдено: {$row[0]}</p>";
						echo "<div class='definition_container'>";

						while ($feedback = mysqli_fetch_assoc($result)) {
							if ($feedback['discipline_section'] == 'development') { $discipline = "Разработка"; }
							else if ($feedback['discipline_section'] == 'projection') { $discipline = "Проектирование"; }
							else if ($feedback['discipline_section'] == 'design') { $discipline = "Дизайн"; }
							echo "
								<a href='./info_page.php?id={$feedback['id']}' class='definition_link'>
									<div class='definition_item'>
										<div class='text'>
											<p class='title'>{$feedback['title']}</p>
											<p class='description'>{$feedback['description']}</p>
											<p class='discipline_section'>Раздел: {$discipline}</p>
										</div>
										<img src='{$feedback['illustrations_examples']}' class='image'>
									</div>
								</a>
								";
						}
						echo "</div>";
					?>
			</div>
		</main>
	</body>
</html>