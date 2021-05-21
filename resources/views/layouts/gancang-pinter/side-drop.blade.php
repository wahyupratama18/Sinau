<li>
    <!-- Very little is needed to make a happy life. - Marcus Antoninus -->
    @if (isset($sub))
    <a
        href="{{ "#$href" }}"
        data-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle">
        {{ $title }}
    </a>
    <ul class="collapse list-unstyled" id="{{ $href }}">
        @foreach ($sub as $val)
            <li>
                <a href="{{ $val->href }}">{{ $val->title }}</a>
            </li>
        @endforeach
    </ul>
      
    @else
    <a href="{{ $href }}">{{ $title }}</a>
    @endif
</li>