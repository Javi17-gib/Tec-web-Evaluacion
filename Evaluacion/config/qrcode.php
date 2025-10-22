<?php

return [
    'default' => [
        'writer' => 'png',
        'reader' => null,
        'writer_data_module_shape' => 'square',
        'writer_data_module_scale' => 5,
        'writer_background_color' => [255, 255, 255, 0],
        'writer_color' => [0, 0, 0, 255],
        'logo_path' => null,
        'logo_resize_to_width' => 0,
        'logo_resize_to_height' => 0,
        'validate_result' => false,
        'encoding' => 'UTF-8',
        'error_correction_level' => 'low',
        'size' => 200,
        'margin' => 10,
        'round_block_size_mode' => null,
        'foreground_color' => [0, 0, 0, 255],
        'background_color' => [255, 255, 255, 0],
        'label_text' => null,
        'label_font_path' => null,
        'label_font_size' => 16,
        'label_alignment' => 'center',
        'label_margin' => [0, 0, 0, 0],
        'logo_space_width' => 0,
        'logo_space_height' => 0,
        'writer_engine' => 'gd', // 👈 Fuerza el uso del motor GD
    ],
];
