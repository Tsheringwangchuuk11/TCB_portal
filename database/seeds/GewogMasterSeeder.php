<?php

use Illuminate\Database\Seeder;

class GewogMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_gewog_masters')->insert([
            ['id' => 1, 'gewog_name' => 'Chokhor','dzongkhag_id' => 1],
            ['id' => 2, 'gewog_name' => 'Chumey','dzongkhag_id' => 1],
            ['id' => 3, 'gewog_name' => 'Tang','dzongkhag_id' => 1],
            ['id' => 4, 'gewog_name' => 'Ura','dzongkhag_id' => 1],
            ['id' => 5, 'gewog_name' => 'Unknown','dzongkhag_id' => 1],
            ['id' => 6, 'gewog_name' => 'Sampheling/Bhalujora','dzongkhag_id' => 2],
            ['id' => 7, 'gewog_name' => 'Bjachho','dzongkhag_id' => 2],
            ['id' => 8, 'gewog_name' => 'Bongo','dzongkhag_id' => 2],
            ['id' => 9, 'gewog_name' => 'Chapcha','dzongkhag_id' => 2],
            ['id' => 10, 'gewog_name' => 'Darla','dzongkhag_id' => 2],
            ['id' => 11, 'gewog_name' => 'Dungna','dzongkhag_id' => 2],
            ['id' => 12, 'gewog_name' => 'Geling','dzongkhag_id' => 2],
            ['id' => 13, 'gewog_name' => 'Getana','dzongkhag_id' => 2],
            ['id' => 14, 'gewog_name' => 'Lokchina','dzongkhag_id' => 2],
            ['id' => 15, 'gewog_name' => 'Metakha','dzongkhag_id' => 2],
            ['id' => 16, 'gewog_name' => 'Phuntsholing','dzongkhag_id' => 2],
            ['id' => 17, 'gewog_name' => 'Phuntsholing Throm','dzongkhag_id' => 2],
            ['id' => 18, 'gewog_name' => 'Unknown','dzongkhag_id' => 3],
            ['id' => 19, 'gewog_name' => 'Dorona','dzongkhag_id' => 3],
            ['id' => 20, 'gewog_name' => 'Drujeygang','dzongkhag_id' => 3],
            ['id' => 21, 'gewog_name' => 'Gesarling','dzongkhag_id' => 3],
            ['id' => 22, 'gewog_name' => 'Goshi','dzongkhag_id' => 3],
            ['id' => 23, 'gewog_name' => 'Kana','dzongkhag_id' => 3],
            ['id' => 24, 'gewog_name' => 'Khebisa','dzongkhag_id' => 3],
            ['id' => 25, 'gewog_name' => 'Lajab','dzongkhag_id' => 3],
            ['id' => 26, 'gewog_name' => 'Trashiding','dzongkhag_id' => 3],
            ['id' => 27, 'gewog_name' => 'Tsendagang (Suntalay)','dzongkhag_id' => 3],
            ['id' => 28, 'gewog_name' => 'Tseza','dzongkhag_id' => 3],
            ['id' => 29, 'gewog_name' => 'Tsangkha','dzongkhag_id' => 3],
            ['id' => 30, 'gewog_name' => 'Karmaling','dzongkhag_id' => 3],
            ['id' => 31, 'gewog_name' => 'Lhamoyzingkhag/Kalikhola','dzongkhag_id' => 3],
            ['id' => 32, 'gewog_name' => 'Nichula','dzongkhag_id' => 3],
            ['id' => 33, 'gewog_name' => 'Daga Throm','dzongkhag_id' => 3],
            ['id' => 34, 'gewog_name' => 'Unknown','dzongkhag_id' => 3],
            ['id' => 35, 'gewog_name' => 'Khamae','dzongkhag_id' => 4],
            ['id' => 36, 'gewog_name' => 'Khatoe','dzongkhag_id' => 4],
            ['id' => 37, 'gewog_name' => 'Laya','dzongkhag_id' => 4],
            ['id' => 38, 'gewog_name' => 'Lunana','dzongkhag_id' => 4],
            ['id' => 39, 'gewog_name' => 'Unknown','dzongkhag_id' => 4],
            ['id' => 40, 'gewog_name' => 'Bji','dzongkhag_id' => 5],
            ['id' => 41, 'gewog_name' => 'Eusu','dzongkhag_id' => 5],
            ['id' => 42, 'gewog_name' => 'Katsho','dzongkhag_id' => 5],
            ['id' => 43, 'gewog_name' => 'Samar','dzongkhag_id' => 5],
            ['id' => 44, 'gewog_name' => 'Sangbay','dzongkhag_id' => 5],
            ['id' => 45, 'gewog_name' => 'Gakiling','dzongkhag_id' => 5],
            ['id' => 46, 'gewog_name' => 'Unknown','dzongkhag_id' => 5],
            ['id' => 47, 'gewog_name' => 'Gangzur','dzongkhag_id' => 6],
            ['id' => 48, 'gewog_name' => 'Jaray','dzongkhag_id' => 6],
            ['id' => 49, 'gewog_name' => 'Khoma','dzongkhag_id' => 6],
            ['id' => 50, 'gewog_name' => 'Kurtoe','dzongkhag_id' => 6],
            ['id' => 51, 'gewog_name' => 'Menbi','dzongkhag_id' => 6],
            ['id' => 52, 'gewog_name' => 'Menji','dzongkhag_id' => 6],
            ['id' => 53, 'gewog_name' => 'Metsho','dzongkhag_id' => 6],
            ['id' => 54, 'gewog_name' => 'Tshenkhar','dzongkhag_id' => 6],
            ['id' => 55, 'gewog_name' => 'Unknown','dzongkhag_id' => 6],
            ['id' => 56, 'gewog_name' => 'Balam','dzongkhag_id' => 7],
            ['id' => 57, 'gewog_name' => 'Chali','dzongkhag_id' => 7],
            ['id' => 58, 'gewog_name' => 'Chaskhar','dzongkhag_id' => 7],
            ['id' => 59, 'gewog_name' => 'Depong','dzongkhag_id' => 7],
            ['id' => 60, 'gewog_name' => 'Drametse','dzongkhag_id' => 7],
            ['id' => 61, 'gewog_name' => 'Gungdue','dzongkhag_id' => 7],
            ['id' => 62, 'gewog_name' => 'Jurmey','dzongkhag_id' => 7],
            ['id' => 63, 'gewog_name' => 'Kengkhar','dzongkhag_id' => 7],
            ['id' => 64, 'gewog_name' => 'Mongar','dzongkhag_id' => 7],
            ['id' => 65, 'gewog_name' => 'Ngatshang','dzongkhag_id' => 7],
            ['id' => 66, 'gewog_name' => 'Saling','dzongkhag_id' => 7],
            ['id' => 67, 'gewog_name' => 'Sherimung','dzongkhag_id' => 7],
            ['id' => 68, 'gewog_name' => 'Silambi','dzongkhag_id' => 7],
            ['id' => 69, 'gewog_name' => 'Thangrong','dzongkhag_id' => 7],
            ['id' => 70, 'gewog_name' => 'Tsamang','dzongkhag_id' => 7],
            ['id' => 71, 'gewog_name' => 'Tshakaling','dzongkhag_id' => 7],
            ['id' => 72, 'gewog_name' => 'Narang','dzongkhag_id' => 7],
            ['id' => 73, 'gewog_name' => 'Unknown','dzongkhag_id' => 7],
            ['id' => 74, 'gewog_name' => 'Dogar','dzongkhag_id' => 8],
            ['id' => 75, 'gewog_name' => 'Dopshari','dzongkhag_id' => 8],
            ['id' => 76, 'gewog_name' => 'Doteng','dzongkhag_id' => 8],
            ['id' => 77, 'gewog_name' => 'Hungrel','dzongkhag_id' => 8],
            ['id' => 78, 'gewog_name' => 'Lamgong','dzongkhag_id' => 8],
            ['id' => 79, 'gewog_name' => 'Lungnyi','dzongkhag_id' => 8],
            ['id' => 80, 'gewog_name' => 'Naja','dzongkhag_id' => 8],
            ['id' => 81, 'gewog_name' => 'Shaba','dzongkhag_id' => 8],
            ['id' => 82, 'gewog_name' => 'Throm','dzongkhag_id' => 8],
            ['id' => 83, 'gewog_name' => 'Tsento','dzongkhag_id' => 8],
            ['id' => 84, 'gewog_name' => 'Wangchang','dzongkhag_id' => 8],
            ['id' => 85, 'gewog_name' => 'Unknown','dzongkhag_id' => 8],
            ['id' => 86, 'gewog_name' => 'Chimung','dzongkhag_id' => 9],
            ['id' => 87, 'gewog_name' => 'Chongshing','dzongkhag_id' => 9],
            ['id' => 88, 'gewog_name' => 'Dungmin','dzongkhag_id' => 9],
            ['id' => 89, 'gewog_name' => 'Khar','dzongkhag_id' => 9],
            ['id' => 90, 'gewog_name' => 'Shumar','dzongkhag_id' => 9],
            ['id' => 91, 'gewog_name' => 'Yurung','dzongkhag_id' => 9],
            ['id' => 92, 'gewog_name' => 'Zobel','dzongkhag_id' => 9],
            ['id' => 93, 'gewog_name' => 'Choekhorling','dzongkhag_id' => 9],
            ['id' => 94, 'gewog_name' => 'Dechheling','dzongkhag_id' => 9],
            ['id' => 95, 'gewog_name' => 'Nanong','dzongkhag_id' => 9],
            ['id' => 96, 'gewog_name' => 'Norbugang','dzongkhag_id' => 9],
            ['id' => 97, 'gewog_name' => 'Unknown','dzongkhag_id' => 9],
            ['id' => 98, 'gewog_name' => 'Chubu','dzongkhag_id' => 10],
            ['id' => 99, 'gewog_name' => 'Dzomesa','dzongkhag_id' => 10],
            ['id' => 100, 'gewog_name' => 'Goenshari','dzongkhag_id' => 10],
            ['id' => 101, 'gewog_name' => 'Guma','dzongkhag_id' => 10],
            ['id' => 102, 'gewog_name' => 'Kabjisa','dzongkhag_id' => 10],
            ['id' => 103, 'gewog_name' => 'Lingmukha','dzongkhag_id' => 10],
            ['id' => 104, 'gewog_name' => 'Shengana','dzongkhag_id' => 10],
            ['id' => 105, 'gewog_name' => 'Talo','dzongkhag_id' => 10],
            ['id' => 106, 'gewog_name' => 'Teowang','dzongkhag_id' => 10],
            ['id' => 107, 'gewog_name' => 'Barp','dzongkhag_id' => 10],
            ['id' => 108, 'gewog_name' => 'Toebisa','dzongkhag_id' => 10],
            ['id' => 109, 'gewog_name' => 'Unknown','dzongkhag_id' => 10],
            ['id' => 110, 'gewog_name' => 'Gomdar','dzongkhag_id' => 11],
            ['id' => 111, 'gewog_name' => 'Langchenphu','dzongkhag_id' => 11],
            ['id' => 112, 'gewog_name' => 'Lauri','dzongkhag_id' => 11],
            ['id' => 113, 'gewog_name' => 'Martshala','dzongkhag_id' => 11],
            ['id' => 114, 'gewog_name' => 'Orong','dzongkhag_id' => 11],
            ['id' => 115, 'gewog_name' => 'Pemathang/Dalim','dzongkhag_id' => 11],
            ['id' => 116, 'gewog_name' => 'Phuntshothang/Bakuli','dzongkhag_id' => 11],
            ['id' => 117, 'gewog_name' => 'Samrang','dzongkhag_id' => 11],
            ['id' => 118, 'gewog_name' => 'Serthi','dzongkhag_id' => 11],
            ['id' => 119, 'gewog_name' => 'Deothang','dzongkhag_id' => 11],
            ['id' => 120, 'gewog_name' => 'Wangphu','dzongkhag_id' => 11],
            ['id' => 121, 'gewog_name' => 'Unknown','dzongkhag_id' => 11],
            ['id' => 122, 'gewog_name' => 'Norgaygang/Bara','dzongkhag_id' => 12],
            ['id' => 123, 'gewog_name' => 'Pemaling/Biru','dzongkhag_id' => 12],
            ['id' => 124, 'gewog_name' => 'Sangacholing/Chargharey','dzongkhag_id' => 12],
            ['id' => 125, 'gewog_name' => 'Norbugang/Chengmari','dzongkhag_id' => 12],
            ['id' => 126, 'gewog_name' => 'Denchukha','dzongkhag_id' => 12],
            ['id' => 127, 'gewog_name' => 'Dophuchen/Dorokha','dzongkhag_id' => 12],
            ['id' => 128, 'gewog_name' => 'Dumtoe','dzongkhag_id' => 12],
            ['id' => 129, 'gewog_name' => 'Yoesheltse/Ghumauney','dzongkhag_id' => 12],
            ['id' => 130, 'gewog_name' => 'Namgyelcholing/Lahireni','dzongkhag_id' => 12],
            ['id' => 131, 'gewog_name' => 'Ugyentse/Nainital','dzongkhag_id' => 12],
            ['id' => 132, 'gewog_name' => 'Phuntshopelri/Pugli','dzongkhag_id' => 12],
            ['id' => 133, 'gewog_name' => 'Samtse','dzongkhag_id' => 12],
            ['id' => 134, 'gewog_name' => 'Tashicholing/Sipsu','dzongkhag_id' => 12],
            ['id' => 135, 'gewog_name' => 'Tading','dzongkhag_id' => 12],
            ['id' => 136, 'gewog_name' => 'Tendu','dzongkhag_id' => 12],
            ['id' => 137, 'gewog_name' => 'Unknown','dzongkhag_id' => 12],
            ['id' => 138, 'gewog_name' => 'Samtenling','dzongkhag_id' => 13],
            ['id' => 139, 'gewog_name' => 'Chuzagang','dzongkhag_id' => 13],
            ['id' => 140, 'gewog_name' => 'Dekiling','dzongkhag_id' => 13],
            ['id' => 141, 'gewog_name' => 'Chhudzom','dzongkhag_id' => 13],
            ['id' => 142, 'gewog_name' => 'Gelephu','dzongkhag_id' => 13],
            ['id' => 143, 'gewog_name' => 'Gakidling','dzongkhag_id' => 13],
            ['id' => 144, 'gewog_name' => 'Jigmechoeling','dzongkhag_id' => 13],
            ['id' => 145, 'gewog_name' => 'Shompangkha','dzongkhag_id' => 13],
            ['id' => 146, 'gewog_name' => 'Sershong','dzongkhag_id' => 13],
            ['id' => 147, 'gewog_name' => 'Senggey','dzongkhag_id' => 13],
            ['id' => 148, 'gewog_name' => 'Tareythang','dzongkhag_id' => 13],
            ['id' => 149, 'gewog_name' => 'Umling','dzongkhag_id' => 13],
            ['id' => 150, 'gewog_name' => 'Unknown','dzongkhag_id' => 13],
            ['id' => 151, 'gewog_name' => 'Chang','dzongkhag_id' => 14],
            ['id' => 152, 'gewog_name' => 'Dagala','dzongkhag_id' => 14],
            ['id' => 153, 'gewog_name' => 'Geney','dzongkhag_id' => 14],
            ['id' => 154, 'gewog_name' => 'Kawang','dzongkhag_id' => 14],
            ['id' => 155, 'gewog_name' => 'Lingzhi','dzongkhag_id' => 14],
            ['id' => 156, 'gewog_name' => 'Mewang','dzongkhag_id' => 14],
            ['id' => 157, 'gewog_name' => 'Naro','dzongkhag_id' => 14],
            ['id' => 158, 'gewog_name' => 'Soe','dzongkhag_id' => 14],
            ['id' => 159, 'gewog_name' => 'Thim Throm','dzongkhag_id' => 14],
            ['id' => 160, 'gewog_name' => 'Unknown','dzongkhag_id' => 14],
            ['id' => 161, 'gewog_name' => 'Bartsham','dzongkhag_id' => 15],
            ['id' => 162, 'gewog_name' => 'Bidung','dzongkhag_id' => 15],
            ['id' => 163, 'gewog_name' => 'Kanglung','dzongkhag_id' => 15],
            ['id' => 164, 'gewog_name' => 'Kangpara','dzongkhag_id' => 15],
            ['id' => 165, 'gewog_name' => 'Khaling','dzongkhag_id' => 15],
            ['id' => 166, 'gewog_name' => 'Lumang','dzongkhag_id' => 15],
            ['id' => 167, 'gewog_name' => 'Merak','dzongkhag_id' => 15],
            ['id' => 168, 'gewog_name' => 'Phongme','dzongkhag_id' => 15],
            ['id' => 169, 'gewog_name' => 'Phongme','dzongkhag_id' => 15],
            ['id' => 170, 'gewog_name' => 'Sakteng','dzongkhag_id' => 15],
            ['id' => 171, 'gewog_name' => 'Samkhar','dzongkhag_id' => 15],
            ['id' => 172, 'gewog_name' => 'Shongphu','dzongkhag_id' => 15],
            ['id' => 173, 'gewog_name' => 'Thrimshing','dzongkhag_id' => 15],
            ['id' => 174, 'gewog_name' => 'Uzarung','dzongkhag_id' => 15],
            ['id' => 175, 'gewog_name' => 'Yangnyer','dzongkhag_id' => 15],
            ['id' => 176, 'gewog_name' => 'Unknown','dzongkhag_id' => 15],
            ['id' => 177, 'gewog_name' => 'Bumdeyling','dzongkhag_id' => 16],
            ['id' => 178, 'gewog_name' => 'Jamkhar','dzongkhag_id' => 16],
            ['id' => 179, 'gewog_name' => 'Khamdang','dzongkhag_id' => 16],
            ['id' => 180, 'gewog_name' => 'Ramjar','dzongkhag_id' => 16],
            ['id' => 181, 'gewog_name' => 'Toetsho','dzongkhag_id' => 16],
            ['id' => 182, 'gewog_name' => 'Tongzhang','dzongkhag_id' => 16],
            ['id' => 183, 'gewog_name' => 'Yalang','dzongkhag_id' => 16],
            ['id' => 184, 'gewog_name' => 'Yangtse','dzongkhag_id' => 16],
            ['id' => 185, 'gewog_name' => 'Unknown','dzongkhag_id' => 16],
            ['id' => 186, 'gewog_name' => 'Drakten','dzongkhag_id' => 17],
            ['id' => 187, 'gewog_name' => 'Korphu','dzongkhag_id' => 17],
            ['id' => 188, 'gewog_name' => 'Langthil','dzongkhag_id' => 17],
            ['id' => 189, 'gewog_name' => 'Nubee','dzongkhag_id' => 17],
            ['id' => 190, 'gewog_name' => 'Tangsibjee','dzongkhag_id' => 17],
            ['id' => 191, 'gewog_name' => 'Unknown','dzongkhag_id' => 17],
            ['id' => 192, 'gewog_name' => 'Barshong','dzongkhag_id' => 18],
            ['id' => 193, 'gewog_name' => 'Patshaling','dzongkhag_id' => 18],
            ['id' => 194, 'gewog_name' => 'Doonglagang','dzongkhag_id' => 18],
            ['id' => 195, 'gewog_name' => 'Gosarling','dzongkhag_id' => 18],
            ['id' => 196, 'gewog_name' => 'Kilkhorthang','dzongkhag_id' => 18],
            ['id' => 197, 'gewog_name' => 'Mendrelgang','dzongkhag_id' => 18],
            ['id' => 198, 'gewog_name' => 'Sergithang','dzongkhag_id' => 18],
            ['id' => 199, 'gewog_name' => 'Phuentenchu','dzongkhag_id' => 18],
            ['id' => 200, 'gewog_name' => 'Rangthangling','dzongkhag_id' => 18],
            ['id' => 201, 'gewog_name' => 'Semjong','dzongkhag_id' => 18],
            ['id' => 202, 'gewog_name' => 'Tsholingkhar','dzongkhag_id' => 18],
            ['id' => 203, 'gewog_name' => 'Tsirangtoe','dzongkhag_id' => 18],
            ['id' => 204, 'gewog_name' => 'Unknown','dzongkhag_id' => 18],
            ['id' => 205, 'gewog_name' => 'Athang','dzongkhag_id' => 19],
            ['id' => 206, 'gewog_name' => 'Bjena','dzongkhag_id' => 19],
            ['id' => 207, 'gewog_name' => 'Daga','dzongkhag_id' => 19],
            ['id' => 208, 'gewog_name' => 'Dangchu','dzongkhag_id' => 19],
            ['id' => 209, 'gewog_name' => 'Gangtey','dzongkhag_id' => 19],
            ['id' => 210, 'gewog_name' => 'Gase Tshogom','dzongkhag_id' => 19],
            ['id' => 211, 'gewog_name' => 'Gase Tshoom','dzongkhag_id' => 19],
            ['id' => 212, 'gewog_name' => 'Kazhi','dzongkhag_id' => 19],
            ['id' => 213, 'gewog_name' => 'Nahi','dzongkhag_id' => 19],
            ['id' => 214, 'gewog_name' => 'Nyisho','dzongkhag_id' => 19],
            ['id' => 215, 'gewog_name' => 'Phangyul','dzongkhag_id' => 19],
            ['id' => 216, 'gewog_name' => 'Phobji','dzongkhag_id' => 19],
            ['id' => 217, 'gewog_name' => 'Rubesa','dzongkhag_id' => 19],
            ['id' => 218, 'gewog_name' => 'Sephu','dzongkhag_id' => 19],
            ['id' => 219, 'gewog_name' => 'Thedtsho','dzongkhag_id' => 19],
            ['id' => 220, 'gewog_name' => 'Unknown','dzongkhag_id' => 19],
            ['id' => 221, 'gewog_name' => 'Bardo','dzongkhag_id' => 20],
            ['id' => 222, 'gewog_name' => 'Bjoka','dzongkhag_id' => 20],
            ['id' => 223, 'gewog_name' => 'Goshing','dzongkhag_id' => 20],
            ['id' => 224, 'gewog_name' => 'Nangkor','dzongkhag_id' => 20],
            ['id' => 225, 'gewog_name' => 'Ngangla','dzongkhag_id' => 20],
            ['id' => 226, 'gewog_name' => 'Phangkhar','dzongkhag_id' => 20],
            ['id' => 227, 'gewog_name' => 'Shingkhar','dzongkhag_id' => 20],
            ['id' => 228, 'gewog_name' => 'Trong','dzongkhag_id' => 20],
            ['id' => 229, 'gewog_name' => 'Unknown','dzongkhag_id' => 20],
            ['id' => 230, 'gewog_name' => 'Gelephu Throm','dzongkhag_id' => 13],
            ['id' => 231, 'gewog_name' => 'Samdrupjongkhar Throm','dzongkhag_id' => 11],
            ['id' => 232, 'gewog_name' => 'Phaling Throm','dzongkhag_id' => 6],
            ['id' => 233, 'gewog_name' => 'Bajo Throm','dzongkhag_id' => 19],
            ['id' => 234, 'gewog_name' => 'Khuruthang Throm','dzongkhag_id' => 10],
            ['id' => 235, 'gewog_name' => 'Zhemgang Throm','dzongkhag_id' => 20],
            ['id' => 236, 'gewog_name' => 'Haa Throm','dzongkhag_id' => 5],
            ['id' => 237, 'gewog_name' => 'Bumthang Throm','dzongkhag_id' => 1],
            ['id' => 238, 'gewog_name' => 'Gasa Throm','dzongkhag_id' => 4],
            ['id' => 239, 'gewog_name' => 'Mongar Throm','dzongkhag_id' => 7],
            ['id' => 240, 'gewog_name' => 'Throm','dzongkhag_id' => 9],
            ['id' => 241, 'gewog_name' => 'UnknoSamtse Thromwn','dzongkhag_id' => 12],
            ['id' => 242, 'gewog_name' => 'Throm','dzongkhag_id' => 15],
            ['id' => 243, 'gewog_name' => 'Throm','dzongkhag_id' => 16],
            ['id' => 244, 'gewog_name' => 'Throm','dzongkhag_id' => 17],
            ['id' => 245, 'gewog_name' => 'Throm','dzongkhag_id' => 18],           
        ]);
    }
}
