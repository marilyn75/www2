<ul class=' ' id='mnSubSawon'>
    @foreach ($menuItems as $_menu)
        <li class='
        @if (!empty($_menu->children()) && $_menu->children()->count() > 0) has-sub @endif
        '>
            <div class='li-wr'>
                <input type='hidden' name='id[]' value='{{ $_menu->id }}' />
                <input type='hidden' name='depth[]' value='{{ $_menu->depth - 1 }}' />
                <button type='button' class='is-folder'><span class='blind'>Sub
                        Toggle</span></button>
                <span class='is-mntype mntype-{{ strtolower($_menu->type) }}'></span>
                <p class='nm-wr'>
                    <a href='http://test.gbbinc.co.kr/mng/SawonList' target='_blank'>
                        <strong class='is-nm'>{{ $_menu->title }}</strong>
                        <span class='is-code'>SawonList</span>
                    </a>
                </p>
                <p class='chk-wr'>
                    <span class='is-chk'>
                        <input type='checkbox' name='chk_use[]' id='chk_use_{{ $_menu->id }}' value='{{ $_menu->id }}' @if($_menu->is_use==1) checked @endif title='사용여부' />
                        <label for='chk_use_{{ $_menu->id }}'>USE</label>
                    </span>
                    <span class='is-chk'>
                        <input type='checkbox' name='chk_print_top[]' id='chk_tmn_SawonList' value='SawonList' title='상단메뉴로출력' />
                        <label for='chk_tmn_SawonList'>TOP</label>
                    </span>
                    <span class='is-chk'>
                        <input type='checkbox' name='chk_print_left[]' id='chk_lm_SawonList' value='SawonList' checked='checked' title='왼쪽메뉴로출력' />
                        <label for='chk_lm_SawonList'>LEFT</label>
                    </span>
                        <span class='is-chk'><input type='checkbox' name='chk_print_tab[]' id='chk_tab_SawonList' value='SawonList' title='탭메뉴로출력' />
                        <label for='chk_tab_SawonList'>TAB</label>
                    </span>
                </p>
                <p class='bt-wr'>
                    <button type="button" class="a-icbt ic-add btnAddSubMenu" data-id="{{ $_menu->id }}">
                        <span class="blind">추가</span>
                    </button>
                    <button type="button" class="a-icbt ic-cfg btnEditMenu" data-id="{{ $_menu->id }}">
                        <span class="blind">관리</span>
                    </button>
                    <button type="button" class="a-icbt ic-move btnMoveMenu" data-id="{{ $_menu->id }}">
                        <span class="blind">이동</span>
                    </button>
                    <button type="button" class="a-icbt ic-del btnDeleteMenu" data-id="{{ $_menu->id }}">
                        <span class="blind">삭제</span>
                    </button>
                </p>
            </div>
            @if (!empty($_menu->children()))
                <x-MenuItem :menuItems="$_menu->children" />
            @endif
        </li>
    @endforeach
</ul>
