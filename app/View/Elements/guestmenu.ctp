<?php
$menus = $this->requestAction('/Menus/guestmenulist');
$selmenu =array();// $this->requestAction('/Menus/getmenu/' . $this->name);
echo '<div id="container-wrapper2" class="col2" style="margin-bottom:20px;"> <div id="topnav"> <ul id="sa-cssmenu">';
foreach ($menus as $menu) {
    if (in_array($menu['Menu']['id'], $selmenu))
        echo '<li><a class="active" href="' . $this->webroot . $menu['Menu']['url'] . '">' . $menu['Menu']['name'] . '</a>';
    else
        echo '<li><a href="' . $this->webroot . $menu['Menu']['url'] . '">' . $menu['Menu']['name'] . '</a>';
    $submenus = $this->requestAction('/SubMenus/guestsubmenulist/' . $menu['Menu']['id']);
    if (count($submenus) > 0) {
        echo '<ul>';
        foreach ($submenus as $submens) {
            echo '<li ><a href="' . $this->webroot.$submens['SubMenu']['url'] . '">' . $submens['SubMenu']['name'] . '</a></li>';
        }
        echo '</ul>';
    }
    echo '</li>';
}
echo '</ul></div></div>';
?>
