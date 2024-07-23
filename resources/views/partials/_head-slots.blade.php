<x-slot name="page_title">{!! $data->page_title !!}</x-slot>
@if ($data->breadcrumb)
    <x-slot name="breadcrumb">
        @foreach ($data->breadcrumb as $li)
            <!--begin::Item-->
            @if (isset($li['link']))
                <li class="breadcrumb-item"><a href="{{ $li['link'] }}">{{ $li['text'] }}</a></li>
            @else
                <li class="breadcrumb-item text-muted">{{ $li['text'] }}</li>
            @endif
            <!--end::Item-->
        @endforeach
    </x-slot>
@endif

@if ($data->buttons)
    <x-slot name="btn_actions">
        @foreach ($data->buttons as $btn)
            @if (isset($btn['modal']))
                <a href="#" class="{{ $btn['class'] }}" data-bs-toggle="modal"
                    data-bs-target="#{{ $btn['modal'] }}">{{ $btn['text'] }}</a>
            @elseif(isset($btn['link']))
                <a href="{{ $btn['link'] }}" class="{{ $btn['class'] }}"
                    {{ isset($btn['target']) ? "target='" . $btn['target'] . "'" : '' }}>
                    <i class="las {{ @$btn['icon'] }}"></i>
                    {{ $btn['text'] }}
                </a>
            @endif
        @endforeach
    </x-slot>
@endif
