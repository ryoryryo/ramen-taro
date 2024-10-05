<?php
/*
Template Name: phpメール版フォーム
*/

// フォームに正しく入力することでsubmitでconfirm_mailに移行する
// SSL認証されたドメイン以外はセッションが動作せずconfirm_mailから返されるので注意

// session_set_cookie_params(0, '', '', true, true);
session_start();

$form_data = [
    'gender' => '',
    'nationality' => '',
    'user-name' => '',
    'email' => '',
    'email-confirm' => '',
    'gender' => '',
    'message' => '',
    'sendmail' => 'success',
];

$error = [
    'gender' => '',
    'nationality' => '',
    'user-name' => '',
    'email' => '',
    'email-confirm' => '',
    'gender' => '',
    'message' => '',
    'send-fail' => '',
];

// 送信失敗時のエラーメッセージ用
if (isset($_SESSION['send-fail-message']) && $_SESSION['send-fail-message'] === 'fail') {
    $error['send-fail'] = 'fail';
    unset($_SESSION['send-fail-message']);
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRFトークンの検証
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // JavaScriptでアラートを表示して、ページをリロード
        echo '<script>';
        echo 'window.alert("不正なリクエストです～、OKで戻ります💛");';
        echo 'window.location.href = "' . esc_url($_SERVER['REQUEST_URI']) .
            '";';
        echo '</script>';
        exit();
    }

    $form_data = array_map('trim', $_POST); // 余計なスペースの削除
    $form_data = array_map('htmlspecialchars', $form_data); // XSS対策

    // フォームの送信時にエラーをチェックする
    if (empty($form_data['gender'])) {
        $error['gender'] = 'blank';
    }
    if (empty($form_data['nationality'])) {
        $error['nationality'] = 'blank';
    }
    if (empty($form_data['user-name'])) {
        $error['user-name'] = 'blank';
    } else if (mb_strlen($form_data['user-name']) > 10) {
        $error['user-name'] = 'long';
    }

    if (empty($form_data['email'])) {
        $error['email'] = 'blank';
    } else if (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'wrong';
    }

    if (empty($form_data['email-confirm'])) {
        $error['email-confirm'] = 'blank';
    } else if ($form_data['email'] !== $form_data['email-confirm']) {
        $error['email-confirm'] = 'mismatch';
    }

    if (mb_strlen($form_data['message']) > 500) {
        $error['message'] = 'long';
    }

    // エラーがない場合は確認ページに移行
    if (!in_array('blank', $error) && !in_array('wrong', $error) && !in_array('long', $error) && !in_array('mismatch', $error)) {
        $_SESSION['form'] = $form_data;
        header('Location: ' . esc_url(home_url('/confirm_mail')));
        exit();
    }
    //エラーがある場合 
    else {
        if (isset($_SESSION['form'])) {
            $_SESSION['form'] = $form_data;
        }
    }
}
// リクエストがPOSTでない場合
else {
    if (isset($_SESSION['form'])) {
        $form_data = $_SESSION['form'];
    }
}

// CSRFトークン生成
$_SESSION['csrf_token'] = '';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

?>

<?php get_header(); ?>

