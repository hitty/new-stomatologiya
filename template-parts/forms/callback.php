<div class="popup dent-form">
	<div class="dent-form__image">
		<img src="<?=get_template_directory_uri()?>/assets/img/popup-callback.jpg" width="400" height="300" alt="Заказать обратный звонок" loading="lazy">
	</div>
	<div class="dent-form__content">
		<h2 class="dent-form__title">Закажите обратный звонок</h2>
		<p class="dent-form__subtitle">Заполните форму. Мы перезвоним вам в ближайшее время.</p>
		<form class="dent-form__form">
			<div class="dent-form__fields">
				<input type="text" name="Имя" placeholder="Ваше имя" required>
				<input type="email" name="Email" placeholder="Ваш Email" required>
				<input type="tel" name="Телефон" placeholder="Номер телефона" required pattern="[\d\s\+\-\(\)]{7,}">
			</div>
			<fieldset class="dent-form__contact-method">
				<legend>Выберите удобный способ связи</legend>
				<div class="dent-form__contact-options">
					<label><input type="radio" name="contact_method" value="phone" checked> Телефон</label>
					<label><input type="radio" name="contact_method" value="telegram"> Telegram</label>
					<label><input type="radio" name="contact_method" value="whatsapp"> WhatsApp</label>
				</div>
			</fieldset>
			<input type="submit" class="dent-form__submit main-button" value="Отправить заявку">
			<div class="dent-form__disclaimer">
				Отправляя форму, вы даёте согласие на обработку персональных данных и соглашаетесь с политикой конфиденциальности.
			</div>
			<input type="hidden" name="title" value="Заказать обратный звонок">
		</form>
	</div>
</div>