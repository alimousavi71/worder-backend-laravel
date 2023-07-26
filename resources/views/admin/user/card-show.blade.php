<div class="col-xl-6 col-lg-6 col-md-6 col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">اطلاعات دوره همی</h3>
        </div>
        <div class="card-body pb-2">
            <div class="table-responsive">
                <table class="table">
                    <tbody>

                    <tr>
                        <td style="width: 25%;">شناسه</td>
                        <td><a href="{{ route('admin.meet.edit',$meet->id) }}">{{ $meet->id }}</a></td>
                    </tr>

                    <tr>
                        <td>کاربر</td>
                        <td><a href="{{ route('admin.meet.edit',$meet->user_id) }}">{{ $meet->user->mobile }}</a></td>
                    </tr>

                    <tr>
                        <td>اسلاگ</td>
                        <td>{{ $meet->slug }}</td>
                    </tr>

                    <tr>
                        <td>کد یکتا</td>
                        <td>{{ $meet->identity }}</td>
                    </tr>

                    <tr>
                        <td>هزینه</td>
                        <td>
                            @if ($meet->price)
                                {{ $meet->price }}
                            @else
                                <span>رایگان</span>
                            @endif
                        </td>
                    </tr>


                    @if ($meet->categories->isNotEmpty())
                        <tr>
                            <td>دسته بندی ها</td>
                            <td>
                                @foreach ($meet->categories as $item)
                                    <span class="badge bg-success">{{ $item->title }}</span>
                                @endforeach
                            </td>
                        </tr>

                    @endif
                    <tr>
                        <td>پلتفرم برگزاری</td>
                        <td>{{ $meet->platform->title }}</td>
                    </tr>

                    <tr>
                        <td>تعداد اعضاء</td>
                        <td>
                            @if ($meet->can_join)
                                <span>{{ number_format($meet->can_join) }}</span>
                                <span> نفر</span>
                            @else
                                <span>نامحدود</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>عضو شده ها</td>
                        <td>{{ number_format($meet->joins->count()) }}</td>
                    </tr>

                    <tr>
                        <td>لینک</td>
                        <td>{{ $meet->link }}</td>
                    </tr>

                    <tr>
                        <td>راه ارتباطی</td>
                        <td>{{ \App\Enums\Database\Meet\MeetConnectionWay::getDescription($meet->connection_way) }}</td>
                    </tr>

                    @if($meet->connection_info)
                        <tr>
                            <td>اطلاعات تماس</td>
                            <td>{{ $meet->connection_info }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td>نوع</td>
                        <td>{{ \App\Enums\Database\Meet\MeetType::getDescription($meet->type) }}</td>
                    </tr>

                    <tr>
                        <td>وضعیت</td>
                        <td>{!! \App\Helper\Helper::meetStatusRender($meet->status) !!}</td>
                    </tr>

                    <tr>
                        <td>زمان شروع</td>
                        <td>{{ $meet->start_date->toJalali()->format('H:i  Y-m-d') }}</td>
                    </tr>

                    @if ($meet->publish_date)
                        <tr>
                            <td>زمان انتشار</td>
                            <td>{{ $meet->publish_date->toJalali()->format('H:i Y-m-d') }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td>تاریخ ایجاد</td>
                        <td>{{$meet->created_at->toJalali()->format('H:i Y-m-d')}}</td>
                    </tr>

                    <tr>
                        <td>تصویر</td>
                        <td>
                            <img class="meet-photo" src="{{ asset($meet->photo) }}" alt="{{ $meet->title }}">
                        </td>
                    </tr>

                    <tr>
                        <td>کاور</td>
                        <td>
                            <img class="meet-cover" src="{{ asset($meet->cover) }}" alt="{{ $meet->title }}">
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
