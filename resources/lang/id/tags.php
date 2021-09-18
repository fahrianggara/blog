<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Tag',
        'create' => 'Tambah tag',
        'edit' => 'Ubah tag',
    ],
    'form_control' => [
        'input' => [
            'title' => [
                'label' => 'Judul',
                'placeholder' => 'Masukan judul',
                'attribute' => 'judul'
            ],
            'slug' => [
                'label' => 'Slug',
                'placeholder' => 'Automatis dibuatkan',
                'attribute' => 'slug'
            ],
            'search' => [
                'label' => 'Pencarian',
                'placeholder' => 'Cari tag',
                'attribute' => 'pencarian'
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Data tag belum ada",
            'search' => "Tag :keyword tidak ditemukan",
        ]
    ],
    'button' => [
        'create' => [
            'value' => 'Tambah'
        ],
        'save' => [
            'value' => 'Simpan'
        ],
        'edit' => [
            'value' => 'Ubah'
        ],
        'delete' => [
            'value' => 'Hapus'
        ],
        'cancel' => [
            'value' => 'Batal'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Tag dengan judul \":name\", berhasil disimpan!",
                'error' => "Oops.. Terjadi kesalahan saat menyimpan Tag baru. :error"
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Tag dengan judul \":name\", berhasil diperbarui!",
                'error' => "Oops.. Terjadi kesalahan saat perbarui Tag. :error",
                'warning' => "Oops.. Sepertinya tidak ada perubahan :("
            ]
        ],
        'delete' => [
            'title' => [
                'error'     => 'Gagal!',
                'success'   => 'Sukses',
                'warning'   => "Peringatan!"
            ],
            'message' => [
                'confirm' => "Apakah anda yakin? Tag dengan judul \":title\" akan dihapus?",
                'success' => "Tag dengan judul \":name\", berhasil dihapus!",
                'error'   => "Oops.. Terjadi kesalahan saat menghapus Tag :error"
            ]
        ],
    ]
];
