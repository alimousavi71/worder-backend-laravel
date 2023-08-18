@extends('admin.master')
@section('title') {{ $title }} @endsection
@section('head')
    @include('admin.partial.loader.style',['load'=>[ \App\Enums\Assets\StyleLoader::Toast()]])
@endsection
@section('content')

    <div class="page-header">
        <h1 class="page-title">{{ trans('panel.avatar.title') }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('panel.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('panel.avatar.title') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-2">
            @include('admin.partial.message')
        </div>
    </div>
    <div class="row" id="item-container">
        @if($avatars->isNotEmpty())
            @foreach($avatars as $avatar)
                <div class="col-12 col-md-4 col-xl-3">
                    <div class="card avatar-card" data-id="{{ $avatar->id }}">
                        <img src="{{ asset($avatar->icon) }}" class="card-img-top" alt="img">
                        <div class="card-body">
                            <a  class="btn btn-sm d-block btn-primary" href="{{ route('admin.avatar.edit',$avatar->id) }}">
                                <span class="fa-solid fa-pen me-1"></span>
                                <span>{{ trans('panel.edit') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
@section('script')
    @include('admin.partial.loader.script',['load'=>[]])
    <script src="{{ asset('res-admin/assets/plugins/jquery-sortablejs/Sortable.min.js') }}"></script>
    <script src="{{ asset('res-admin/assets/plugins/jquery-sortablejs/jquery-sortable.js') }}"></script>

    <script src="{{asset('res-admin/assets/plugins/toast/jquery.toast.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            const container = $('#item-container');

            container.sortable({
                handle: '.card',
                animation: 200,
                swapThreshold: 1,
                invertSwap: false,
                easing: "cubic-bezier(1, 0, 0, 1)",
                onUpdate: function(evt) {
                    sendOrderToServer();
                }
            })

            function sendOrderToServer() {
                let orders = [];
                $('.avatar-card').each(function(index,element) {
                    orders.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.avatar.sort-item') }}",
                    data: {
                        orders:orders,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        if (response.result === "updated") {
                            $.toast({
                                text: '{{ trans('panel.success_update') }}' ,
                                allowToastClose: false,
                                position:'bottom-left',
                                hideAfter:5000,
                                textAlign : 'right',
                                icon: 'success'
                            });

                        } else {
                            $.toast({
                                heading: 'error',
                                text: 'Message' ,
                                allowToastClose: false,
                                position:'bottom-left',
                                hideAfter:5000,
                                textAlign : 'right',
                                icon: 'error'
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection
