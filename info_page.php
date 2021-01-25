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
	</head>
	<body>
		<header>
			<h1 class="title">
				<a href="index.php">Справочный электронный ресурс</a>
			</h1>
			<ul class="nav">
				<li class="item"><a href="./index.php?discipline=development">Разработка</a></li>
				<li class="item"><a href="./index.php?discipline=projection">Проектирование</a></li>
				<li class="item"><a href="./index.php?discipline=design">Дизайн</a></li>
			</ul>
		</header>
		<main style="justify-content: center;">
			<?php
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$result = mysqli_query($conn, "SELECT * FROM `concepts` WHERE id='$id'");
					while ($feedback = mysqli_fetch_assoc($result)) {
						if ($feedback['discipline_section'] == 'development') { $discipline = "Разработка"; }
						else if ($feedback['discipline_section'] == 'projection') { $discipline = "Проектирование"; }
						else if ($feedback['discipline_section'] == 'design') { $discipline = "Дизайн"; }
						echo "
							<div class='definition'>
								<div class='back'>
									<a href='#' onclick='history.back();return false;' class='text'>Назад</a>
								</div>
								<div class='definition_container'>
									<div class='item_info'>
										<p class='title'>{$feedback['title']}</p>
										<p class='description'>{$feedback['description']}</p>
										<p class='examples'>Примеры: {$feedback['examples']}</p>
									</div>
									<div class='item_image'>
										<img src='{$feedback['illustrations_examples']}' class='image'>
									</div>
								</div>
								<div class='similar'>
									<p class='title'>Слова из этой же тематики:</p>
									<div class='similar_container'>
							";
						$discipline = $feedback['discipline_section'];
						$similar = mysqli_query($conn, "SELECT * FROM `concepts` WHERE discipline_section='$discipline'");
						while ($fb_similar = mysqli_fetch_assoc($similar)) {
								echo"
										<a class='similar_item' href='./info_page.php?id={$fb_similar['id']}'>{$fb_similar['title']}</a>
									";
						}
						echo "		</div>
								</div>
							</div>";
					}
				} else {
					echo "
						<h1>Вернись и выбери определение :)</h1>
						<h2>И не надо искать изъяны в моём коде</h2>
						<a href='index.php'>Назад</a>
					";
				}
			?>
		</main>
	</body>
</html>

