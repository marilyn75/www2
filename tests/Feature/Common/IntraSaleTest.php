<?php

namespace Tests\Feature\Common;

use App\Models\IntraSale;
use App\Models\IntraSaleHomepage;
use Tests\TestCase;
use App\Models\Menu;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntraSaleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // 테스트용 메뉴생성
        $arrMenu = [
            ['code'=>'salereg', 'title'=>'인트라넷매물', 'type'=>'P', 'top_image'=>null, 
            'board_id'=>null, 'content_id'=>null, 'program_module'=>'SaleIntranet', 
            'url'=>null, 'is_use'=>1,],
        ];

        Menu::rebuildSubtree(Menu::find(1), $arrMenu);
    }

    public function test_인트라넷매물_목록페이지를_볼_수_있다(): void
    {
        $response = $this->get(route('page',3));
        
        $response->assertStatus(200);
    }

    public function test_인트라넷매물_뷰페이지를_볼_수_있다(): void
    {
        // 인트라넷 데이터
        $data = IntraSaleHomepage::where('isDone',1)->first();

        $params = ['mode'=>'show', 'idx'=>$data->idx];
        $response = $this->get(route('page',3), $params);
        
        $response->assertStatus(200)
            ->assertSeeText($data->saleType);
    }
}
