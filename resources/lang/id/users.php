<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Pengguna',
        'create' => 'Tambah pengguna',
        'edit' => 'Ubah pengguna',
    ],
    'form_control' => [
        'input' => [
            'name' => [
                'label' => 'Nama',
                'placeholder' => 'Masukan nama',
                'attribute' => 'nama'
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Masukan email',
                'attribute' => 'email'
            ],
            'password' => [
                'label' => 'Sandi',
                'placeholder' => 'Masukan sandi',
                'attribute' => 'sandi'
            ],
            'password_confirmation' => [
                'label' => 'Konfirmasi',
                'placeholder' => 'Ketik ulang sandi',
                'attribute' => 'konfirmasi sandi'
            ],
            'search' => [
                'label' => 'Cari',
                'placeholder' => 'Cari pengguna',
                'attribute' => 'cari'
            ]
        ],
        'select' => [
            'role' => [
                'label' => 'Wewenang',
                'placeholder' => 'Pilih wewenang',
                'attribute' => 'wewenang'
            ]
        ]
    ],
    'label' => [
        'name' => 'Nama',
        'email' => 'Email',
        'role' => 'Wewenang',
        'no_data' => [
            'fetch' => "Data pengguna belum ada",
            'search' => "pengguna :keyword tidak ditemukan",
        ],
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
                'success' => "Pengguna dengan judul \":name\", berhasil disimpan!",
                'error' => "Oops.. Terjadi kesalahan saat menyimpan Pengguna baru! :error"
            ]
        ],
        'update' => [
            'title' => [
                'error'     => 'Gagal',
                'success'   => 'Berhasil'
            ],
            'message' => [
                'success' => "Pengguna dengan judul \":name\", berhasil diperbarui!",
                'error' => "Oops.. Terjadi kesalahan saat perbarui Pengguna! :error",
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
                'confirm' => "Apakah anda yakin? Pengguna dengan judul \":title\" akan dihapus?",
                'success' => "Pengguna dengan judul \":name\", berhasil dihapus!",
                'error'   => "Oops.. Terjadi kesalahan saat menghapus Pengguna! :error"
            ]
        ],
    ]
];
