@push('css')
    <style>
        .bottom-menu-bar
        {
            margin: 10px;
            border-bottom: 2px solid #DDD;
            display: flex;
            flex-direction: row;
        }
        .bottom-menu-item
        {
            padding: 10px 15px;
            cursor: pointer;
            user-select: none;
            white-space: nowrap;
        }
        .bottom-menu-item.active
        {
            color: #5bc0de !important;
            border-bottom: 2px solid #5bc0de;
            margin-bottom: -2px;
        }
        .bottom-menu-item:hover
        {
            color: #5bc0de;
        }
    </style>
@endpush
<div class="bottom-menu-bar">
    @foreach ($menu as $item)
        <a class="bottom-menu-item {{ $bottom == $item['name'] ? 'active' : ''  }}" href="{{ $top == 'start' ? '#' : route($item['link'], ['id' => $id]) }}"
            style="display: {{ ($item['name'] != 'coborrower' || isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? 'initial' : 'none' }};">
            {{$item['title']}}
        </a>
    @endforeach
</div>
