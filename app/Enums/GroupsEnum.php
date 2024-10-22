<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GroupsEnum extends Enum
{
    const USER =   ['value' => 'Quản lý User', 'permission' => [
        [
            'role' => 'admin.users.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.users.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.users.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.users.destroy',
            'name' => 'Xóa'
        ],
    ]];
    const GROUP =   ['value' => 'Quản lý việc phân quyền', 'permission' => [
        [
            'role' => 'admin.groups.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.groups.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.groups.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.groups.destroy',
            'name' => 'Xóa'
        ],
        [
            'role' => 'admin.groups.permission',
            'name' => 'Phân quyền'
        ],
        
    ]];

    const SETTINGS =   ['value' => 'Cài đặt trang web', 'permission' => [
        [
            'role' => 'admin.setting.pageOne',
            'name' => 'Trang chủ'
        ]
    ]];

    const CATEGORY =   ['value' => 'Quản lý thể loại truyện', 'permission' => [
        [
            'role' => 'admin.category.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.category.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.category.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.category.destroy',
            'name' => 'Xóa'
        ],
    ]];
    const AUTHOR =   ['value' => 'Quản lý tác giả', 'permission' => [
        [
            'role' => 'admin.author.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.author.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.author.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.author.destroy',
            'name' => 'Xóa'
        ],
    ]];

    const STORY =   ['value' => 'Quản lý Bộ truyện', 'permission' => [
        [
            'role' => 'admin.stories.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.stories.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.stories.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.stories.destroy',
            'name' => 'Xóa'
        ],
    ]];
    const CHAPTER =   ['value' => 'Quản lý các chương truyện', 'permission' => [
        [
            'role' => 'admin.chapers.getItems',
            'name' => 'Xem'
        ],
        [
            'role' => 'admin.chapers.store',
            'name' => 'Thêm mới'
        ],
        [
            'role' => 'admin.chapers.update',
            'name' => 'Cập nhật'
        ],
        [
            'role' => 'admin.chapers.destroy',
            'name' => 'Xóa'
        ],
    ]];

    const VISITWWEBSITE =   ['value' => 'Theo dõi thông số trang web', 'permission' => [
        [
            'role' => 'admin.visitWebsite.getItems',
            'name' => 'Xem'
        ],

    ]];
}
