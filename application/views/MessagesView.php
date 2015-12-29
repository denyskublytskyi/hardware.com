<!DOCTYPE html>
<html>
    <head>
        <title>Feedback list</title>
        <link href='http://<? echo $_SERVER['SERVER_NAME']; ?>/templates/css/fonts.css' rel='stylesheet' type='text/css'>
        <link href='http://<? echo $_SERVER['SERVER_NAME']; ?>/templates/css/messages_style.css' rel='stylesheet'
              type='text/css'>
        <link rel='stylesheet'
              href='http://<? echo $_SERVER['SERVER_NAME']; ?>/templates/css/font-awesome-4.4.0/css/font-awesome.min.css'>
        <script src='http://<? echo $_SERVER['SERVER_NAME']; ?>/templates/js/jquery-2.1.4.min.js'></script>
        <script src='http://<? echo $_SERVER['SERVER_NAME']; ?>/templates/js/feedback_list.js'></script>
        <script>
            setTimeout(function () {
                $('#notice').fadeOut('slow')
            }, 2000);
        </script>
    </head>

    <body>
        <div id="title">
            <div class="logo_text">
                Обратная связь
            </div>
        </div>

        <div id="content">
            <div id='toolbar'>
                <a href='/messages/<?echo $page ?>/desc' title='По убыванию даты'
                    <?php if ($order == 'desc'): ?> class='clicked' <?php endif; ?>>
                    <i class='fa fa-long-arrow-down'></i>
                    <i class='fa fa-calendar'></i>
                </a>

                <a href='/messages/<?echo $page ?>/asc' title='По возрастанию даты'
                    <?php if ($order == 'asc'): ?> class='clicked' <?php endif; ?>>
                    <i class='fa fa-long-arrow-up'></i>
                    <i class='fa fa-calendar'></i>
                </a>

                <a id = 'delete' href='/messages/deleteall' title='Удалить все'>
                    <i class="fa fa-trash"></i>
                </a>
            </div>

            <?php foreach($messages as $message): ?>

            <div class='message'>
                <div>
                    <b> Имя: </b>
                    <? echo $message['name'] ?>
                </div>
                <div>
                    <b> Email: </b>
                    <? echo $message['email'] ?>
                </div>
                <div>
                    <b> Сообщение: </b>
                    <? echo $message['text'] ?>
                </div>
                <div>
                    <b> Дата: </b>
                    <? echo $message['date'] ?>
                </div>
                <div>
                    <b> IP-адрес: </b>
                    <? echo $message['ip'] ?>
                </div>
                <div>
                    <b> Ответ: </b>
                    <? if(!empty($message['answer'])) echo $message['answer']; else echo '—'; ?>
                </div>
                <form method='post' action='/messages/reply/<? echo $message['id']; ?>'>
                    <textarea name='text' placeholder='Сообщение...'></textarea>
                    <div id='buttons'>
                        <a class='button' href = '/messages/delete/<? echo $message['id']; ?>'>
                            <i class='fa fa-trash'></i>
                            <div>
                                Удалить
                            </div>
                        </a>
                        <button type='submit' class='button'>
                            <i class='fa fa-envelope'></i>
                            <div>
                                Ответить
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <?php endforeach; ?>
            <div id = "navigation">
                <?php
                for ($i = 0; $i < round($count / 10, PHP_ROUND_HALF_UP); $i++)
                    if ($i + 1 != $page)
                        echo sprintf('<a class="pagination" href="/messages/%d"> %d </a>', $i + 1, $i + 1);
                    else
                        echo sprintf('<a href="/messages/%d" class="pagination clicked"> %d </a>', $i + 1, $i + 1);
                ?>
            </div>
        </div>
    </body>
</html>