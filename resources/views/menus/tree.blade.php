<?php
$traverse = function ($menus) use (&$traverse, $selected) {
    foreach ($menus as $menu) {
        echo $menu->ancestors->count() ? '<ul>' : '';
        echo '<li> ';
        if (! $menu->children->count()) {
            $checked = '';
            if (in_array($menu->id, $selected)) {
                $checked = 'checked';
            }
            echo '<div class="form-check"> <input class="form-check-input" ' . $checked . ' name="menu_ids[]" type="checkbox" value="' . $menu->id . '" id="menu-' . $menu->id . '">';
        }
        echo '<label class="form-check-label" for="menu-' . $menu->id . '">' . $menu->name . '</label>';
        echo $menu->children->count() ? '' : '</div>';
        $traverse($menu->children);
        echo '</li>';
        echo $menu->ancestors->count() ? '</ul>' : '';
    }
};

$traverse($tree);
