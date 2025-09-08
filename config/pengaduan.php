<?php

return [
    // Nama kolom status & tanggal pada tb_pengaduan (ubah jika berbeda)
    'status_column' => 'status',
    'date_column' => 'created_at',

    // Mapping nilai status ke 3 bucket utama
    'map' => [
        'new'       => ['baru', 'new', 'masuk', '0', 0],
        'in_process'=> ['proses', 'diproses', 'processing', '1', 1],
        'done'      => ['selesai', 'done', 'complete', '2', 2],
    ],
];