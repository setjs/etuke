<?php

namespace Tests\Feature\Page;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemberAvatarTest extends TestCase
{

    public function test_member_avatar_page()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->visit(route('member.avatar'))
            ->see('头像');
    }

    public function test_avatar_change_action()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->visit(route('member.avatar'))
            ->attach(base_path('/assets/images/etuke.png'), 'file')
            ->press('更换')
            ->seePageIs(route('member.avatar'));
    }

}
