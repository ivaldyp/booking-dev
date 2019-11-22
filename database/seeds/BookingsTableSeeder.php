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

    	$angka = 1;
    	$nip = 12;
    	$date = 18;
    	$rooms = [$room4, $room5, $room6];

        for ($i=1; $i <= 5; $i++) { 
            $id_surat = md5(uniqid());
            $file_name = uniqid(md5(time()))."~".date('dmY')."~02_Disposisi.pdf";
            DB::table('surats')->insert([
                [
                    'id_surat' => $id_surat,
                    'surat_judul' => "acara".$angka,
                    'surat_deskripsi' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                    'file_name' => $file_name,
                    'file_fullpath' => "C:\Users\Valdy\Documents\Upload\\" . $file_name,
                ], 
            ]);

            $newdate = '2019-11-'.$date;
            $nowdate = date("Y-m-d", strtotime($newdate));

            DB::table('bookings')->insert([
                [
                    'id_booking' => md5(uniqid()),
                    'id_peminjam' => "1f0bab64bcb61f7851d2c476dee6729d",
                    'nama_peminjam' => "a".$angka,
                    'nip_peminjam' => $nip,
                    'bidang_peminjam' => rand(1, 5),
                    'booking_room' => $rooms[rand(0,2)],
                    'booking_room_owner' => 5,
                    'booking_date' => $nowdate,
                    'booking_total_tamu' => 25,
                    'booking_total_snack' => 25,
                    'id_surat' => $id_surat,
                    'time_start' => 5,
                    'time_end' => 10,
                    'booking_status' => 3,
                    'request_hapus' => 0
                ], 
            ]);
            $date++;
            $angka++;
            $nip+=11;
        }
    }
}
