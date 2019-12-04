<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $room1 = Str::random(32);
        $room2 = Str::random(32);
        $room3 = Str::random(32);

        $room4 = Str::random(32);
        $room5 = Str::random(32);
        $room6 = Str::random(32);
        $room7 = Str::random(32);

        $room8 = Str::random(32);
        $room9 = Str::random(32);
        $room0 = Str::random(32);

        DB::table('rooms')->insert([
            //LANTAI 4
            [
                'id_room' => $room1,
                'room_name' => "Ruang Serba Guna",
                'room_owner' => 1,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "4",
                'room_capacity' => "100",
            ], 
            [
                'id_room' => $room2,
                'room_name' => "Ruang Rapat Sekretariat",
                'room_owner' => 1,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "4",
                'room_capacity' => "20",
            ], 
            [
                'id_room' => $room3,
                'room_name' => "Ruang Khusus Kepala Badan",
                'room_owner' => 1,
                'room_subowner' => NULL,
                'room_type' => "2",
                'room_floor' => "4",
                'room_capacity' => "20",
            ],

            //LANTAI 5
            [
                'id_room' => $room4,
                'room_name' => "Ruang Rapat Simaster",
                'room_owner' => 5,
                'room_subowner' => "15",
                'room_type' => "2",
                'room_floor' => "5",
                'room_capacity' => "20",
            ], 
            [
                'id_room' => $room5,
                'room_name' => "Ruang Rapat Siera",
                'room_owner' => 5,
                'room_subowner' => "13",
                'room_type' => "1",
                'room_floor' => "5",
                'room_capacity' => "20",
            ], 
            [
                'id_room' => $room6,
                'room_name' => "Ruang Command Center",
                'room_owner' => 5,
                'room_subowner' => "15",
                'room_type' => "2",
                'room_floor' => "5",
                'room_capacity' => "20",
            ],
            [
                'id_room' => $room7,
                'room_name' => "Ruang Rapat PSA",
                'room_owner' => 3,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "5",
                'room_capacity' => "20",
            ],

            //LANTAI 7
            [
                'id_room' => $room8,
                'room_name' => "Ruang Rapat Fasos Fasum",
                'room_owner' => 4,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "7",
                'room_capacity' => "30",
            ], 
            [
                'id_room' => $room9,
                'room_name' => "Ruang Rapat E-Komponen",
                'room_owner' => 4,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "7",
                'room_capacity' => "20",
            ], 
            [
                'id_room' => $room0,
                'room_name' => "Ruang Rapat P3A",
                'room_owner' => 2,
                'room_subowner' => NULL,
                'room_type' => "1",
                'room_floor' => "7",
                'room_capacity' => "40",
            ]
        ]);

    	// $angka = 1;
    	// $nip = 12;
     //    $date = 25;
     //    $month = date('m');
     //    $year = date('Y');
        $file_name = uniqid(md5(time()))."~".date('dmY')."~surat.pdf";
        $id_surats = [];

        for ($i=0; $i < 13; $i++) { 
            array_push($id_surats, md5(uniqid()));    
        }

        DB::table('surats')->insert([
            [
                //ruang sekretariat
                'id_surat' => $id_surats[0],
                'surat_judul' => "Pembahasan pemanfaatan aset lahan kontribusi Pulau C dan D",
                'surat_deskripsi' => "Pembahasan pemanfaatan aset lahan kontribusi Pulau C dan D",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ], 
            [
                //ruang p3a
                'id_surat' => $id_surats[1],
                'surat_judul' => "Membahas permohonan pemanfaatan lahan tempat berdagang bunga PD Sarana Jaya",
                'surat_deskripsi' => "Membahas permohonan pemanfaatan lahan tempat berdagang bunga PD Sarana Jaya",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                //ruang p3a
                'id_surat' => $id_surats[2],
                'surat_judul' => "Permohonan perpanjangan sewa Gedung Dinas Teknik Lt.14 oleh PT Jamkrida Jakarta",
                'surat_deskripsi' => "Permohonan perpanjangan sewa Gedung Dinas Teknik Lt.14 oleh PT Jamkrida Jakarta",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                //ruang p3a
                'id_surat' => $id_surats[3],
                'surat_judul' => "Permohonan pemanfaatan BMD berupa tanah untuk gudang ikan di Muara Angke",
                'surat_deskripsi' => "Permohonan pemanfaatan BMD berupa tanah untuk gudang ikan di Muara Angke",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ], 
            [
                //ruang p3a
                'id_surat' => $id_surats[4],
                'surat_judul' => "Permohonan pembangunan mesjid diatas Taman Sub Zona Taman Kota / Lingkungan",
                'surat_deskripsi' => "Permohonan pembangunan mesjid diatas Taman Sub Zona Taman Kota / Lingkungan",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                //ruang p3a
                'id_surat' => $id_surats[5],
                'surat_judul' => "Permohonan pemanfaatan BMD oleh PT. Jakarta Solusi Lestari",
                'surat_deskripsi' => "Permohonan pemanfaatan BMD oleh PT. Jakarta Solusi Lestari",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                //ruang p3a
                'id_surat' => $id_surats[6],
                'surat_judul' => "Permohonan pinjam pakai BMD berupa tanah dan bangunan Sunter",
                'surat_deskripsi' => "Permohonan pinjam pakai BMD berupa tanah dan bangunan Sunter",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ], 



            [
                //ruang psa
                'id_surat' => $id_surats[7],
                'surat_judul' => "Rapat penyelesaian Gedung Yayasan Lembaga Bantuan Hukum Indonesia (YLBHI)",
                'surat_deskripsi' => "Rapat penyelesaian Gedung Yayasan Lembaga Bantuan Hukum Indonesia (YLBHI)",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],



            [
                //ruang fasos fasum
                'id_surat' => $id_surats[8],
                'surat_judul' => "Pembahasan penyerahan kewajiban fasos fasum berupa tanah marga jalan di Pantai Indah Kapuk",
                'surat_deskripsi' => "Pembahasan penyerahan kewajiban fasos fasum berupa tanah marga jalan di Pantai Indah Kapuk",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                //ruang sekretariat
                'id_surat' => $id_surats[9],
                'surat_judul' => "BAST penandatanganan sertifikat",
                'surat_deskripsi' => "BAST penandatanganan sertifikat",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ], 



            [
                'id_surat' => $id_surats[10],
                'surat_judul' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'surat_deskripsi' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                'id_surat' => $id_surats[11],
                'surat_judul' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'surat_deskripsi' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
            [
                'id_surat' => $id_surats[12],
                'surat_judul' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'surat_deskripsi' => "Inventarisasi penggabungan dan pemisahan SKPD",
                'file_name' => $file_name,
                'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
            ],
        ]);

        $users = [];
        for ($i=0; $i < 7; $i++) { 
            array_push($users, md5(uniqid()));
        }

        DB::table('users')->insert([
            [
                'id_user' =>  $users[0],
                'username' => "admin",
                'password' => Hash::make("adminadmin"),
                'name' => "admin",
                'user_status' => "1",
                'user_bidang' => NULL,
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[1],
                'username' => "pegawai1",
                'password' => Hash::make("tesuser1"),
                'name' => "pegawai",
                'user_status' => "2",
                'user_bidang' => "1",
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[2],
                'username' => "pegawai2",
                'password' => Hash::make("tesuser2"),
                'name' => "pegawai",
                'user_status' => "2",
                'user_bidang' => "2",
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[3],
                'username' => "pegawai3",
                'password' => Hash::make("tesuser3"),
                'name' => "pegawai",
                'user_status' => "2",
                'user_bidang' => "3",
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[4],
                'username' => "pegawai4",
                'password' => Hash::make("tesuser4"),
                'name' => "pegawai",
                'user_status' => "2",
                'user_bidang' => "4",
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[5],
                'username' => "pegawai5",
                'password' => Hash::make("tesuser5"),
                'name' => "pegawai",
                'user_status' => "2",
                'user_bidang' => "5",
                'user_subbidang' => NULL,
            ], 
            [
                'id_user' =>  $users[6],
                'username' => "umum",
                'password' => Hash::make("u1u1u1u1"),
                'name' => "umum",
                'user_status' => "3",
                'user_bidang' => "1",
                'user_subbidang' => "1",
            ]
        ]);

        DB::table('bookings')->insert([
            //bidang p3a
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room2,
                'booking_room_owner' => 1,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[0],
                'time_start' => 14,
                'time_end' => 17,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[1],
                'time_start' => 4,
                'time_end' => 7,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[2],
                'time_start' => 8,
                'time_end' => 11,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-26'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[3],
                'time_start' => 5,
                'time_end' => 8,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-28'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[4],
                'time_start' => 4,
                'time_end' => 7,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-25'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[5],
                'time_start' => 4,
                'time_end' => 6,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[2],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 2,
                'subbidang_peminjam' => 11,
                'booking_room' => $room0,
                'booking_room_owner' => 2,
                'booking_date' => date('2019-11-25'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[6],
                'time_start' => 7,
                'time_end' => 10,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 

            
            //bidang psa
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[3],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 3,
                'subbidang_peminjam' => 8,
                'booking_room' => $room7,
                'booking_room_owner' => 3,
                'booking_date' => date('2019-11-25'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[7],
                'time_start' => 5,
                'time_end' => 8,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 


            //bidang p5h
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[4],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 4,
                'subbidang_peminjam' => 5,
                'booking_room' => $room8,
                'booking_room_owner' => 4,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[8],
                'time_start' => 4,
                'time_end' => 7,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[4],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 4,
                'subbidang_peminjam' => 5,
                'booking_room' => $room2,
                'booking_room_owner' => 1,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[9],
                'time_start' => 3,
                'time_end' => 6,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 


            //bidang indidok
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[5],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 5,
                'subbidang_peminjam' => 15,
                'booking_room' => $room4,
                'booking_room_owner' => 5,
                'booking_date' => date('2019-11-26'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[10],
                'time_start' => 5,
                'time_end' => 10,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[5],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 5,
                'subbidang_peminjam' => 15,
                'booking_room' => $room4,
                'booking_room_owner' => 5,
                'booking_date' => date('2019-11-27'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[11],
                'time_start' => 5,
                'time_end' => 10,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
            [
                'id_booking' => md5(uniqid()),
                'id_peminjam' => $users[5],
                'nama_peminjam' => "pegawai",
                'nip_peminjam' => NULL,
                'bidang_peminjam' => 5,
                'subbidang_peminjam' => 15,
                'booking_room' => $room4,
                'booking_room_owner' => 5,
                'booking_date' => date('2019-11-28'),
                'booking_total_tamu' => 25,
                'booking_total_snack' => 25,
                'id_surat' => $id_surats[12],
                'time_start' => 5,
                'time_end' => 10,
                'booking_status' => 3,
                'request_hapus' => 0,
            ], 
        ]);
    }
}
