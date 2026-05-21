@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center py-4">
        <span class="inline-flex items-center space-x-2 bg-white shadow-sm rounded-lg border border-slate-200 px-2 py-1">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 rounded-md bg-slate-50 text-sm font-semibold text-slate-400">
                    «
                </span>
            @else
                <a href="{{ $paginator->url(1) }}"
                   class="px-3 py-2 rounded-md bg-slate-50 text-sm font-semibold text-slate-700 transition duration-150 hover:bg-slate-100">
                    «
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 rounded-md text-sm font-semibold text-slate-500">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="px-4 py-2 rounded-md bg-primary text-white text-sm font-semibold shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-4 py-2 rounded-md bg-slate-50 text-sm font-semibold text-slate-700 transition duration-150 hover:bg-slate-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->lastPage()) }}"
                   class="px-3 py-2 rounded-md bg-slate-50 text-sm font-semibold text-slate-700 transition duration-150 hover:bg-slate-100">
                    »
                </a>
            @else
                <span class="px-3 py-2 rounded-md bg-slate-50 text-sm font-semibold text-slate-400">
                    »
                </span>
            @endif
        </span>
    </nav>
@endif
