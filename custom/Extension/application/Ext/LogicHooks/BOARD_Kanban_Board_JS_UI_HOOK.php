<?php
$hook_array['after_ui_footer'][] = array(
    100,
    'adding js file to page',
    'modules/BOARD/hooks/js_add_hook.php',
    'Js_Add_Hook',
    'after_ui_frame_method');
