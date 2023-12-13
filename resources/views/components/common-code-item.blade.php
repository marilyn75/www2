<ul>
    @foreach ($codeItems as $_code)
        <li class='
        @if (!empty($_code->children()) && $_code->children()->count() > 0) has-sub is-open @endif
        '>
            <div class='li-wr'>
                <input type='hidden' name='id[]' value='{{ $_code->id }}' />
                <input type='hidden' name='depth[]' value='{{ $_code->depth - 1 }}' />
                <p class='is-handle'>
                <button type='button' class="is-folder"><span class='blind'>Toggle Sub</span></button>
                </p>
                <p class='nm-wr'>
                    <strong class='is-nm'>{{ $_code->title }} @if ($_code->is_use==0) <span style="font-size: 10px; color:red;">[사용안함]</span> @endif</strong>
                    
                </p>
                <p class='bt-wr'>
                    <button type="button" class="a-icbt ic-add btnAddSubCode" data-id="{{ $_code->id }}">
                        <span class="blind">추가</span>
                    </button>
                    <button type="button" class="a-icbt ic-move btnMoveCode" data-id="{{ $_code->id }}">
                        <span class="blind">이동</span>
                    </button>
                    <button type="button" class="a-icbt ic-edit btnEditCode" data-id="{{ $_code->id }}">
                        <span class="blind">수정</span>
                    </button>
                    <button type="button" class="a-icbt ic-del btnDeleteCode" data-id="{{ $_code->id }}">
                        <span class="blind">삭제</span>
                    </button>
                </p>
            </div>
            @if (!empty($_code->children()))
                <x-CommonCodeItem :codeItems="$_code->children" />
            @endif
        </li>
    @endforeach
</ul>
