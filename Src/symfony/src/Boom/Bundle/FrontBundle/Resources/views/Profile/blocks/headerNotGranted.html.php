<div id="usr-cnt">
    <div id="usr-box">
        <div id="usr-bar">
            <ul>
                <li><?php
echo $view['facebook']->loginButton(
        array(
    'autologoutlink' => true,
    'size' => 'large'
        ), 'BoomFrontBundle::blocks/facebook/loginButton.html.php'
)
?>
                </li>
            </ul>
        </div>
    </div>
</div>