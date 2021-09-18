<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Wewenang',
        'create' => 'Tambah wewenang',
        'edit' => 'Ubah wewenang',
        'detail' => 'Detail wewenang',
    ],
    'form_control' => [
        'input' => [
            'name' => [
                'label' => 'Nama',
                'placeholder' => 'Masukan nama',
                'attribute' => 'nama'
            ],
            'permission' => [
                'label' => 'Hak akses',
                'placeholder' => 'Pilih hak akses',
                'attribute' => 'hak akses'
            ],
            'search' => [
                'label' => 'Cari',
                'placeholder' => 'Cari wewenang',
                'attribute' => 'cari'
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => 'Wewenang Belum Tersedia!',
            'search' => "Wewenang :keyword tidak ditemukan",
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
                'success' => "Wewenang dengan judul \":name\", berhasil disimpan!",
                'error' => "Oops.. Terjadi kesalahan saat menyimpan Wewenang baru. :error"
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Wewenang dengan judul \":name\", berhasil diperbarui!",
                'error' => "Oops.. Terjadi kesalahan saat perbarui Wewenang. :error",
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
                'confirm' => "Apakah anda yakin? Wewenang dengan judul \":title\" akan dihapus?",
                'success' => "Wewenang dengan judul \":name\", berhasil dihapus!",
                'error'   => "Oops.. Terjadi kesalahan saat menghapus Wewenang :error",
                'warning' => "Maaf, wewenang :name belum dapat dihapus. Karena masih digunakan.",
            ]
        ],
    ]
];