<main>
    <section class="inquiry__sec">
        <div class="inquiry__wrapper">
            <div class="inquiry__background">
                <div class="inquiry__information">
                    <div class="inquiry__information--detail">
                        <div>株式会社&emsp;Driven by ramen</div>
                        <address>〒100-8111 東京都千代田区千代田１−１</address>
                    </div>
                    <div class="inquiry__information--image"></div>
                    <div class="inquiry__information--image"></div>
                </div>
            </div>
            <div class="inquiry-form__wrapper wrapper">
                <span class="back-fragment fg1"></span><span class="back-fragment fg2"></span>
                <h2>PHPメール版</h2>
                <span class="inquiry-form__wrapper--text">PHPのmb_send_mail関数が使用されています</span>
                <span class="inquiry-form__wrapper--text">入力されたメールアドレスにメールが自動送信されます</span>
                <span class="inquiry-form__wrapper--text">送信完了でデータベースに入力内容が保存されます</span>
                <?php if ($error['send-fail'] === 'fail') : ?>
                    <p class="error-message">メールの送信に失敗しました</p>
                <?php endif; ?>
                <div class="inquiry-php-mail-form__content wrapper">

                    <form method="post" action="" novalidate>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <label for="gender">性別<span class="red-text">必須</span></label>
                        <div>
                            <label for="male">男性</label><input type="radio" id="male" name="gender" value="男性" <?php if (isset($form_data['gender']) && $form_data['gender'] === '男性') echo 'checked'; ?>>
                            <label for="female">女性</label><input type="radio" id="female" name="gender" value="女性" <?php if (isset($form_data['gender']) && $form_data['gender'] === '女性') echo 'checked'; ?>>
                            <label for="other">その他</label><input type="radio" id="other" name="gender" value="その他" <?php if (isset($form_data['gender']) && $form_data['gender'] === 'その他') echo 'checked'; ?>>
                            <label for="no-answer">無回答</label><input type="radio" id="no-answer" name="gender" value="無回答" <?php if (isset($form_data['gender']) && $form_data['gender'] === '無回答') echo 'checked'; ?>>
                        </div>
                        <?php if ($error['gender'] === 'blank') : ?>
                            <p class="error-message">性別を選択してください</p>
                        <?php endif; ?>
                        <label for="nationality">国籍<span class="red-text">必須</span></label>
                        <select id="nationality" name="nationality" required>
                            <option value="" <?php if (isset($form_data['nationality']) && $form_data['nationality'] === '') echo 'selected'; ?>>選択してください</option>
                            <option value="日本" <?php if (isset($form_data['nationality']) && $form_data['nationality'] === '日本') echo 'selected'; ?>>日本</option>
                            <option value="アメリカ合衆国" <?php if (isset($form_data['nationality']) && $form_data['nationality'] === 'アメリカ合衆国') echo 'selected'; ?>>アメリカ合衆国</option>
                            <option value="中国" <?php if (isset($form_data['nationality']) && $form_data['nationality'] === '中国') echo 'selected'; ?>>中国</option>
                            <option value="その他" <?php if (isset($form_data['nationality']) && $form_data['nationality'] === 'その他') echo 'selected'; ?>>その他</option>
                        </select>
                        <?php if ($error['nationality'] === 'blank') : ?>
                            <p class="error-message">国籍を選択してください</p>
                        <?php endif; ?>

                        <label for="user-name">お名前(10字以内)<span class="red-text">必須</span></label>
                        <input type="text" id="user-name" name="user-name" value="<?php if (isset($form_data['user-name'])) {
                                                                                        echo htmlspecialchars($form_data['user-name'], ENT_QUOTES);
                                                                                    } ?>" autofocus required>
                        <?php if ($error['user-name'] === 'blank') : ?>
                            <p class="error-message">お名前をご記入ください</p>
                        <?php elseif ($error['user-name'] === 'long') : ?>
                            <p class="error-message">10字以内でご記入ください</p>
                        <?php endif; ?>

                        <label for="email">メールアドレス<span class="red-text">必須</span></label>
                        <input type="email" id="email" name="email" value="<?php if (isset($form_data['email'])) {
                                                                                echo htmlspecialchars($form_data['email'], ENT_QUOTES);
                                                                            } ?>" required>
                        <?php if ($error['email'] === 'blank') : ?>
                            <p class="error-message">メールアドレスをご記入ください</p>
                        <?php elseif ($error['email'] === 'wrong') : ?>
                            <p class="error-message">正しいメールアドレスをご記入ください</p>
                        <?php endif; ?>

                        <label for="email-confirm">メールアドレス(確認用)<span class="red-text">必須</span></label>
                        <input type="email" id="email-confirm" name="email-confirm" value="<?php if (isset($form_data['email-confirm'])) {
                                                                                                echo htmlspecialchars($form_data['email-confirm'], ENT_QUOTES);
                                                                                            } ?>" required>
                        <?php if ($error['email-confirm'] === 'blank') : ?>
                            <p class="error-message">確認用のメールアドレスをご記入ください</p>
                        <?php elseif ($error['email-confirm'] === 'mismatch') : ?>
                            <p class="error-message">メールアドレスが確認用と一致しません</p>
                        <?php endif; ?>


                        <label for="message">お問い合わせ内容(500字以内)</label>
                        <textarea id="message" name="message"><?php if (isset($form_data['message'])) {
                                                                    echo htmlspecialchars($form_data['message'], ENT_QUOTES);
                                                                } ?></textarea>
                        <?php if ($error['message'] === 'long') : ?>
                            <p class="error-message">500字以内でご記入ください</p>
                        <?php endif; ?>
                        <label for="sendmail">メール送信を成功させますか？<span class="red-text">必須</span></label>
                        <div>
                            <label for="success">はい</label><input type="radio" id="success" name="sendmail" value="success" <?php if (!isset($form_data['sendmail']) || $form_data['sendmail'] === 'success') echo 'checked'; ?>>

                            <label for="failure">いいえ</label><input type="radio" id="failure" name="sendmail" value="failure" <?php if (isset($form_data['sendmail']) && $form_data['sendmail'] === 'failure') echo 'checked'; ?>>
                        </div>
                        <button class="submit-btn" type="submit">内容を確認する</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
<script>
    document.querySelector('form').addEventListener('submit', function() {
        this.querySelector('button[type="submit"]').disabled = true;
    });
</script>