<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Level extends Enum
{
    const LEVEL1 = ['id' => 1, 'name' => 'Phàm Nhân', 'next_exp' => 120];
    const LEVEL2 = ['id' => 2, 'name' => 'Luyện Khí Tầng 1',  'next_exp' => 246];
    const LEVEL3 = ['id' => 3, 'name' => 'Luyện Khí Tầng 2', 'next_exp' => 378];
    const LEVEL4 = ['id' => 4, 'name' => 'Luyện Khí Tầng 3', 'next_exp' => 517];
    const LEVEL5 = ['id' => 5, 'name' => 'Luyện Khí Tầng 4', 'next_exp' => 663];
    const LEVEL6 = ['id' => 6, 'name' => 'Luyện Khí Tầng 5', 'next_exp' => 816];
    const LEVEL7 = ['id' => 7, 'name' => 'Luyện Khí Tầng 6', 'next_exp' => 977];
    const LEVEL8 = ['id' => 8, 'name' => 'Luyện Khí Tầng 7', 'next_exp' => 1146];
    const LEVEL9 = ['id' => 9, 'name' => 'Luyện Khí Tầng 8', 'next_exp' => 1323];
    const LEVEL10 = ['id' => 10, 'name' => 'Luyện Khí Tầng 9', 'next_exp' => 1509];
    const LEVEL11 = ['id' => 11, 'name' => 'Luyện Khí Tầng 10', 'next_exp' => 1704];
    const LEVEL12 = ['id' => 12, 'name' => 'Luyện Khí Tầng 11', 'next_exp' => 1909];
    const LEVEL13 = ['id' => 13, 'name' => 'Luyện Khí Tầng 12', 'next_exp' => 2125];
    const LEVEL14 = ['id' => 14, 'name' => 'Luyện Khí Tầng 13', 'next_exp' => 2351];
    const LEVEL15 = ['id' => 15, 'name' => 'Luyện Khí Tầng 14', 'next_exp' => 2589];
    const LEVEL16 = ['id' => 16, 'name' => 'Luyện Khí Tầng 15', 'next_exp' => 2838];
    const LEVEL17 = ['id' => 17, 'name' => 'Trúc Cơ Sơ Kỳ', 'next_exp' => 3112];
    const LEVEL18 = ['id' => 18, 'name' => 'Trúc Cơ Trung Kỳ', 'next_exp' => 3414];
    const LEVEL19 = ['id' => 19, 'name' => 'Trúc Cơ Hậu Kỳ', 'next_exp' => 3746];
    const LEVEL20 = ['id' => 20, 'name' => 'Trúc Cơ Viên Mãn', 'next_exp' => 4111];
    const LEVEL21 = ['id' => 21, 'name' => 'Kết Đan Sơ Kỳ','next_exp' => 4531];
    const LEVEL22 = ['id' => 22, 'name' => 'Kết Đan Trung Kỳ', 'next_exp' => 5014];
    const LEVEL23 = ['id' => 23, 'name' => 'Kết Đan Hậu Kỳ',  'next_exp' => 5570];
    const LEVEL24 = ['id' => 24, 'name' => 'Kết Đan Viên Mãn', 'next_exp' => 6209];
    const LEVEL25 = ['id' => 25, 'name' => 'Nguyên Anh Sơ Kỳ', 'next_exp' => 6976];
    const LEVEL26 = ['id' => 26, 'name' => 'Nguyên Anh Trung Kỳ', 'next_exp' => 7896];
    const LEVEL27 = ['id' => 27, 'name' => 'Nguyên Anh Hậu Kỳ', 'next_exp' => 9000];
    const LEVEL28 = ['id' => 28, 'name' => 'Nguyên Anh Viên Mãn', 'next_exp' => 10325];
    const LEVEL29 = ['id' => 29, 'name' => 'Hóa Thần Sơ Kỳ', 'next_exp' => 11981];
    const LEVEL30 = ['id' => 30, 'name' => 'Hóa Thần Trung Kỳ', 'next_exp' => 14051];
    const LEVEL31 = ['id' => 31, 'name' => 'Hóa Thần Hậu Kỳ', 'next_exp' => 16638];
    const LEVEL32 = ['id' => 32, 'name' => 'Hóa Thần Viên Mãn', 'next_exp' => 19872];
    const LEVEL33 = ['id' => 33, 'name' => 'Luyện Hư Sơ Kỳ', 'next_exp' => 24076];
    const LEVEL34 = ['id' => 34, 'name' => 'Luyện Hư Trung Kỳ', 'next_exp' => 29542];
    const LEVEL35 = ['id' => 35, 'name' => 'Luyện Hư Hậu Kỳ', 'next_exp' => 36647];
    const LEVEL36 = ['id' => 36, 'name' => 'Luyện Hư Viên Mãn', 'next_exp' => 45884];
    const LEVEL37 = ['id' => 37, 'name' => 'Hợp Thể Sơ Kỳ', 'next_exp' => 58354];
    const LEVEL38 = ['id' => 38, 'name' => 'Hợp Thể Trung Kỳ', 'next_exp' => 75188];
    const LEVEL39 = ['id' => 39, 'name' => 'Hợp Thể Hậu Kỳ', 'next_exp' => 97914];
    const LEVEL40 = ['id' => 40, 'name' => 'Hợp Thể Viên Mãn', 'next_exp' => 128594];
    const LEVEL41 = ['id' => 41, 'name' => 'Đại Thừa Sơ Kỳ', 'next_exp' => 171546];
    const LEVEL42 = ['id' => 42, 'name' => 'Đại Thừa Trung Kỳ', 'next_exp' => 231679];
    const LEVEL43 = ['id' => 43, 'name' => 'Đại Thừa Hậu Kỳ', 'next_exp' => 315865];
    const LEVEL44 = ['id' => 44, 'name' => 'Đại Thừa Viên Mãn', 'next_exp' => 433726];
    const LEVEL45 = ['id' => 45, 'name' => 'Độ Kiếp Sơ Kỳ', 'next_exp' => 604624];
    const LEVEL46 = ['id' => 46, 'name' => 'Độ Kiếp Trung Kỳ', 'next_exp' => 852426];
    const LEVEL47 = ['id' => 47, 'name' => 'Độ Kiếp Hậu Kỳ', 'next_exp' => 1211739];
    const LEVEL48 = ['id' => 48, 'name' => 'Độ Kiếp Viên Mãn', 'next_exp' => 1732742];
    const LEVEL49 = ['id' => 49, 'name' => 'Chân Tiên Sơ Kỳ', 'next_exp' => 2514247];
    const LEVEL50 = ['id' => 50, 'name' => 'Chân Tiên Trung Kỳ', 'next_exp' => 3686505];
    const LEVEL51 = ['id' => 51, 'name' => 'Chân Tiên Hậu Kỳ', 'next_exp' => 5444891];
    const LEVEL52 = ['id' => 52, 'name' => 'Chân Tiên Viên Mãn', 'next_exp' => 8082470];
    const LEVEL53 = ['id' => 53, 'name' => 'Kim Tiên Sơ Kỳ', 'next_exp' => 12170718];
    const LEVEL54 = ['id' => 54, 'name' => 'Kim Tiên Trung Kỳ', 'next_exp' => 18507502];
    const LEVEL55 = ['id' => 55, 'name' => 'Kim Tiên Hậu Kỳ', 'next_exp' => 28329518];
    const LEVEL56 = ['id' => 56, 'name' => 'Kim Tiên Viên Mãn', 'next_exp' => 43553643];
    const LEVEL57 = ['id' => 57, 'name' => 'Thái Ất Ngọc Tiên Sơ Kỳ', 'next_exp' => 67912243];
    const LEVEL58 = ['id' => 58, 'name' => 'Thái Ất Ngọc Tiên Trung Kỳ', 'next_exp' => 106886002];
    const LEVEL59 = ['id' => 59, 'name' => 'Thái Ất Ngọc Tiên Hậu Kỳ', 'next_exp' => 169244017];
    const LEVEL60 = ['id' => 60, 'name' => 'Thái Ất Ngọc Tiên Viên Mãn', 'next_exp' => 269016841];
    const LEVEL61 = ['id' => 61, 'name' => 'Đại La Sơ Kỳ', 'next_exp' => 433642001];
    const LEVEL62 = ['id' => 62, 'name' => 'Đại La Trung Kỳ', 'next_exp' => 705273514];
    const LEVEL63 = ['id' => 63, 'name' => 'Đại La Hậu Kỳ', 'next_exp' => 1153465511];
    const LEVEL64 = ['id' => 64, 'name' => 'Đại La Viên Mãn', 'next_exp' => 1892982306];
    const LEVEL65 = ['id' => 65, 'name' => 'Trảm Ác Thi', 'next_exp' => 3150160858];
    const LEVEL66 = ['id' => 66, 'name' => 'Trảm Thiện Thi', 'next_exp' => 5287364396];
    const LEVEL67 = ['id' => 67, 'name' => 'Trảm Tự Ngã Thi', 'next_exp' => 8920610410];
    const LEVEL68 = ['id' => 68, 'name' => 'Đạo Tổ', 'next_exp' => 0];
}
