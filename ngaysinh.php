<div class="date-picker " style="text-align: center; padding: 50px; display: flex; justify-content: center;">
    <div style="border-style:solid;  padding: 20px; border-color: #FF9933; border-radius: 10px; margin: 10px; width: 370px; height: 50px;">
        <select id="ngay" style="border-color:chartreuse; border-radius: 5px; outline: none; padding: 10px; ">
            <option value="0">Chọn ngày</option>
            <?php
            for ($i = 1; $i <= 31; $i++) {
                $day = ($i < 10) ? "0$i" : $i;
                echo "<option value='$i'>$day</option>";
            }
            ?>
        </select>

        <select id="thang" style="border-color:chartreuse; border-radius: 5px; outline: none; padding: 10px;">
            <option value=" 0">Chọn tháng</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $month = ($i < 10) ? "0$i" : $i;
                echo "<option value='$i'>$month</option>";
            }
            ?>
        </select>

        <select id="nam" style="border-color:chartreuse; border-radius: 5px; outline: none; padding: 10px;">
            <option value=" 0">Chọn năm</option>
            <?php
            for ($i = 2020; $i >= 1930; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        </>
    </div>
</div>