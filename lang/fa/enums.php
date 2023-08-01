<?php

use App\Enums\Database\Meet\MeetConnectionWay;
use App\Enums\Database\Meet\MeetStatus;
use App\Enums\Database\Meet\MeetType;

return [
    MeetStatus::class => [
        MeetStatus::Publish => 'منتشر شده',
        MeetStatus::Reject => 'رد شده',
        MeetStatus::Pending => 'در انتظار',
        MeetStatus::Expire => 'منقضی شده',
        MeetStatus::NeedEdit => 'نیاز به ویرایش',
    ],
    MeetType::class => [
        MeetType::Premium => 'پریمیوم',
        MeetType::Free => 'رایگان',
    ],
    MeetConnectionWay::class => [
        MeetConnectionWay::None => 'بدون ارتباط',
        MeetConnectionWay::Whatsapp => 'واتس آپ',
        MeetConnectionWay::Telegram => 'تلگرام',
        MeetConnectionWay::Email => 'ایمیل',
        MeetConnectionWay::Call => 'شماره',
    ],
];
