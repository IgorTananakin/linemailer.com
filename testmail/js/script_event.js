
	
//		for( let el of document.querySelectorAll ('.list_messege')){
//			el.addEventListener('click', ()=>{
////				console.log(el)
//			
//				let id_mail = document.getElementById('mail_id').getAttribute('mail');
//				window.location.href = `https://linemail.sytes.net/testmail/mail.php?mail=${id_mail}`;
//				
//			})
//		}





document.addEventListener('click',e => {
	 // для удаления
	 
	 console.log(e.target.className);
	if (e.target.className === 'fa fa-times delete') {
		let id_mail_ = e.target.getAttribute('mail_id');
		window.location.href = `https://linemail.sytes.net/testmail/imap_delete.php?mail=${id_mail_}`;
	}
	if (e.target.className === 'list_messege') {
		let id_mail = e.target.getAttribute('mail');
		window.location.href = `https://linemail.sytes.net/testmail/mail.php?mail=${id_mail}`;
	}
	if (e.target.className === 'fa fa-user-circle-o green') {
		window.location.href = `https://linemail.sytes.net/testmail/list_contact.php`;
	}
	if (e.target.className === 'pag next round l') {
		let params = (new URL(document.location)).searchParams; 
		//console.log(params.get("page"));
		//params = Number(params);
		
		let par = Number(params.get("page").toString());
		//par = Number(typeof par);
		console.log(typeof par);
		if (par > 0) {
			par = par - 1;
			window.location.href = `https://linemail.sytes.net/testmail/index.php?inbox=0&page=${par}`;
		}
	}
	if (e.target.className === 'pag next round r') {
		let params = (new URL(document.location)).searchParams; 
		//console.log(params.get("page"));
		//params = Number(params);
		
		let par = Number(params.get("page").toString());
		//par = Number(typeof par);
		console.log(typeof par);
		if  (par > 0) {
			par = par + 1;
			window.location.href = `https://linemail.sytes.net/testmail/index.php?inbox=0&page=${par}`;
		}
	}
	if (e.target.className === 'button') {
		
		
		// полифилл CustomEven для IE11
			(function () {
			  if (typeof window.CustomEvent === "function") return false;
			  function CustomEvent(event, params) {
				params = params || { bubbles: false, cancelable: false, detail: null };
				var evt = document.createEvent('CustomEvent');
				evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
				return evt;
			  }
			  window.CustomEvent = CustomEvent;
			})();

			$modal = function (options) {
			  var
				_elemModal,
				_eventShowModal,
				_eventHideModal,
				_hiding = false,
				_destroyed = false,
				_animationSpeed = 200;

			  function _createModal(options) {
				var
				  elemModal = document.createElement('div'),
				  modalTemplate = '<div class="modal__backdrop" id="id_form_close" data-dismiss="modal"><div class="modal__content"><div class="modal__header"><div class="modal__title" data-modal="title">{{title}}</div><span class="modal__btn-close" data-dismiss="modal" title="Закрыть">×</span></div><div class="modal__body" data-modal="content">{{content}}</div>{{footer}}</div></div>',
				  modalFooterTemplate = '<div class="modal__footer">{{buttons}}</div>',
				  modalButtonTemplate = '<button type="button" class="{{button_class}}" data-handler={{button_handler}}>{{button_text}}</button>',
				  modalHTML,
				  modalFooterHTML = '';

				elemModal.classList.add('modal');
				modalHTML = modalTemplate.replace('{{title}}', options.title || 'Написать сообщение');
				modalHTML = modalHTML.replace('{{content}}', options.content || '');
				if (options.footerButtons) {
				  for (var i = 0, length = options.footerButtons.length; i < length; i++) {
					var modalFooterButton = modalButtonTemplate.replace('{{button_class}}', options.footerButtons[i].class);
					modalFooterButton = modalFooterButton.replace('{{button_handler}}', options.footerButtons[i].handler);
					modalFooterButton = modalFooterButton.replace('{{button_text}}', options.footerButtons[i].text);
					modalFooterHTML += modalFooterButton;
				  }
				  modalFooterHTML = modalFooterTemplate.replace('{{buttons}}', modalFooterHTML);
				}
				modalHTML = modalHTML.replace('{{footer}}', modalFooterHTML);
				elemModal.innerHTML = modalHTML;
				document.body.appendChild(elemModal);
				return elemModal;
			  }

			  function _showModal() {
				if (!_destroyed && !_hiding) {
				  _elemModal.classList.add('modal__show');
				  document.dispatchEvent(_eventShowModal);
				}
			  }

			  function _hideModal() {
				_hiding = true;
				_elemModal.classList.remove('modal__show');
				_elemModal.classList.add('modal__hiding');
				setTimeout(function () {
				  _elemModal.classList.remove('modal__hiding');
				  _hiding = false;
				}, _animationSpeed);
				document.dispatchEvent(_eventHideModal);
			  }

			  function _handlerCloseModal(e) {
				if (e.target.dataset.dismiss === 'modal') {
				  _hideModal();
				}
			  }

			  _elemModal = _createModal(options || {});


			  _elemModal.addEventListener('click', _handlerCloseModal);
			  _eventShowModal = new CustomEvent('show.modal', { detail: _elemModal });
			  _eventHideModal = new CustomEvent('hide.modal', { detail: _elemModal });

			  return {
				show: _showModal,
				hide: _hideModal,
				destroy: function () {
				  _elemModal.parentElement.removeChild(_elemModal),
					_elemModal.removeEventListener('click', _handlerCloseModal),
					destroyed = true;
				},
				setContent: function (html) {
				  _elemModal.querySelector('[data-modal="content"]').innerHTML = html;
				},
				setTitle: function (text) {
				  _elemModal.querySelector('[data-modal="title"]').innerHTML = text;
				}
			  }
			};

			(function () {
			  // создаём модальное окно
			  var modal = $modal({
				title: 'Отправить сообщение',
				content: '<div id="id_for_close">' +	
				  			'<div id="form" class="column" >' +
				  				'<div class="row">' +
				  					'<label for="from_messege" class="m-5">Кому</label>' +
									'<input type="email" class="m-5 input_for_input" id="id_from_messege" name="from_messege" size="30" type="text">' +
				  				'</div>' +
				  				'<div class="row">' +
				  					'<label for="subject" class="m-5">Заголовок</label>' +
									'<input type="text" class="m-5 input_for_input" id="id_subject" name="subject" id="subject" >' +
				  				'</div>' +
				  					'<textarea placeholder="" class="m-5" id="id_message_body" name="messege_body" cols="30" rows="5" ></textarea>' +
				  				'<div style="display:flex; justify-content: flex-end;">' +
				  					'<button type="submit" class="send_messege" name="send">Отправить</button>' +
									  
				  				'</div>' +
							'</div>' +
				  		 '</div>',
				  
				footerButtons: [
				 
				  //{ class: 'btn btn__cancel', text: 'Закрыть', handler: 'modalHandlerCancel' }
					
				]
			  });
			  // при клике на документ
			 // document.addEventListener('click', function (e) {
				//if (e.target.dataset.toggle === 'modal') {
				  modal.show();
				//}
			 // });
			})();
	}
	
//	действия при нажатии на Отправить
	if (e.target.className === 'send_messege') {
		


		console.log("Отправка письма");
		
		 let from_messsege = document.getElementById("id_from_messege").value;
		 let subject = document.getElementById("id_subject").value;
		 let message_body = document.getElementById("id_message_body").value;
		 console.log(from_messsege);
		 console.log(subject);
		 console.log(message_body);
			
		// let insertmail1 = (new URL(document.location)).searchParams; 

		// 	mail1 = insertmail1.get("mail");
			
		$.ajax({
			/* адрес файла-обработчика запроса */
			url: '../artisansweb/index2.php',
			/* метод отправки данных */
			method: 'POST',
			/* данные, которые мы передаем в файл-обработчик */
			data: {"mail" : from_messsege,
					
					"text_messege" : message_body
			},
			/* что нужно сделать до отправки запрса */
			beforeSend: function() {
			
			
		   }
			/* что нужно сделать по факту выполнения запроса */
		   }).done(function(data){

			/* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
			//data = jQuery.parseJSON(data);
			console.log(data);
			
			

				
			
		   });
		   let form_ajax_close = document.getElementById("id_for_close");
		   let form1_ajax_close = document.getElementById("id_form_close");
		   
			form_ajax_close.style.display="none";
			form1_ajax_close.style.display="none";
			console.log(form_ajax_close);
			//всплывающее окно
			new Toast({
				title: 'На почтовый ящик ' + from_messsege,
				text: 'Отправлено сообщение ' + subject,
				theme: 'light',
				autohide: true,
				interval: 1000
			  });

	}
	
	
	
	
	
	//форма назначить менеджера
	if (e.target.className === 'btn_menadger') {
		console.log(e.target.idName);
		// полифилл CustomEven для IE11
			var modal = document.getElementById('myModal1');
			
			var btn = document.getElementById("myBtn1");
			

			var span = document.getElementsByClassName("close1")[0];

			
//			btn.onclick = function() {
				modal.style.display = "block";
//			}


			span.onclick = function() {
				modal.style.display = "none";
			}


			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
			
			
		
	}

	


	//назначение менеджеру почтового ящика
	if (e.target.className === 'menedger_btn') {
		console.log("Test");

		$('.column input:checked').each(function() {
			console.log($(this).attr('value'));
			id_manager = $(this).attr('value');
			mail_manager = $(this).attr('atr_mail');
			console.log(id_manager);
			console.log(mail_manager);

			let insertmail = (new URL(document.location)).searchParams; 
			insert_mail = insertmail.get("mail");
				$.ajax({
				 /* адрес файла-обработчика запроса */
				 url: '../testmail/menegere.php',
				 /* метод отправки данных */
				 method: 'POST',
				 /* данные, которые мы передаем в файл-обработчик */
				 data: {"id_manager" : id_manager,
				 		"mail_manager" : mail_manager,
						 "insert_mail" : insert_mail
				 },
				 /* что нужно сделать до отправки запрса */
				 beforeSend: function() {
				 
				 //inProgress = true;
				}
				 /* что нужно сделать по факту выполнения запроса */
				}).done(function(data){
	
				 /* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
				 //data = jQuery.parseJSON(data);
				 console.log(data);
				 let form_select = document.getElementById('myModal1');
				 form_select.style.display = "none";
				
				//всплывающее окно
				 new Toast({
					title: 'Менеджеру ' + mail_manager,
					text: ' закреплён ' + insert_mail + ' почтовый ящик',
					theme: 'light',
					autohide: true,
					interval: 1500
				  });
	
				});
		  });
			}
	
	//отправка письма на почту
	if (e.target.className === 'send_mail') {
		console.log("send_mail");
		
		let text_messsege = document.getElementById("id_messege").value;
		console.log(text_messsege);
			
		let insertmail1 = (new URL(document.location)).searchParams; 

			mail1 = insertmail1.get("mail");
			
		$.ajax({
			/* адрес файла-обработчика запроса */
			url: '../artisansweb/index2.php',
			/* метод отправки данных */
			method: 'POST',
			/* данные, которые мы передаем в файл-обработчик */
			data: {"mail" : mail1,
					"text_messege" : text_messsege
			},
			/* что нужно сделать до отправки запрса */
			beforeSend: function() {
			
			//inProgress = true;
		   }
			/* что нужно сделать по факту выполнения запроса */
		   }).done(function(data){

			/* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
			console.log(data);

			document.getElementById("id_messege").value = '';
			console.log(document.getElementById("id_messege").value);
			//всплывающее окно
				 new Toast({
					title: 'Письмо ' ,
					text: ' На почтовый ящик ' + mail1 + ' отправлено',
					theme: 'light',
					autohide: true,
					interval: 1500
				  });	
			
		   });
	}
 
 });

//pag next round l