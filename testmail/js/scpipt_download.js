
$(document).ready(function(){

	/* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */
	var inProgress = false;
	/* С какой статьи надо делать выборку из базы при ajax-запросе */
	var startFrom = 3;
	//var mas = JSON.parse('<?php echo $json_all_mail; ?>');
	//var mas = '<?php echo json_encode($mas_all_mail);?>';
	
	//alert(tempArray);
		/* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
		$(window).scroll(function() {
	
			/* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос */
			if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProgress) {
	
			$.ajax({
				/* адрес файла-обработчика запроса */
				url: '../testmail/ajax.php',
				/* метод отправки данных */
				method: 'POST',
				/* данные, которые мы передаем в файл-обработчик */
				data: {"startFrom" : startFrom,
						"mas" : tempArray
				},
				/* что нужно сделать до отправки запрса */
				beforeSend: function() {
				/* меняем значение флага на true, т.е. запрос сейчас в процессе выполнения */
				inProgress = true;}
				/* что нужно сделать по факту выполнения запроса */
				}).done(function(data){
	
				/* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
				data = jQuery.parseJSON(data);
	
				/* Если массив не пуст (т.е. статьи там есть) */
				//if (data.length > 0) {
	
				/* Делаем проход по каждому результату, оказвашемуся в массиве,
				где в index попадает индекс текущего элемента массива, а в data - сама статья */
				$.each(data, function(index, data) {
					
					 if (data['name'] == 'incoming') {
						$("#test").append("<div class='messege left trg-left'>" +
											"<div class='msg_l left'>" +
												"<div class='column m-5'>" +
													"<div>" +
														"<p class='body_msg_l'>" + 
															data.value +
														"</p>" +
													"</div>" +
													"<div class='time_msg_l'>" +
														"<p>" +
										  					data.date +
														"</p>" +
													"</div>" +
												"</div>" +
											"</div>" ); 
					}
					if (data['name'] == 'send') {
						$("#test").append("<div class='messege right'>" +
												"<div class='msg_r right'>" +
													"<div class='column m-5'>" +
														
															"<p class='body_msg_r'> " +
																data.value +
															"</p>" +
														
														"<div class='time_msg'>" +
															"<p>" +
										  						data.date +
															"</p>" +
														"</div>" +
													"</div>" +
												"</div>" +
											"</div>" );
						
					}
					//data.shift();
					
					
					console.log(startFrom );
				/* Отбираем по идентификатору блок со статьями и дозаполняем его новыми данными */
				});
				
				/* По факту окончания запроса снова меняем значение флага на false */
				inProgress = false;
				// Увеличиваем на 1 порядковый номер массива, с которой надо начинать выборку из массива
				startFrom += 1;
				
				//}
				});
			}
		});
	});
	