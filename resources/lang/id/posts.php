<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Posting',
        'create' => 'Tambah posting',
        'edit' => 'Ubah posting',
        'detail' => 'Detail posting',
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Data posting belum ada",
            'search' => "Judul posting :keyword tidak ditemukan",
        ]
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
            'category' => [
                'label' => 'Kategori',
                'placeholder' => 'Pilih kategori',
                'attribute' => 'kategori'
            ],
            'search' => [
                'label' => 'Pencarian',
                'placeholder' => 'Cari posting',
                'attribute' => 'pencarian'
            ]
        ],
        'select' => [
            'tag' => [
                'label' => 'Tag',
                'placeholder' => 'Masukan tag',
                'attribute' => 'tag',
                'option' => [
                    'publish' => 'Terbitkan',
                    'draft' => 'Draft',
                    'finished' => 'Selesai'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Pilih status',
                'attribute' => 'status',
                'option' => [
                    'draft' => 'Draft',
                    'publish' => 'Terbitkan',
                    'finished' => 'Selesai'
                ]
            ],
        ],
        'textarea' => [
            'description' => [
                'label' => 'Deskripsi',
                'placeholder' => 'Masukan deskripsi',
                'attribute' => 'deskripsi'
            ],
            'content' => [
                'label' => 'Konten',
                'placeholder' => 'Masukan konten',
                'attribute' => 'konten'
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
        'apply' => [
            'value' => 'Terapkan'
        ]
    ],
    'alert' => [
        'create' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Posting dengan judul \":name\", berhasil disimpan!",
                'error' => "Oops.. Terjadi kesalahan saat menyimpan Posting baru. :error"
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Posting dengan judul \":name\", berhasil diperbarui!",
                'error' => "Oops.. Terjadi kesalahan saat perbarui Posting. :error",
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
                'confirm' => "Apakah anda yakin? Posting dengan judul \":title\" akan dihapus?",
                'success' => "Posting dengan judul \":name\", berhasil dihapus!",
                'error'   => "Oops.. Terjadi kesalahan saat menghapus Posting :error"
            ]
        ],
    ]
];
