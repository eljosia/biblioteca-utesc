<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = array(
            array('id' => '1', 'user' => 'admin', 'name' => 'Héctor', 'last_n' => 'Guzmán', 'email' => 'hguzman@utescuinapa.edu.mx', 'rol' => 'A', 'email_verified_at' => NULL, 'password' => '$2y$10$0WubHngxVf43rzmFCXW9neSEdSTbVoGGrqxhAKOQUoday5mDkLj0e', 'remember_token' => NULL, 'created_at' => '2022-12-09 16:20:27', 'updated_at' => '2022-12-09 16:20:27'),
            array('id' => '2', 'user' => '201900262', 'name' => 'José Angel', 'last_n' => 'Rodriguez', 'email' => 'eljosia.rc@gmail.com', 'rol' => 'A', 'email_verified_at' => NULL, 'password' => '$2y$10$ngG0JQ4GjGGij9BPm9Ia3uYU6q6pGzYS8QEjhn8QMw/1RER5Bd3U.', 'remember_token' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '3', 'user' => 'biblioteca', 'name' => 'Claudia', 'last_n' => 'Crespo', 'email' => 'ccrespo@utescuinapa.edu.mx', 'rol' => 'C', 'email_verified_at' => NULL, 'password' => '$2y$10$i7jYUGqXFy658LvPImeEF.WpWgwdT0SuF6cjPXF66LO8KYOrnwl42', 'remember_token' => 'vIzGH3qhyoDyLP6L8iYPjeg1wSDpqG7xAGdDWD9gQGeUaFzETy9ukVnK8WzE', 'created_at' => NULL, 'updated_at' => NULL),
        );
        $clasifications = array(
            array('id' => '1', 'theme' => '000 Generalidades'),
            array('id' => '2', 'theme' => '010 Bibliografía'),
            array('id' => '3', 'theme' => '020 Bibliotecnología e informática'),
            array('id' => '4', 'theme' => '030 Enciclopedias generales'),
            array('id' => '5', 'theme' => '040 Este número no tiene ningún uso.'),
            array('id' => '6', 'theme' => '050 Publicaciones en serie'),
            array('id' => '7', 'theme' => '060 Organizaciones y museografía'),
            array('id' => '8', 'theme' => '070 Periodismo, editoriales, diarios'),
            array('id' => '9', 'theme' => '080 Colecciones generales'),
            array('id' => '10', 'theme' => '090 Manuscritos y libros raros'),
            array('id' => '11', 'theme' => '100 Filosofía y psicología'),
            array('id' => '12', 'theme' => '110 Metafísica'),
            array('id' => '13', 'theme' => '120 Conocimiento, causa, fin, hombre'),
            array('id' => '14', 'theme' => '130 Parapsicología, ocultismo'),
            array('id' => '15', 'theme' => '140 Puntos de vista filosóficos'),
            array('id' => '16', 'theme' => '150 Psicología'),
            array('id' => '17', 'theme' => '160 Lógica'),
            array('id' => '18', 'theme' => '170 Ética (filosofía moral)'),
            array('id' => '19', 'theme' => '180 Filosofía antigua, medieval, oriental'),
            array('id' => '20', 'theme' => '190 Filosofía moderna occidental'),
            array('id' => '21', 'theme' => '200 Religión'),
            array('id' => '22', 'theme' => '210 Religión natural'),
            array('id' => '23', 'theme' => '220 Biblia'),
            array('id' => '24', 'theme' => '230 Teología cristiana'),
            array('id' => '25', 'theme' => '240 Moral y prácticas cristianas'),
            array('id' => '26', 'theme' => '250 Iglesia local y órdenes religiosas'),
            array('id' => '27', 'theme' => '260 Teología social y eclesiología'),
            array('id' => '28', 'theme' => '270 Historia y geografía de la iglesia'),
            array('id' => '29', 'theme' => '280 Credos de la iglesia cristiana'),
            array('id' => '30', 'theme' => '290 Otras religiones'),
            array('id' => '31', 'theme' => '300 Ciencias sociales'),
            array('id' => '32', 'theme' => '310 Estadística'),
            array('id' => '33', 'theme' => '320 Ciencia política'),
            array('id' => '34', 'theme' => '330 Economía'),
            array('id' => '35', 'theme' => '340 Derecho'),
            array('id' => '36', 'theme' => '350 Administración pública'),
            array('id' => '37', 'theme' => '360 Patología y servicio sociales'),
            array('id' => '38', 'theme' => '370 Educación'),
            array('id' => '39', 'theme' => '380 Comercio'),
            array('id' => '40', 'theme' => '390 Costumbres y folklore'),
            array('id' => '41', 'theme' => '400 Lenguas'),
            array('id' => '42', 'theme' => '410 Lingüística'),
            array('id' => '43', 'theme' => '420 Inglés y anglosajón'),
            array('id' => '44', 'theme' => '430 Lenguas germánicas; alemán'),
            array('id' => '45', 'theme' => '440 Lenguas romances; francés'),
            array('id' => '46', 'theme' => '450 Italiano, rumano, rético'),
            array('id' => '47', 'theme' => '460 Español y portugués'),
            array('id' => '48', 'theme' => '470 Lenguas itálicas; latín'),
            array('id' => '49', 'theme' => '480 Lenguas helénicas; griego clásico'),
            array('id' => '50', 'theme' => '490 Otras lenguas'),
            array('id' => '51', 'theme' => '500Matemáticas y ciencias naturales'),
            array('id' => '52', 'theme' => '510 Matemáticas'),
            array('id' => '53', 'theme' => '520 Astronomía y ciencias afines'),
            array('id' => '54', 'theme' => '530 Física'),
            array('id' => '55', 'theme' => '540 Química y ciencias afines'),
            array('id' => '56', 'theme' => '550 Geociencias'),
            array('id' => '57', 'theme' => '560 Paleontología'),
            array('id' => '58', 'theme' => '570 Ciencias biológicas'),
            array('id' => '59', 'theme' => '580 Ciencias botánicas'),
            array('id' => '60', 'theme' => '590 Ciencias zoológicas'),
            array('id' => '61', 'theme' => '600 Tecnología y ciencias aplicadas'),
            array('id' => '62', 'theme' => '610 Ciencias médicas'),
            array('id' => '63', 'theme' => '620 Ingeniería y operaciones afines'),
            array('id' => '64', 'theme' => '630 Agricultura y tecnologías afines'),
            array('id' => '65', 'theme' => '640 Economía doméstica'),
            array('id' => '66', 'theme' => '650 Servicios administrativos empresariales'),
            array('id' => '67', 'theme' => '660 Ingeniería Química'),
            array('id' => '68', 'theme' => '670 Manufacturas'),
            array('id' => '69', 'theme' => '680 Manufacturas varias'),
            array('id' => '70', 'theme' => '690 Construcciones'),
            array('id' => '71', 'theme' => '700 Artes'),
            array('id' => '72', 'theme' => '710 Urbanismo y arquitectura del paisaje'),
            array('id' => '73', 'theme' => '720 Arquitectura'),
            array('id' => '74', 'theme' => '730 Artes plásticas; escultura'),
            array('id' => '75', 'theme' => '740 Dibujo, artes decorativas y menores'),
            array('id' => '76', 'theme' => '750 Pintura y pinturas'),
            array('id' => '77', 'theme' => '760 Artes gráficas; grabados'),
            array('id' => '78', 'theme' => '770 Fotografía y fotografías'),
            array('id' => '79', 'theme' => '780 Música'),
            array('id' => '80', 'theme' => '790 Entretenimiento'),
            array('id' => '81', 'theme' => '800 Literatura'),
            array('id' => '82', 'theme' => '810 Literatura americana en inglés'),
            array('id' => '83', 'theme' => '820 Literatura inglesa y anglosajona'),
            array('id' => '84', 'theme' => '830 Literaturas germánicas'),
            array('id' => '85', 'theme' => '840 Literaturas de las lenguas romances'),
            array('id' => '86', 'theme' => '850 Literaturas italiana, rumana'),
            array('id' => '87', 'theme' => '860 Literaturas española y portuguesa'),
            array('id' => '88', 'theme' => '870 Literaturas de las lenguas itálicas'),
            array('id' => '89', 'theme' => '880 Literaturas de las lenguas helénicas'),
            array('id' => '90', 'theme' => '890 Literaturas de otras lenguas'),
            array('id' => '91', 'theme' => '900 Historia y geografía'),
            array('id' => '92', 'theme' => '910 Geografía; viajes'),
            array('id' => '93', 'theme' => '920 Biografía y genealogía'),
            array('id' => '94', 'theme' => '930 Historia del mundo antiguo'),
            array('id' => '95', 'theme' => '940 Historia de Europa'),
            array('id' => '96', 'theme' => '950 Historia de Asia'),
            array('id' => '97', 'theme' => '960 Historia deÁfrica'),
            array('id' => '98', 'theme' => '970 Historia de América del Norte'),
            array('id' => '99', 'theme' => '980 Historia de América del Sur'),
            array('id' => '100', 'theme' => '990 Historia de otras regiones'),
            array('id' => '101', 'theme' => '991 Ciencias Naturales')
        );

        $careers = array(
            array('name' => 'Mantenimiento'),
            array('name' => 'Tecnologías'),
            array('name' => 'Gastronomía'),
            array('name' => 'Agricultura'),
            array('name' => 'Enfermería'),
            array('name' => 'Procesos Bioalimentarios'),
            array('name' => 'Turismo'),
            array('name' => 'Infantiles'),
            array('name' => 'Mecatrónica'),
            array('name' => 'Otros'),
        );

        DB::table('users')->insert($users);
        DB::table('classifications')->insert($clasifications);
        DB::table('careers')->insert($careers);
    }
}
