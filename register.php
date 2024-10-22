<?php
include('db.php');
include('header.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role]);

    header('Location: login.php');
}


?>
<h2>MedShipment<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAI9JREFUWEft110KgCAQBODxZHWz6mZ5sn4gfQhkdqVgkfF1N50+TCwh2EjB8mCYQCuAhehuV/3uc41eIQVizBKSUBHQV8b2Qngh68k6A5jI22YAOxN56nXdt9BhnODrtppDgRq0EmJ7TkLjCIU7GBltqeuCxqQkJCFdYdkekNDfQtb53X29fx3uhawPhAt0AjKFNiX9lAKHAAAAAElFTkSuQmCC"/></h2>
<p>Your trusted partner for medication delivery.</p><br>
<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAoRJREFUaEPtmLtrVEEUh79gBCtFjeKjEQI2YrAUtfKFj4T8CcHCzkIQVGzURvDZCxaWYqmooIKN+geEREFMJSqCz0YhKGZ/MgnZy96dO3PnzN3Inm6Zs2d+38w5c2fOAEvcBpa4fvoATe9g7A6MA6eBbcAqY4gfwDRwCXhQnCsGYBS4byy6LPxR4OHiwRiAF8CuhgBeArvrAnwG1jYE8AUYqgvwtyHx89O2ZU1MCsUAqGYuAjNOxbD7rZwOtewAl4GzJSqvAacCCbICPAP2AWW7JjGPgf0BEFkBDgBPPeIOAY96FWA18N0jbhPwvlcBNgCfPOLk87FXAQ62PjxPcqdQseCKR23IMar8Vx2UmWILUIVe1bxFnBJAom4AZ4DfBYWDwNVWjZysqtz5ZQfQvG+A6261lwF73fm/NVC83BsBiNDZNe0WBjtdJVKnUErx/R3QCoScQr+Ae+4RMgm8BVS8W4AdwBFgDFgRsE1ZakD39ivATUBPwm6mr/UJV9RVnqfmAHeBY60388+AVZXrSuAOcNjzP1MAPbr14P8TKH7eXamkj1/bs7EQywzgHTBS4fLmY9sIvO7S7TADOA7c8qmrOH6+5XehxNcMYDPwoaJAn9t2QKdWJzMD0PEYm/tFocuB2dwAvlVNNW62A6kE+uLUBtBHao1vFqPxr8WmWsxl7rnnnDbS/i+s2pp7Fk8QA9Bkc1d3p7YORgyAFkAQ51x7XVcAS/sGvHLt9bbOtCaNBbAUHBS7DxC0XAbO/+UOqM2ndl8ui2nxL2jr9OfbwEQu9SUHSeXpOwGsA6aA9ZWj1HNMvgOSoxTS3X4noDerpZkAWApOGrsWfVIlkcH6AJELl+xvc3k/eDEkqxqnAAAAAElFTkSuQmCC"/></h3>
<form method="post" action="">
    <div class="form-group">
        <label><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAZxJREFUSEu11L1vjWEYx/HPSecmmgpCajHUaOofIF5K01EbU/8CidCkpoYNIQzduyojUukLo9UmBgtB21RIGQnPldxtTh7nPveTU+da7/v6fa/3lj5bq8/6mgImq0Bu4kQK6D3m8bwUYBPAHG5nhGZxvxukBDiPF9hAgFaS2DncwRGcwXoOUgKsJoFpPK6JTGEJy7jYK+AbDlRlGMTPmsgwtvEZx3oFbOIQDuJrBhB/olQdrVSiqPlZRDmeZEoUPbrQK6C9yTEx0ZOBBL2Lw/ttcgR2DSEWwu32u+pLQB/uZ0x3fUdxHTGev/Ayzf+7/7FoJY2u792aHOMZUY/hVJqmdrEtvMHrlM2PTqQcIKZiMTWxSQaxCzNYq3/uBJjAs/TxKW4hjtv3mnNkGMcv3sMnLAKLsd2zOmAIb1PkcWtuNAkf91I5v+BkNXk7u351wFU8wCucbige30InljIO35Vq8xdygDhol0rLkwGPp8P3CJdzgA8YQZSqXvNSQkfxCR9xPAf4kx5KNyoH+8e/V6FSNtkpauzY9GPfM/gL5dBHGcZ57nQAAAAASUVORK5CYII="/></label>
        <input type="text" name="name" class="form-control" placeholder="name" required>
    </div>
    <div class="form-group">
        <label><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUlJREFUSEvd1T8ohWEUx/GPJIPBZJBSMmCwW2xGpbBSNmVSBhbJRCmTsilWfxaZbBYzA5OQMpgMBsmfe/S8um73ute93eWe5an3vM/5nt/vvM/zNqlzNNW5vsYCjGEN/TXadoUFnESdfIse0FVj8Wz7DXoLAZ8pO4DrKkGhPhT81M5XkAFeMI3Df0LGsYu2coCs7gYW8V4G1JxmF77nx3fzxRTMYButOMMEnkpAOnCAYbxiFjvlFAR0EMfoxiNC/nkBZCjZ2Il7jOaauURmdUkFmap27GMEb5jHVoLMYRMtOMVkLv+cchUDMgtXsJw276V1Kq2RW83rOh7/C5C5EipCTaiKiG6j6+i+MKoCRJEeHOXUfKSZ3JYYfNWASo9FAwPu0ndfqRV/vRfziZn9OslxXa+jr0bCRe5ULxW7rmusW3x7Y/0y62LRF2qEQhkl8rgIAAAAAElFTkSuQmCC"/></label>
        <input type="email" name="email" class="form-control" placeholder="email" required>
    </div>
    <div class="form-group">
        <label><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAASdJREFUSEvd1cEqRUEcx/HP9QqSpJQotl5Bws5G3kFZyUY2xIIsrHgHKztFeQULGyuiJAt5A2E0t45zz7lzz7lOyaym85/5fef///9mTkvDo9Wwvl4By1jFbDzQFY5xljpgL4BDbJQIbWOnGyQFWMFpFNjFSZyvYSvOF3BZBkkBrjGDdRzlRAJgDxdYrAt4x8BXvYfwmhMZwTPeMFgX8BE3lmWaiiddlBJIxQsBS9jHdMqCufhtdNt59ntR6k8YrSjeXn6PiRQgmXYJvHBfUQb/F9BufsgwPB0/mom+S/SC4Vj/jmb+BiCIjkfAHSZzze47g/n47gTdOYQnOzv6BgSxbg77O4BHjNW8yQ+ZPn1LFF20YMcDTFWE3GAzb9/UD6cio3N544BPCxY8Gbh0OQIAAAAASUVORK5CYII="/></label>
        <input type="password" name="password" class="form-control" placeholder="password" required>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="applicant">Applicant</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php include('footer.php'); ?>
