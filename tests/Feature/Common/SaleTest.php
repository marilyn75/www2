<?php

namespace Tests\Feature\Common;

use App\Models\CommonCode;
use Tests\TestCase;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // 로그인한 상태를 가정
        $user = User::factory()->create();
        $this->actingAs($user);

        // 테스트용 메뉴생성
        $arrMenu = [
            ['code'=>'salereg', 'title'=>'매물등록', 'type'=>'P', 'top_image'=>null, 'board_id'=>null, 'content_id'=>null, 'url'=>null, 'is_use'=>1,],
        ];

        Menu::rebuildSubtree(Menu::find(1), $arrMenu);

        // 테스트용 공통코드 생성
        $arrCode = [
            ['title'=>'거래유형', 'is_use'=>1,
                'children' => [['title'=>'매매', 'is_use'=>1,], ['title'=>'임대', 'is_use'=>1,], ['title'=>'교환', 'is_use'=>0,]]
            ],
            ['title'=>'매물유형', 'is_use'=>1,
                'children' => [
                    ['title'=>'상업용매물', 'is_use'=>1,
                        'children' => [
                            ['title'=>'상가건물', 'is_use'=>1],
                            ['title'=>'상가주택', 'is_use'=>1],
                            ['title'=>'메디컬시설', 'is_use'=>1],
                            ['title'=>'숙박시설', 'is_use'=>1],
                            ['title'=>'목욕시설', 'is_use'=>1],
                            ['title'=>'업무시설', 'is_use'=>1],
                            ['title'=>'운동시설', 'is_use'=>1],
                            ['title'=>'판매시설', 'is_use'=>1],
                            ['title'=>'교육시설', 'is_use'=>1],
                            ['title'=>'분양상가', 'is_use'=>1],
                            ['title'=>'분양상가', 'is_use'=>1],
                        ]
                    ], 
                    ['title'=>'주거용매물', 'is_use'=>1,
                        'children' => [
                            ['title'=>'아파트', 'is_use'=>1],
                            ['title'=>'주상복합', 'is_use'=>1],
                            ['title'=>'오피스텔', 'is_use'=>1],
                            ['title'=>'빌라', 'is_use'=>1],
                            ['title'=>'단독주택', 'is_use'=>1],
                            ['title'=>'다가구주택', 'is_use'=>1],
                            ['title'=>'다세대주택', 'is_use'=>1],
                        ]
                    ], 
                ]
            ],
        ];
        CommonCode::rebuildTree($arrCode);
    }

    public function test_매물_등록_스텝1_페이지를_볼_수_있다(): void
    {
        $response = $this->get(route('page',3));
        
        $response->assertStatus(200);
    }

    // public function test_로그아웃_상태에서_접근하면_로그인_페이지로_이동한다(): void
    // {
    //     auth()->guard('web')->logout();

    //     // 로그인 페이지 이동
    //     $response = $this->get(route('page',3));
    //     $response->assertRedirect(route('login'))
    //         ->assertStatus(302);
    // }
}
