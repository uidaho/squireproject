<ul class="breadcrumb">
    <li>
        <a href="/">Home</a>
    </li>
    @for($i = 1; $i <= count(Request::segments()); $i++)
        <li @if($i == count(Request::segments())) class="active" @endif>
            <a href="@for($j = 1; $j <= $i; $j++)/{{ Request::segment($j) }}@endfor">{{ Request::segment($i) }}</a>
        </li>
    @endfor
</ul>