<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Kategori',
        'create' => 'Tambah kategori',
        'edit' => 'Ubah kategori',
        'detail' => 'Detail kategori',
    ],
    'page' => [
        'create' => [
            'category' => 'Buat',
            'tag'      => 'Halaman membuat tag',
            'post'     => 'Halaman membuat post',
        ],
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
            'thumbnail' => [
                'label' => 'Thumbnail',
                'placeholder' => 'Telusuri thumbnail',
                'attribute' => 'thumbnail'
            ],
            'search' => [
                'label' => 'Pencarian',
                'placeholder' => 'Cari kategori',
                'attribute' => 'pencarian'
            ]
        ],
        'select' => [
            'parent_category' => [
                'label' => 'Induk kategori',
                'placeholder' => 'Pilih induk kategori',
                'attribute' => 'induk kategori'
            ]
        ],
        'textarea' => [
            'description' => [
                'label' => 'Deskripsi',
                'placeholder' => 'Masukan deskripsi',
                'attribute' => 'deskripsi'
            ],
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
        'browse' => [
            'value' => 'Telusuri'
        ],
        'back' => [
            'value' => 'Kembali'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Kategori dengan judul \":name\", berhasil disimpan!",
                'error' => "Terjadi kesalahan saat menyimpan kategori. :error"
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Kategori dengan judul \":name\", berhasil diperbarui!",
                'error' => "Terjadi kesalahan saat perbarui kategori. :error",
                'warning' => "Oops.. Sepertinya tidak ada perubahan :("
            ]
        ],
        'delete' => [
            'title' => [
                'error'     => 'Error',
                'success'   => 'Success',
                'warning'   => "Warning"
            ],
            'message' => [
                'confirm' => "Apakah anda yakin? kategori dengan judul \":title\" akan dihapus?",
                'success' => "Kategori dengan judul \":name\", berhasil dihapus!",
                'error'   => "Oops.. Terjadi kesalahan saat menghapus kategori :error"
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Data kategori belum ada",
            'search' => "Kategori :keyword tidak ditemukan",
        ]
    ]
];
