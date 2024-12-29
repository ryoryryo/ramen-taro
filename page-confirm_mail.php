<?php
/*
Template Name: phpメール確認画面
*/

// php_mail以外からのアクセスはphp_mailにリダイレクトされる
// メール送信成功でデータベースに記録とthanks_mailにリダイレクト

// session_set_cookie_params(0, '', '', true, true);
session_start();

require_once get_template_directory() . '/dbconnect.php';

// // 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
    header('Location: ' . esc_url(home_url('/php_mail/')));
    exit();
} else {
    $form_data = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メールを送信する
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    //店側送信------------------------------------------------------------------
    $from1 = 'info@ryoryoryo.shop';

    $headers1 = '';
    $headers1 .= "Content-Type: text/plain \r\n";
    $headers1 .= "Return-Path: {$form_data['email']} \r\n";
    $headers1 .= "From: " . mb_encode_mimeheader($form_data['user-name']) . " <{$from1}> \r\n";
    $headers1 .= "Reply-To: {$form_data['email']} \r\n";
    $headers1 .= "Organization: " . mb_encode_mimeheader($form_data['user-name']) . " \r\n";
    $headers1 .= "Precedence: bulk \r\n";
    $headers1 .= "X-Sender: {$form_data['email']} \r\n";
    $headers1 .= "X-Priority: 3 \r\n";

    $to1 = 'karaagelunch7@gmail.com';
    $subject1 = 'お問い合わせが届きました@らーめんたろう';
    $body1 = <<<EOT
入力内容

性別： {$form_data['gender']}
国籍： {$form_data['nationality']}
名前： {$form_data['user-name']}
メールアドレス： {$form_data['email']}
内容：
{$form_data['message']}
----------------------------------------------------
お問い合わせページ(PHPメール版)から
以上の内容でお問い合わせが来ました。
株式会社 Driven by ramen
EOT;
    //お問い合わせ者側送信---------------------------------------------------------------
    $from2 = 'info@ryoryoryo.shop';

    $headers2 = '';
    $headers2 .= "Content-Type: text/plain \r\n";
    $headers2 .= "Return-Path: {$form_data['email']} \r\n";
    $headers2 .= "From: " . mb_encode_mimeheader($form_data['user-name']) . " <{$from2}> \r\n";
    $headers2 .= "Reply-To: karaagelunch7@gmail.com \r\n";
    $headers2 .= "Organization: " . mb_encode_mimeheader($form_data['user-name']) . " \r\n";
    $headers2 .= "Precedence: bulk \r\n";
    $headers2 .= "X-Sender: {$form_data['email']} \r\n";
    $headers2 .= "X-Priority: 3 \r\n";

    $to2 = $form_data['email'];
    $subject2 = 'お問い合わせありがとうございました。(らーめんたろう)';
    $body2 = <<<EOT
当方の架空のウェブサイトからテスト送信をしていただきました。
----------------------------------------------------
入力内容

性別： {$form_data['gender']}
国籍： {$form_data['nationality']}
名前： {$form_data['user-name']}
メールアドレス： {$form_data['email']}
内容：
{$form_data['message']}
----------------------------------------------------
お問い合わせページ(PHPメール版)から
以上の内容で受け付け致しました。
お問い合わせありがとうございました。
架空のラーメン屋 らーめんたろう 株式会社 Driven by ramen
EOT;


    if ($form_data['sendmail'] === 'success' && mb_send_mail($to1, $subject1, $body1, $headers1, "-f{$from1}") && mb_send_mail($to2, $subject2, $body2, $headers2, "-f{$from2}")) {
        //メール送信成功ならば
        // データベース登録
        $sql = 'INSERT INTO `ramen_taro_mail_data` (gender, nationality, user_name, email_address, send_message) VALUES (?, ?, ?, ?, ?)';
        // ユーザーデータを配列に入れる
        $arr = [];
        $arr[] = $form_data['gender'];
        $arr[] = $form_data['nationality'];
        $arr[] = $form_data['user-name'];
        $arr[] = $form_data['email'];
        $arr[] = $form_data['message'];

        try {
            // データベース接続して準備
            $stmt = connect()->prepare($sql);
            // クエリを実行
            $stmt->execute($arr);
        } catch (PDOException $e) {
            // 送信失敗した場合、入力画面にリダイレクトと送信失敗を表示、エラーメッセージを取得してログ出力（任意）
            error_log('データベースエラーです(;_;): ' . $e->getMessage());
            header('Location: ' . esc_url(home_url('/php_mail/')));
            $_SESSION['send-fail-message'] = 'fail';
            exit();
        }

        // 成功でセッションを消してお礼画面へ
        unset($_SESSION['form']);
        unset($_SESSION['csrf_token']);
        header('Location: ' . esc_url(home_url('/thanks_mail/')));
        exit();
    } else {
        // 送信失敗した場合、入力画面にリダイレクトと送信失敗を表示
        header('Location: ' . esc_url(home_url('/php_mail/')));
        $_SESSION['send-fail-message'] = 'fail';
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo bloginfo('name'); ?> -PHPメール入力内容確認画面</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="robots" content="noindex,nofollow">
    <meta property="og:site_name" content="<?php echo bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo bloginfo('name'); ?> -PHPメール入力内容確認画面">
    <meta property="og:image" content="images/logo.png">
    <meta property="og:locale" content="ja_JP">

    <?php wp_head(); ?>

</head>

<body id="confirm_mail">

    <?php wp_body_open(); ?>

    <main>
        <div class="confirm__wrapper wrapper">
            <img class="confirm__logo" src="<?php echo esc_url(get_theme_file_uri('/images/logo_black.png')); ?>" alt="らーめんたろう">
            <div class="confirm__wrapper--title">メール入力内容確認</div>
            <div class="confirm__content">
                <form action="" method="POST">
                    <div class="confirm__inner">
                        <div class="confirm__box">
                            <label for="gender">性別</label>
                            <p><?php echo htmlspecialchars($form_data['gender'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <div class="confirm__box">
                            <label for="name">国籍</label>
                            <p><?php echo htmlspecialchars($form_data['nationality'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <div class="confirm__box">
                            <label for="name">名前(10文字以内)</label>
                            <p><?php echo htmlspecialchars($form_data['user-name'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <div class="confirm__box">
                            <label for="email">メールアドレス</label>
                            <p><?php echo htmlspecialchars($form_data['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <div class="confirm__box">
                            <label for="message">お問い合わせ内容(500文字以内)</label>
                            <p><?php echo nl2br(htmlspecialchars($form_data['message'], ENT_QUOTES, 'UTF-8')); ?></p>
                        </div>
                        <div class="confirm__box">
                            <label for="gender">メールの送信を成功させますか？</label>
                            <p><?php echo htmlspecialchars($form_data['sendmail'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </div>
                    <p class="cf1">この内容で送信しますか？</p>
                    <div class="confirm__buttons">
                        <a href="<?php echo esc_url(home_url('/php_mail/')); ?>">修正する</a>
                        <button type="submit" name="submit">この内容で送信</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- 二重送信防止用スクリプト -->
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            this.querySelector('button[type="submit"]').disabled = true;
        });
    </script>
</body>

</html>