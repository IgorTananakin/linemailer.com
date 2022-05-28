<?php
// Устанавливаем соединение с базой данных
//include "config.php";
// Переменная хранит число сообщений выводимых на станице
$num = 25;
// Извлекаем из URL текущую страницу
$page = $_GET['page'];
// Определяем общее число сообщений в базе данных
//$result = mysql_query("SELECT COUNT(*) FROM post");
$posts = mysql_fetch_row($result);
// Находим общее число страниц
$total = intval(($posts - 1) / $num) + 1;
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная к какого номера
// следует выводить сообщения
$start = $page * $num - $num;
// Выбираем $num сообщений начиная с номера $start
//$result = mysql_query("SELECT * FROM post LIMIT $start, $num");
// В цикле переносим результаты запроса в массив $postrow
while ( $postrow[] = mysql_fetch_array($result))
?>
<?php
echo "<table>";
for($i = 0; $i < $num; $i++)
{
echo "<tr>
         <td>".$postrow[$i]['name']."</td>
         <td>".$postrow[$i]['time']."</td></tr>
       <tr><td colspan=\"2\">".$postrow[$i]['text']."</td></tr>";
}
echo "</table>";
?>
<?php
// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href= ./page?page=1><<</a>
                               <a href= ./page?page='. ($page - 1) .'><</a> ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' <a href= ./page?page='. ($page + 1) .'>></a>
                                   <a href= ./page?page=' .$total. '>>></a>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href= ./page?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href= ./page?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
if($page + 2 <= $total) $page2right = ' | <a href= ./page?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href= ./page?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

// Вывод меню
echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;

?>