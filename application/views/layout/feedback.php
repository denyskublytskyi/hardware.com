<div class="slideout">
    <div id='feedback-title'> Обратная связь </div>
    <div id='feedback' class='slideout-inner'>
        <form id='feedback-form' class='form validate'>
            <input name='name' type='text' placeholder='Имя' value="<? echo $_COOKIE['login'] ?>">
            <input name='email' type='email' placeholder='Email' value="<? echo $_COOKIE['email'] ?>">
            <textarea name='text' placeholder='Сообщение...'></textarea>
            <span class='form-answer'> </span>
            <button type='submit'>
                Отправить
            </button>
        </form>
    </div>
</div>