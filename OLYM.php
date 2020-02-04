<!--
# СОздал 3 файла .php с префиксом 's_'
# s_head, s_developer, s_foot
# они типо более правильны для общего использования, чтобы не было траблов с повторением начальных и конечных тегов html, head, body,
# и вложенность др.
-->
<?php include('s_head.php');?>								<!--шапка html с мета данными и открытым head-->
<style>
	<?php include "styles/styleOlym.css";?>
</style>
</head> <body>
<?php include('library functions for olympiad.php');?>		<!--файл с функциями-->
<?php include('s_developer_menu.php');?>					<!--навигация, в окончательном виде удалить из кода-->
<?php
	//находим страницы использующие заданный шаблон
	$bodyArticles = $pages->find('template=olympiad');
	$i = 0;//счетчик для задание id блокам представляющие информацию о олимпиадах
	echo "<div class='pr_body'>";
	foreach ($bodyArticles as $newsArticle){
		$top = 68 * $i + 30; //рассчитываем отступ от верх. края
		$color = color_hsla(multiplicity(rand(0, 360), 25), 100, 60);//определяем цвет
		$status = check_date($newsArticle->date_start, $newsArticle->date_end);
		
		echo "\r\n<!--***$i олимпиада **********************************************************************************************-->\r\n";
		echo "<div class = 'block_pr' style = \" border-color:" . $color . "; top:" . $top . "px;\" onclick = 'func()'>";
		
		//подгружаем картинку, если есть
		if(count($newsArticle->images)) {
			/*???????????????????????????надо подумать как задать конкретное изображение, мб по имени олимпиады давать имена картинкам
			если картинка не задана, то выставлять дефолтную
			*/
			$image = $newsArticle->images->getRandom();//рандомное задание изображения
			echo "<div class = 'img'><img src='" . $image->url . "' alt='" . $image->description . "'></div>";
		}
			
		//подгружаем инфо о олимпиаде
		echo "<div class = 'block_ch head'>"    . "\r\n\t" . $newsArticle->title . "</div>" . "\r\n";
		echo "<div class = 'block_ch date'>С "  . "\r\n\t" . $newsArticle->date_start . ' по ' . $newsArticle->date_end . " (" . $status . ")</div>" . "\r\n";
		echo "<div class = 'block_ch content'>" . "\r\n\t" . $newsArticle->contacts . "</div>" . "\r\n";
		/*action - задает адрес, либо полностью писать с https либо с двумя сплешами доменное имя
		убрать target если в том же окне надо открывать при переходе
		*/
		echo "<form action='//yandex.ru' target='_blank'>";	
			echo "<button class = 'registration'>Подробнее</button>";;
		echo "</form>";
		echo "</div>" . "\r\n";
		$i++;
	}
	echo "</div>";
?>

<?php include('s_foot.php');?>								<!--подвал c закрывающими тегами body и html-->
