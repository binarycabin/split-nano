<div class="bg-blue-900 p-2 shadow text-xl text-white">
    <div class="flex">
        <div class="flex-1">
            <h3 class="font-bold pl-2">{!! $slot !!}</h3>
        </div>
        @if(!empty($withNodeStatus))
        <div class="hidden md:block">
            <?php
            $nano = new \App\Services\Nano\Nano();
            $blockInfoResponse = $nano->call('block_count', []);
            ?>
            @if(!empty($blockInfoResponse) && !empty($blockInfoResponse->count))
                <div>
                    <div class="text-white text-xs font-bold opacity-75">Node Status:</div>
                    <div class="text-white text-xs text-green-300">Running: {{ $blockInfoResponse->count }} blocks</div>
                </div>
            @else
                    <div>
                        <div class="text-white text-xs font-bold opacity-75">Node Status:</div>
                        <div class="text-white text-xs text-red-300">Unable to connect...</div>
                    </div>
            @endif
        </div>
        @endif

    </div>

</div>