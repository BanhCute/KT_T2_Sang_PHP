<div id="chao">
    <div style="text-align: center; padding: 50px;">
        <div>
            <?php
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $hour = date('H');

            if ($hour >= 1 && $hour <= 12) {
                echo "<p style='color: #FF9933; font-size: 24px; font-family: Arial; font-style: italic;'>";
                echo "Bây giờ là " . date('H:i') . " sáng!<br>";
                echo "Chúc một ngày an lành";
                echo "</p>";
            } elseif ($hour >= 13 && $hour <= 18) {
                echo "<p style='color: #3366CC; font-size: 22px; font-family: Verdana; '>";
                echo "Lúc này là " . date('H:i') . " chiều!<br>";
                echo "Chúc bạn vui";
                echo "</p>";
            } else {
                echo "<p style='color: #663399; font-size: 20px; font-family: Times New Roman; font-weight: bold;'>";
                echo "Bây giờ là " . date('H:i') . " tối!<br>";
                echo "Chúc bạn có một buổi tối thật tuyệt vời";
                echo "</p>";
            }
            ?>
        </div>
    </div>
</div>