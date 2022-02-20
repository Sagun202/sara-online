<div id="mobile-menu">
    @php($categories = FrontEndHandler::getCategoryTree())
    <ul>
        @foreach ($categories as $parent)

        <li>
            <a href="{{ route('category',$parent->slug) }}">{{ $parent->name }}</a>
            <ul>
                @foreach ($parent->allChildrens as $child)
                <li>
                    <a href="{{ route('category',$child->slug) }}">{{ $child->name }} </a>
                    <ul>
                        @foreach ($child->allChildrens as $grand)
                        <li>
                            <a href="{{ route('category',$grand->id) }}"><span>{{ $grand->name }}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                @endforeach

            </ul>
        </li>
        @endforeach
    </ul>
</div>